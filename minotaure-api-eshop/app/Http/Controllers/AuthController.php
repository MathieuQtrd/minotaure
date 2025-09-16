<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(), // on récupère les erreurs de validation
                'message' => 'Erreur de connexion',
            ], 422); // 422 : Code HTTP : Erreur de validation
        }

        // On crée l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('user');

        return response()->json(['message' => 'Nouveau compte créé']);

    }

    public function login()
    {

    }

    public function logout()
    {

    }

    public function user()
    {

    }
}
