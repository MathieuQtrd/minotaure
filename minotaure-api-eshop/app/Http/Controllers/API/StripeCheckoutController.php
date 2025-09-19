<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Product;

class StripeCheckoutController extends Controller
{
    public function createCheckoutSession(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        // \Stripe\Stripe::setVerifySslCerts(false); // pour éviter les erreurs liés au certificat SSL du fait d'être en local. Ne pas mettre cela en prod !!!

        // On vérifie si un panier est envoyé
        if (!$request->has('cart')) {
            return response()->json(['error' => 'Aucun panier fourni.'], 400);
        }

        $panier = $request->cart; // Tableau de produits [{id, quantity}]
        $lineItems = [];
        $total = 0;

        foreach ($panier as $item) {
            $product = Product::find($item['id']); // On récupère le produit depuis la BDD
            if (!$product) {
                return response()->json(['error' => 'Produit introuvable.'], 400);
            }

            // On vérifie le prix depuis la base de données 
            $unitPrice = $product->price * 100; // Stripe demande des centimes
            $quantity = max(1, (int) $item['quantity']); // Empêcher les valeurs négatives

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $product->title,
                        'description' => $product->description ?? 'Aucun descriptif',
                    ],
                    'unit_amount' => $unitPrice,
                ],
                'quantity' => $quantity,
            ];

            $total += $unitPrice * $quantity;
        }

        // Si le panier est vide après vérification
        if ($total === 0) {
            return response()->json(['error' => 'Le panier ne peut pas être vide.'], 400);
        }

        try {
            $checkoutSession = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => 'http://localhost/minotaure-eshop/cart.php' . '?payment=success&session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => 'http://localhost/minotaure-eshop/cart.php' . '?payment=cancel',
            ]);

            return response()->json(['id' => $checkoutSession->id]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
