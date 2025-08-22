<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Mail\ConfirmationContactMail;

class ContactController extends Controller
{
    public function index () 
    {
        return view('contact.contact');
    }

    public function sendMail (Request $request) 
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string',
            'subject' => 'required|string|max:255',
        ]);
        $details = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
        ];
        $subject = $validated['subject'];

        Mail::to('destinataire@mail.fr')->send(new ContactMail($details, $subject));

        Mail::to($validated['email'])->send(new ConfirmationContactMail($details, $subject));
        
        return back()->with('success', 'Merci pour votre demande de contact, nous reviendrons vers vous dans les meilleurs délais.');


    }
}
