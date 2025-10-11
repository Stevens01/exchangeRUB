<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Authentification - ExchangeRUB')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f5ff',
                            100: '#e0e7ff',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#1a237e',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .password-toggle {
            cursor: pointer;
        }
        
        .auth-illustration {
            filter: drop-shadow(0 10px 15px rgba(0, 0, 0, 0.2));
        }

        /* Animation pour le formulaire */
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
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden w-full max-w-5xl mx-auto">
        <div class="flex flex-col lg:flex-row">
            <!-- Section gauche avec illustration - Cachée sur mobile -->
            <div class="lg:w-1/2 bg-gradient-to-br from-primary-900 to-primary-800 text-white p-6 md:p-8 lg:p-12 flex flex-col justify-center items-center text-center hidden lg:flex">
                <div class="mb-6 lg:mb-8 flex items-center justify-center">
                    <div class="bg-white p-2 rounded-full mr-3">
                        <i class="fas fa-exchange-alt text-primary-900 text-xl lg:text-2xl"></i>
                    </div>
                    <span class="text-xl lg:text-2xl font-bold">ExchangeRUB</span>
                </div>
                
                <!-- Illustration SVG responsive -->
                <div class="w-48 h-48 lg:w-64 lg:h-64 my-6 lg:my-8">
                    <svg class="auth-illustration w-full h-full" viewBox="0 0 500 400" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="250" cy="200" r="150" fill="rgba(255,255,255,0.1)" />
                        <circle cx="250" cy="200" r="120" fill="rgba(255,255,255,0.15)" />
                        <circle cx="250" cy="200" r="90" fill="rgba(255,255,255,0.2)" />
                        
                        <g transform="translate(200, 150)">
                            <path d="M50,100 C50,50 100,0 150,0 C200,0 250,50 250,100 C250,150 200,200 150,200 C100,200 50,150 50,100 Z" fill="rgba(255,255,255,0.9)" />
                            <text x="150" y="110" text-anchor="middle" fill="#1a237e" font-size="40" font-weight="bold">₣</text>
                            <text x="150" y="150" text-anchor="middle" fill="#1a237e" font-size="16">FCFA</text>
                        </g>
                        
                        <g transform="translate(100, 180)">
                            <path d="M0,50 C0,20 20,0 50,0 C80,0 100,20 100,50 C100,80 80,100 50,100 C20,100 0,80 0,50 Z" fill="rgba(255,255,255,0.9)" />
                            <text x="50" y="60" text-anchor="middle" fill="#1a237e" font-size="20" font-weight="bold">₽</text>
                        </g>
                        
                        <path d="M180,180 L320,120" stroke="rgba(255,255,255,0.8)" stroke-width="8" stroke-linecap="round" />
                        <path d="M320,120 L300,140" stroke="rgba(255,255,255,0.8)" stroke-width="8" stroke-linecap="round" />
                        <path d="M320,120 L340,140" stroke="rgba(255,255,255,0.8)" stroke-width="8" stroke-linecap="round" />
                    </svg>
                </div>
                
                <h2 class="text-xl lg:text-2xl font-bold mb-3 lg:mb-4">Échangez RUB et FCFA en toute simplicité</h2>
                <p class="opacity-90 text-sm lg:text-base">Rejoignez notre plateforme sécurisée pour tous vos échanges entre le Rouble Russe et le Franc CFA.</p>
            </div>
            
            <!-- Section droite avec formulaire -->
            <div class="lg:w-1/2 w-full p-4 sm:p-6 md:p-8 lg:p-12">
                <div class="flex items-center justify-center min-h-[80vh] lg:min-h-full py-4 lg:py-8 form-container">
                    <div class="w-full max-w-md space-y-6">
                        <!-- Logo mobile -->
                        <div class="flex items-center justify-center lg:hidden mb-6">
                            <div class="bg-primary-900 p-3 rounded-full mr-3">
                                <i class="fas fa-exchange-alt text-white text-xl"></i>
                            </div>
                            <span class="text-2xl font-bold text-primary-900">ExchangeRUB</span>
                        </div>

                        <div class="text-center">
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900">
                                Connexion à ExchangeRUB
                            </h2>
                            <p class="mt-2 text-sm text-gray-600 lg:hidden">
                                Échangez RUB et FCFA en toute simplicité
                            </p>
                        </div>
                        
                        <!-- Messages de session -->
                        @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 text-sm">
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    {{ session('success') }}
                                </div>
                            </div>
                        @endif
                        
                        @if(session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm">
                                <div class="flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ session('error') }}
                                </div>
                            </div>
                        @endif

                        <form class="space-y-4 sm:space-y-6" action="{{ route('login.submit') }}" method="POST">
                            @csrf
                            
                            <div class="space-y-4">
                                <!-- Champ Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Adresse email</label>
                                    <div class="relative">
                                        <input id="email" name="email" type="email" autocomplete="email" required
                                            class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm transition duration-200"
                                            placeholder="votre@email.com" value="{{ old('email') }}">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                            <i class="fas fa-envelope text-gray-400"></i>
                                        </div>
                                    </div>
                                    @error('email')
                                        <span class="text-red-500 text-xs mt-1 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-1"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <!-- Champ Mot de passe -->
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                                    <div class="relative">
                                        <input id="password" name="password" type="password" autocomplete="current-password" required
                                            class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm transition duration-200"
                                            placeholder="Votre mot de passe">
                                        <button type="button" class="password-toggle absolute inset-y-0 right-0 pr-3 flex items-center" data-target="password">
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
                            </div>

                            <!-- Options -->
                            <div class="flex flex-col sm:flex-row items-center justify-between space-y-3 sm:space-y-0">
                                <div class="flex items-center">
                                    <input id="remember" name="remember" type="checkbox"
                                        class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                                    <label for="remember" class="ml-2 block text-sm text-gray-900">
                                        Se souvenir de moi
                                    </label>
                                </div>

                                <div class="text-sm">
                                    <a href="#" class="font-medium text-primary-600 hover:text-primary-500 transition duration-200">
                                        Mot de passe oublié?
                                    </a>
                                </div>
                            </div>

                            <!-- Bouton de connexion -->
                            <div>
                                <button type="submit"
                                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-200 transform hover:scale-[1.02]">
                                    <span class="flex items-center">
                                        <i class="fas fa-sign-in-alt mr-2"></i>
                                        Se connecter
                                    </span>
                                </button>
                            </div>
                            
                            <!-- Lien d'inscription -->
                            <div class="text-center pt-4">
                                <p class="text-sm text-gray-600">
                                    Vous n'avez pas de compte?
                                    <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:text-primary-500 transition duration-200 ml-1">
                                        Créer un compte
                                    </a>
                                </p>
                            </div>
                        </form>

                        <!-- Séparateur optionnel pour les réseaux sociaux -->
                        <div class="mt-6">
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-white text-gray-500">Ou continuer avec</span>
                                </div>
                            </div>

                            <div class="mt-4 grid grid-cols-2 gap-3">
                                <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition duration-200">
                                    <i class="fab fa-google text-red-500"></i>
                                    <span class="ml-2">Google</span>
                                </a>

                                <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition duration-200">
                                    <i class="fab fa-facebook-f text-blue-600"></i>
                                    <span class="ml-2">Facebook</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fonction pour basculer la visibilité du mot de passe
        function togglePasswordVisibility(inputId, iconElement) {
            const input = document.getElementById(inputId);
            
            if (input.type === 'password') {
                input.type = 'text';
                iconElement.classList.remove('fa-eye');
                iconElement.classList.add('fa-eye-slash');
                iconElement.classList.add('text-primary-600');
            } else {
                input.type = 'password';
                iconElement.classList.remove('fa-eye-slash');
                iconElement.classList.remove('text-primary-600');
                iconElement.classList.add('fa-eye');
            }
        }
        
        // Initialisation des bascules de mot de passe
        document.addEventListener('DOMContentLoaded', function() {
            const passwordToggles = document.querySelectorAll('.password-toggle');
            passwordToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const icon = this.querySelector('i');
                    togglePasswordVisibility(targetId, icon);
                });
            });

            // Animation d'entrée pour les éléments du formulaire
            const formElements = document.querySelectorAll('input, button, a');
            formElements.forEach((element, index) => {
                element.style.animationDelay = `${index * 0.1}s`;
                element.classList.add('animate-fade-in-up');
            });
        });

        // Gestion responsive du redimensionnement
        window.addEventListener('resize', function() {
            // Ajustements spécifiques si nécessaire
            const illustration = document.querySelector('.auth-illustration');
            if (window.innerWidth < 1024) {
                // Cache certaines fonctionnalités sur mobile si nécessaire
            }
        });
    </script>

    <style>
        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
            opacity: 0;
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
            .container-mobile {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }
            
            .text-mobile-sm {
                font-size: 0.875rem;
            }
        }

        /* Effet de focus amélioré */
        input:focus, button:focus {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.1);
        }
    </style>
</body>
</html>