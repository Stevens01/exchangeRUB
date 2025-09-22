<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Veuillez vous connecter pour accéder à cette page.');
        }

        // Vérifier si l'utilisateur est administrateur
        if (!Auth::user()->role==='admin') {
            return redirect()->route('home')
                ->with('error', 'Accès non autorisé. Réservé aux administrateurs.');
        }

        // Vérifier si le compte est activé
        if (Auth::user()->status != 1) {
            Auth::logout();
            return redirect()->route('login')
                ->with('error', 'Votre compte administrateur n\'est pas activé.');
        }

        return $next($request);
    }
}