@extends('layouts.auth')  

@section('title', 'Inscription - ExchangeRUB')

@section('content')
<div class="text-center mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Rejoignez ExchangeRUB</h1>
    <p class="text-gray-600">Créez votre compte pour commencer à échanger</p>
</div>

<div class="flex border-b border-gray-200 mb-6">
    <a href="{{route('login')}}" class="py-3 px-6 font-medium text-center text-gray-500 w-1/2 hover:text-primary-600">
        Connexion
    </a>
    <button class="py-3 px-6 font-medium text-center text-primary-600 border-b-2 border-primary-600 w-1/2" id="register-tab">
        Inscription
    </button>
</div>

<!-- Formulaire d'inscription -->
<form id="register-form" action="{{ route('register.submit') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-5">
        <label for="register-name" class="block text-gray-700 font-medium mb-2">Nom complet</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-user text-gray-400"></i>
            </div>
            <input type="text" id="register-name" name="name" class="pl-10 w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition" placeholder="Votre nom complet" required>
        </div>
    </div>
    
    <div class="mb-5">
        <label for="register-email" class="block text-gray-700 font-medium mb-2">Adresse email</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-envelope text-gray-400"></i>
            </div>
            <input type="email" id="register-email" name="email" class="pl-10 w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition" placeholder="votre@email.com" required>
        </div>
    </div>
    

    <div class="mb-5">
        <label for="register-num_passport" class="block text-gray-700 font-medium mb-2">Numéro du passePort</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-user text-gray-400"></i>
            </div>
            <input type="text" id="register-num_passport" name="num_passport" class="pl-10 w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition" placeholder="Votre numéro de passeport" required>
        </div>
    </div>

    <div class="mb-5">
        <label for="register-img_passport" class="block text-gray-700 font-medium mb-2">Image du passePort</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-user text-gray-400"></i>
            </div>
            <input type="file" id="register-img_passport" name="img_passport" class="pl-10 w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition"  required>
        </div>
    </div>
    <div class="mb-5">
        <label for="register-password" class="block text-gray-700 font-medium mb-2">Mot de passe</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-lock text-gray-400"></i>
            </div>
            <input type="password" id="register-password" name="password" class="pl-10 pr-10 w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition" placeholder="Créez un mot de passe" required>
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center password-toggle" data-target="register-password">
                <i class="fas fa-eye text-gray-400"></i>
            </div>
        </div>
    </div>
    
    <div class="mb-6">
        <label for="register-confirm-password" class="block text-gray-700 font-medium mb-2">Confirmer le mot de passe</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-lock text-gray-400"></i>
            </div>
            <input type="password" id="register-confirm-password" name="password_confirmation" class="pl-10 w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition" placeholder="Confirmez votre mot de passe" required>
        </div>
    </div>
    
    <div class="flex items-center mb-6">
        <input type="checkbox" id="terms-agree" name="terms" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded" required>
        <label for="terms-agree" class="ml-2 block text-sm text-gray-700">
            J'accepte les <a href="#" class="text-primary-600 hover:underline">conditions d'utilisation</a> et la <a href="#" class="text-primary-600 hover:underline">politique de confidentialité</a>
        </label>
    </div>
    
    <button type="submit" class="w-full bg-primary-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-primary-700 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
        Créer un compte
    </button>
    
    <div class="relative flex items-center my-6">
        <div class="flex-grow border-t border-gray-300"></div>
        <span class="flex-shrink mx-4 text-gray-500">Ou</span>
        <div class="flex-grow border-t border-gray-300"></div>
    </div>
    
    <button type="button" class="w-full bg-white border border-gray-300 text-gray-700 py-3 px-4 rounded-lg font-medium hover:bg-gray-50 transition flex items-center justify-center">
        <i class="fab fa-google text-red-500 mr-2"></i> S'inscrire avec Google
    </button>
    
    <div class="text-center mt-6">
        <span class="text-gray-600">Vous avez déjà un compte?</span>
        <a href="login.html" class="text-primary-600 font-medium hover:underline ml-1">Se connecter</a>
    </div>
</form>
@endsection

@section('ownscript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Validation du formulaire d'inscription
            const registerForm = document.getElementById('register-form');
            
            registerForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Récupération des valeurs
                const name = document.getElementById('register-name').value;
                const email = document.getElementById('register-email').value;
                const num_passport = document.getElementById('register-num_passport').value;
                const img_passport = document.getElementById('register-img_passport').value;
                const password = document.getElementById('register-password').value;
                const confirmPassword = document.getElementById('register-confirm-password').value;
                const termsAgreed = document.getElementById('terms-agree').checked;
                
                // Validation
                if (!name || !email || !num_passport || !img_passport || !password || !confirmPassword) {
                    alert('Veuillez remplir tous les champs obligatoires');
                    return;
                }
                
                if (password !== confirmPassword) {
                    alert('Les mots de passe ne correspondent pas!');
                    return;
                }
                
                if (!termsAgreed) {
                    alert('Veuillez accepter les conditions d\'utilisation');
                    return;
                }
                
                // Soumission du formulaire
                this.submit();
            });
        });
    </script>
@endsection