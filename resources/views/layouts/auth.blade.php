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
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden w-full max-w-5xl">
        <div class="md:flex">
            <!-- Section gauche avec illustration -->
            <div class="md:w-1/2 bg-gradient-to-br from-primary-900 to-primary-800 text-white p-8 md:p-12 flex flex-col justify-center items-center text-center">
                <div class="mb-8 flex items-center justify-center">
                    <div class="bg-white p-2 rounded-full mr-3">
                        <i class="fas fa-exchange-alt text-primary-900 text-2xl"></i>
                    </div>
                    <span class="text-2xl font-bold">ExchangeRUB</span>
                </div>
                
                <svg class="auth-illustration w-64 h-64 my-8" viewBox="0 0 500 400" xmlns="http://www.w3.org/2000/svg">
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
                
                <h2 class="text-2xl font-bold mb-4">Échangez RUB et FCFA en toute simplicité</h2>
                <p class="opacity-90">Rejoignez notre plateforme sécurisée pour tous vos échanges entre le Rouble Russe et le Franc CFA.</p>
            </div>
            
            <!-- Section droite avec formulaire -->
            <div class="md:w-1/2 p-8 md:p-12">
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        // Fonctions JavaScript communes
        function togglePasswordVisibility(inputId, iconElement) {
            const input = document.getElementById(inputId);
            
            if (input.type === 'password') {
                input.type = 'text';
                iconElement.classList.remove('fa-eye');
                iconElement.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                iconElement.classList.remove('fa-eye-slash');
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
        });
    </script>
    
</body>
</html>