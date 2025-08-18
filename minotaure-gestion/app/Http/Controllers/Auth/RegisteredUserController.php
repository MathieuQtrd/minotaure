<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => [
                'required', 
                'confirmed', 
                /*
                Rules\Password::defaults()
                */
                // mise en place d'un mdp avec 1 maj, 1 min, 1 chiffre, 1 caractère spécial et une taille minimum de 8
                Rules\Password::min(8)  // taille de 8 caractères minimum
                    ->mixedCase()       // Doit contenir majuscule et minuscule
                    ->numbers()         // Doit contenir au moins un chiffre
                    ->symbols(),        // Doit contenir au moins 1 caractère spécial

                /*
                // Sans passer par Rules\
                
                'password' => [
                    'required',
                    'confirmed',
                    'string',
                    'min:8',
                    'regex:/[A-Z]/', // Doit contenir majuscule
                    'regex:/[a-z]/', // Doit contenir minuscule
                    'regex:/[0-9]/', // Doit contenir chiffre
                    'regex:/[@$!%*?&]/', // Doit contenir caractère spécial
                ],
                */
                
            ],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // ajout d'un role par défaut
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
