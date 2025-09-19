<?php
// Créer un compte sur stripe

// on installe stripe dans notre application back
# composer require stripe/stripe-php

// Dans le fichier .ENV rajouter ces deux lignes :
# STRIPE_SECRET=sk_test_xxx
# STRIPE_PUBLIC=pk_test_xxx

// Mettre les clé API fournies par stripe (dans le dashboard de stripe en bas à gauche developpeurs => clés API)

// On crée un controller 
# php artisan make:controller API/StripeCheckoutController



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

// mettre en place la route 
use App\Http\Controllers\Api\StripeCheckoutController;

Route::post('/checkout-session', [StripeCheckoutController::class, 'createCheckoutSession']);

// FRONT 

// Ajout de la bibliothèque stripe dans la page cart.php :
<script src="https://js.stripe.com/v3"></script>

// On ajoute un event sur le bouton de paiement :
buttonPayCart.addEventListener('click', function () {
    // la clé en dessous doit être la clé API public
    let stripe = Stripe('pk_test_xxx');
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    if (cart.length === 0) {
        alert('Votre panier est vide');
        return;
    }

    fetch('http://localhost:8000/api/checkout-session', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            cart
        })
    })
        .then(response => response.json())
        .then(session => {
            if (session.error) {
                alert('Erreur' + session.error);
            } else {
                stripe.redirectToCheckout({
                    sessionId: session.id
                });
            }
        })
        .catch(error => {
            console.error('Erreur : ', error);
        })

});

// On catch la réponse de Stripe :
document.addEventListener('DOMContentLoaded', function () {
    let urlParams = new URLSearchParams(window.location.search);
    let paymentStatus = urlParams.get('payment');

    if (paymentStatus == 'success') {
        localStorage.removeItem('cart');
        alert('Merci pour votre commande, vous pourrez voir le suivi de votre commande dans votre page profil...');
        // Enregistrement de la commande via un appel api 
            // Mise à jour des stocks produit

        // window.location.href = 'cart.php';
    } else if (paymentStatus == 'cancel') {
        alert('Paiement annulé.');
        // window.location.href = 'cart.php';
    }
})


/*
Numéro de carte bancaire pour tester les paiement sur stripe :

// https://docs.stripe.com/testing-use-cases

Visa (paiement réussi) :                4242 4242 4242 4242. (CVC : n’importe quel 3 chiffres, date future). 
Mastercard (paiement réussi) :          5555 5555 5555 4444. 
American Express (paiement réussi) :    3782 822463 10005 (CVC 4 chiffres pour Amex).


*/