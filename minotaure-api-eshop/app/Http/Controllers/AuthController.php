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
                'message' => 'Erreur',
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

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(), // on récupère les erreurs de validation
                'message' => 'Erreur',
            ], 422); // 422 : Code HTTP : Erreur de validation
        }

        // on récupère l'utilisateur sur la base de son login (email)
        $user = User::where('email', $request->email)->first();

        // on vérifie le mdp
        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'errors' => [['Erreur sur le login et/ou le mot de passe']], // on récupère les erreurs de validation
                'message' => 'Erreur',
            ], 422); 
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        // On crée un token d'authetification pour l'utilisateur. Ce token sera utilisé pour autoriser l'accès à nos routes protégées par sanctum et spatie selon le role.
        return response()->json(['token' => $token, 'user' => $user]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete(); // on supprime le token de l'utilisateur

        return response()->json(['message' => 'déconnexion']);
    }

    public function user(Request $request)
    {
        return response()->json([
            'id' => $request->user()->id,
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'roles' => $request->user()->getRoleNames(), // on récupère le ou les roles de l'utilisateur
        ]);
    }
}
