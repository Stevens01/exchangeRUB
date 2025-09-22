<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Afficher le formulaire de connexion
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Traiter la tentative de connexion
     */
    public function login(Request $request)
    {
        // Validation des données
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 6 caractères.',
        ]);

        // Tentative d'authentification
        if (Auth::attempt($credentials, $request->has('remember'))) {
            // Régénérer la session pour prévenir les attaques de fixation
            $request->session()->regenerate();

            // Vérifier si le compte est activé
            if (Auth::user()->status != 1) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Votre compte n\'est pas activé. Veuillez contacter l\'administrateur.',
                ])->withInput($request->only('email'));
            }

            // Redirection en fonction du rôle
            if (Auth::user()->role==='admin') {
                return redirect()->intended(route('admin.dashboard'))
                    ->with('success', 'Connexion réussie! Bienvenue administrateur.');
            }

            return redirect()->intended(route('exchange.create'))
                ->with('success', 'Connexion réussie! Bienvenue sur ExchangeRUB.');
        }

        // Si l'authentification échoue
        return back()->withErrors([
            'email' => 'Les identifiants ne correspondent pas à nos enregistrements.',
        ])->withInput($request->only('email'));
    }

    /**
     * Déconnexion de l'utilisateur
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Vous avez été déconnecté avec succès.');
    }

    /**
     * Afficher le formulaire d'inscription
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Traiter l'inscription d'un nouvel utilisateur
     */
    public function register(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'num_passport' => 'required|string|max:50',
            'img_passport' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            
            
            
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 6 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'num_passport.required' => 'Le numéro de passeport est obligatoire.',
            'img_passport.required' => 'L\'image du passeport est obligatoire.',
            'img_passport.image' => 'Le fichier doit être une image.',
            'img_passport.mimes' => 'L\'image doit être au format JPEG, PNG ou JPG.',
            'img_passport.max' => 'L\'image ne doit pas dépasser 2 Mo.',
        ]);

        // Traitement de l'image du passeport
        if ($request->hasFile('img_passport')) {
            $imagePath = $request->file('img_passport')->store('passports', 'public');
            $validatedData['img_passport'] = $imagePath;
        }

        // Création de l'utilisateur
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'num_passport' => $validatedData['num_passport'],
            'status' => 0,
            'img_passport' => $validatedData['img_passport'],
            'role' => 'user',
            
        ]);

        
            return redirect()->route('waiting_approval')
            ->with('success', 'Votre compte a été créé avec succès. Il sera activé après validation par un administrateur.');
    }

    public function waitingApproval()
    {
        if (!Auth::check()) {
        return view('auth.waiting_approval', [
            'targetTime' => now()->addHours(24)
        ]);
    }
    
    $user = Auth::user();
    $createdAt = $user->created_at;
    $targetTime = $createdAt->addHours(24);
    
    return view('auth.waiting_approval', compact('targetTime'));
    }
}