<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Pour récupérer l'utilisateur

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, String $role): Response
    {
        // $role est récupéré depuis la route ->middleware(['auth', 'role:client']) 

        $user = Auth::user(); // permet de récupérer l'utilisateur connecté ou NULL

        if(!$user || ($user->role !== 'admin' && $user->role !== $role) ) {
            abort(403, 'Accès interdit ! ');
        }

        return $next($request); // on valide l'action suivante ($next) : la page demandée
    }
}
