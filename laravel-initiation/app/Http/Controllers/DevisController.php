<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Devis;

class DevisController extends Controller
{
    public function create()
    {
        return view('create_devis');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'subject' => 'required|max:255',
            'email' => 'required|email',
            'message' => 'required|min:10'
        ]);

        Devis::create($validated);

        return back()->with('success', 'Merci pour votre demande de devis');
    }

    // affichage de tous les devis
    public function list()
    {
        $title = 'Affichage des devis';

        $devis = Devis::all(); // renvoie le contenu complet de la table contact
        
        return view('display_devis', [
            'title' => $title,
            'devis' => $devis,
        ]);
    }


}