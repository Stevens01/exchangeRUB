@extends('layouts.auth')  

@section('title', 'Inscription - ExchangeRUB')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white rounded-2xl shadow-xl p-6 sm:p-8 md:p-10">
        <!-- En-tête -->
        <div class="text-center mb-6 sm:mb-8">
            <!-- Logo mobile -->
            <div class="flex items-center justify-center lg:hidden mb-4">
                <div class="bg-primary-900 p-3 rounded-full mr-3">
                    <i class="fas fa-exchange-alt text-white text-xl"></i>
                </div>
                <span class="text-2xl font-bold text-primary-900">ExchangeRUB</span>
            </div>
            
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Rejoignez ExchangeRUB</h1>
            <p class="text-gray-600 mt-2 text-sm sm:text-base">Créez votre compte pour commencer à échanger</p>
        </div>

        <!-- Navigation par onglets -->
        <div class="flex border-b border-gray-200 mb-6">
            <a href="{{route('login')}}" class="py-3 px-4 sm:px-6 font-medium text-center text-gray-500 w-1/2 hover:text-primary-600 transition duration-200 text-sm sm:text-base">
                Connexion
            </a>
            <button class="py-3 px-4 sm:px-6 font-medium text-center text-primary-600 border-b-2 border-primary-600 w-1/2 text-sm sm:text-base" id="register-tab">
                Inscription
            </button>
        </div>

        <!-- Formulaire d'inscription -->
        <form id="register-form" action="{{ route('register.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-4 sm:space-y-5">
            @csrf
            
            <!-- Nom complet -->
            <div>
                <label for="register-name" class="block text-gray-700 font-medium mb-2 text-sm sm:text-base">Nom complet</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400 text-sm sm:text-base"></i>
                    </div>
                    <input type="text" id="register-name" name="name" 
                           class="pl-10 w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition text-sm sm:text-base"
                           placeholder="Votre nom complet" required value="{{ old('name') }}">
                </div>
                @error('name')
                    <span class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>
            
            <!-- Email -->
            <div>
                <label for="register-email" class="block text-gray-700 font-medium mb-2 text-sm sm:text-base">Adresse email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400 text-sm sm:text-base"></i>
                    </div>
                    <input type="email" id="register-email" name="email" 
                           class="pl-10 w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition text-sm sm:text-base"
                           placeholder="votre@email.com" required value="{{ old('email') }}">
                </div>
                @error('email')
                    <span class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <!-- Numéro de passeport -->
            <div>
                <label for="register-num_passport" class="block text-gray-700 font-medium mb-2 text-sm sm:text-base">Numéro du passeport</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-id-card text-gray-400 text-sm sm:text-base"></i>
                    </div>
                    <input type="text" id="register-num_passport" name="num_passport" 
                           class="pl-10 w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition text-sm sm:text-base"
                           placeholder="Votre numéro de passeport" required value="{{ old('num_passport') }}">
                </div>
                @error('num_passport')
                    <span class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <!-- Image du passeport -->
            <div>
                <label for="register-img_passport" class="block text-gray-700 font-medium mb-2 text-sm sm:text-base">
                    Image du passeport
                    <span class="text-xs text-gray-500 font-normal">(Format accepté: JPG, PNG, PDF - Max: 2MB)</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-camera text-gray-400 text-sm sm:text-base"></i>
                    </div>
                    <input type="file" id="register-img_passport" name="img_passport" 
                           accept=".jpg,.jpeg,.png,.pdf,.JPG,.JPEG,.PNG,.PDF"
                           class="pl-10 w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition text-sm sm:text-base file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100"
                           required>
                </div>
                @error('img_passport')
                    <span class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div>
                <label for="register-password" class="block text-gray-700 font-medium mb-2 text-sm sm:text-base">Mot de passe</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400 text-sm sm:text-base"></i>
                    </div>
                    <input type="password" id="register-password" name="password" 
                           class="pl-10 pr-10 w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition text-sm sm:text-base"
                           placeholder="Créez un mot de passe" required>
                    <button type="button" class="password-toggle absolute inset-y-0 right-0 pr-3 flex items-center" data-target="register-password">
                        <i class="fas fa-eye text-gray-400 hover:text-gray-600 transition duration-200"></i>
                    </button>
                </div>
                @error('password')
                    <span class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>
            
            <!-- Confirmation mot de passe -->
            <div>
                <label for="register-confirm-password" class="block text-gray-700 font-medium mb-2 text-sm sm:text-base">Confirmer le mot de passe</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400 text-sm sm:text-base"></i>
                    </div>
                    <input type="password" id="register-confirm-password" name="password_confirmation" 
                           class="pl-10 w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition text-sm sm:text-base"
                           placeholder="Confirmez votre mot de passe" required>
                </div>
            </div>
            
            <!-- Conditions d'utilisation -->
            <div class="flex items-start mb-4 sm:mb-6">
                <input type="checkbox" id="terms-agree" name="terms" 
                       class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded mt-1 flex-shrink-0" required>
                <label for="terms-agree" class="ml-2 block text-xs sm:text-sm text-gray-700 leading-relaxed">
                    J'accepte les <a href="#" class="text-primary-600 hover:underline font-medium">conditions d'utilisation</a> 
                    et la <a href="#" class="text-primary-600 hover:underline font-medium">politique de confidentialité</a>
                </label>
            </div>
            
            <!-- Bouton d'inscription -->
            <button type="submit" 
                    class="w-full bg-primary-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-primary-700 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transform hover:scale-[1.02] text-sm sm:text-base">
                <span class="flex items-center justify-center">
                    <i class="fas fa-user-plus mr-2"></i>
                    Créer un compte
                </span>
            </button>
            
            <!-- Séparateur -->
            <div class="relative flex items-center my-4 sm:my-6">
                <div class="flex-grow border-t border-gray-300"></div>
                <span class="flex-shrink mx-4 text-gray-500 text-sm">Ou</span>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>
            
            <!-- Bouton Google -->
            <button type="button" 
                    class="w-full bg-white border border-gray-300 text-gray-700 py-3 px-4 rounded-lg font-medium hover:bg-gray-50 transition flex items-center justify-center text-sm sm:text-base">
                <i class="fab fa-google text-red-500 mr-2 text-sm sm:text-base"></i> 
                <span class="sm:inline">S'inscrire avec Google</span>
            </button>
            
            <!-- Lien de connexion -->
            <div class="text-center mt-4 sm:mt-6">
                <span class="text-gray-600 text-sm sm:text-base">Vous avez déjà un compte?</span>
                <a href="{{ route('login') }}" class="text-primary-600 font-medium hover:underline ml-1 text-sm sm:text-base">Se connecter</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('ownscript')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fonction pour basculer la visibilité du mot de passe
        function togglePasswordVisibility(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.querySelector(`[data-target="${inputId}"] i`);
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
                icon.classList.add('text-primary-600');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.remove('text-primary-600');
                icon.classList.add('fa-eye');
            }
        }

        // Initialisation des bascules de mot de passe
        const passwordToggles = document.querySelectorAll('.password-toggle');
        passwordToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                togglePasswordVisibility(targetId);
            });
        });

        // Validation améliorée du formulaire
        const registerForm = document.getElementById('register-form');
        const passwordInput = document.getElementById('register-password');
        const confirmPasswordInput = document.getElementById('register-confirm-password');
        
        // Validation en temps réel de la correspondance des mots de passe
        function validatePasswords() {
            if (passwordInput.value && confirmPasswordInput.value) {
                if (passwordInput.value !== confirmPasswordInput.value) {
                    confirmPasswordInput.classList.add('border-red-500');
                    confirmPasswordInput.classList.remove('border-gray-300');
                } else {
                    confirmPasswordInput.classList.remove('border-red-500');
                    confirmPasswordInput.classList.add('border-gray-300');
                }
            }
        }

        passwordInput.addEventListener('input', validatePasswords);
        confirmPasswordInput.addEventListener('input', validatePasswords);

        // Validation du fichier
        const fileInput = document.getElementById('register-img_passport');
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const fileSize = file.size / 1024 / 1024; // Taille en MB
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
                
                if (!allowedTypes.includes(file.type)) {
                    alert('Format de fichier non supporté. Veuillez choisir un fichier JPG, PNG ou PDF.');
                    this.value = '';
                } else if (fileSize > 2) {
                    alert('Le fichier est trop volumineux. Taille maximum: 2MB.');
                    this.value = '';
                }
            }
        });

        // Animation des erreurs de validation
        @if($errors->any())
            const errorElements = document.querySelectorAll('[id^="register-"]');
            errorElements.forEach(element => {
                if (element.value) {
                    element.classList.add('border-red-500');
                    setTimeout(() => {
                        element.classList.remove('border-red-500');
                    }, 3000);
                }
            });
        @endif

        // Amélioration UX sur mobile
        if (window.innerWidth < 768) {
            // Focus sur le premier champ vide en cas d'erreur
            const firstError = document.querySelector('.text-red-500');
            if (firstError) {
                const input = firstError.closest('div').previousElementSibling;
                if (input && input.tagName === 'INPUT') {
                    input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        }
    });
</script>

<style>
    /* Animations */
    .form-container {
        animation: fadeInUp 0.6s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Améliorations pour les très petits écrans */
    @media (max-width: 360px) {
        .auth-container {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }
        
        .text-mobile-xs {
            font-size: 0.75rem;
        }
    }

    /* Styles pour le fichier upload */
    input[type="file"]::-webkit-file-upload-button {
        visibility: hidden;
    }

    input[type="file"]::before {
        content: 'Choisir un fichier';
        display: inline-block;
        background: linear-gradient(to bottom, #f9f9f9, #e3e3e3);
        border: 1px solid #999;
        border-radius: 3px;
        padding: 5px 8px;
        outline: none;
        white-space: nowrap;
        cursor: pointer;
        font-weight: 700;
        font-size: 10pt;
    }

    input[type="file"]:hover::before {
        border-color: black;
    }

    /* Amélioration du focus */
    input:focus, button:focus, select:focus {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.1);
    }

    /* Transition pour les bordures */
    input, select {
        transition: all 0.3s ease;
    }
</style>
@endsection