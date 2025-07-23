<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'message' => 'required|min:10'
        ], [
            'name.required' => 'Le nom est obligatoire',
            'name.max' => 'Le nom ne peut pas dépasser 255 caractères',

            'email.required' => 'Le mail est obligatoire',
            'email.email' => 'Le format du mail est invalide',

            'message.required' => 'Le message est obligatoire',
            'message.min' => 'Le message doit contenir au moins 10 caractères',
        ]);

        // Envoi de mail
        // Mail::raw($validated['message'], function ($mail) use ($validated) {
        //     $mail->to('destinataire@mail.fr')
        //     ->from($validated['email'], $validated['name'])
        //     ->subject('Nouveau message de contact');
        // });

        // Enregistrement dans la BDD table contact
        Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
        ]);
        // il est possible de faire : 
        // Contact::create($validated);



        return back()->with('success', 'Merci pour votre message');
        // back permet de rediriger vers la page en cours
        // return redirect()->back() // identique
        // return redirect()->route('autre')
        // return redirect('/contact') // url interne
        // return redirect('http://www.autre.php') // url extérieure 
    }

    // affichage de tous les contacts
    public function list()
    {
        $title = 'Affichage des contacts';

        $contacts = Contact::all(); // renvoie le contenu complet de la table contact
        
        return view('contacts', [
            'title' => $title,
            'contacts' => $contacts,
        ]);
    }


}
