<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation d'échange - ExchangeRUB</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Styles responsives */
        .header-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }
        
        @media (min-width: 768px) {
            .header-content {
                flex-direction: row;
                justify-content: space-between;
            }
        }
        
        .nav-links {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
        }
        
        @media (min-width: 768px) {
            .nav-links {
                gap: 2rem;
            }
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        @media (min-width: 768px) {
            .footer-content {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (min-width: 1024px) {
            .footer-content {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        
        .mobile-menu-btn {
            display: none;
        }
        
        @media (max-width: 767px) {
            .mobile-menu-btn {
                display: block;
            }
            
            .nav-links {
                display: none;
                flex-direction: column;
                width: 100%;
                background: white;
                border-radius: 0.5rem;
                padding: 1rem;
                margin-top: 1rem;
            }
            
            .nav-links.show {
                display: flex;
            }
        }
        
        /* Animation pour la prévisualisation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.3s ease-out;
        }
    </style>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="header-content">
                <div class="logo flex items-center gap-2 text-xl font-bold text-blue-600">
                    <i class="fas fa-exchange-alt"></i>
                    <span>ExchangeRUB</span>
                </div>

                <!-- Menu mobile -->
                <button class="mobile-menu-btn md:hidden bg-blue-600 text-white p-2 rounded">
                    <i class="fas fa-bars"></i>
                </button>

                <ul class="nav-links text-gray-600">
                    <li><a href="{{ route('home') }}" class="hover:text-blue-600 transition">Accueil</a></li>
                    <li><a href="{{ route('exchange_rates') }}" class="hover:text-blue-600 transition">Taux de change</a></li>
                    <li><a href="{{ route('work') }}" class="hover:text-blue-600 transition">Comment ça marche</a></li>
                    <li><a href="{{ route('propos') }}" class="hover:text-blue-600 transition">À propos</a></li>
                </ul>

                <div class="flex items-center space-x-4">
                    <span class="text-gray-600 hidden sm:block">Bonjour, {{ Auth::user()->name }}</span>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                       class="bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700 transition text-sm sm:text-base">
                        <i class="fas fa-sign-out-alt mr-1"></i>
                        <span class="hidden sm:inline">Déconnexion</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="bg-white rounded-lg shadow-md p-4 sm:p-6 md:p-8">
            <!-- En-tête -->
            <div class="text-center mb-6 sm:mb-8">
                <h1 class="text-2xl sm:text-3xl font-bold text-blue-800">Confirmation de votre échange</h1>
                <p class="text-gray-600 text-sm sm:text-base mt-2">Veuillez vérifier les détails de votre transaction</p>
            </div>

            <!-- Récapitulatif de l'échange -->
            <div class="bg-blue-50 rounded-lg p-4 sm:p-6 mb-6">
                <h2 class="text-lg sm:text-xl font-semibold mb-4">Récapitulatif de l'échange</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="text-center sm:text-left">
                        <p class="text-gray-600 text-sm sm:text-base">Vous envoyez</p>
                        <p class="text-xl sm:text-2xl font-bold text-red-600">{{ number_format($amount, 0, ',', ' ') }} {{ $from_currency }}</p>
                    </div>
                    <div class="text-center sm:text-left">
                        <p class="text-gray-600 text-sm sm:text-base">Vous recevez</p>
                        <p class="text-xl sm:text-2xl font-bold text-green-600">{{ number_format($converted_amount, 0, ',', ' ') }} {{ $to_currency }}</p>
                    </div>
                </div>

                <div class="border-t pt-4">
                    <p class="text-sm text-gray-600 flex items-center justify-center sm:justify-start">
                        <i class="fas fa-info-circle mr-2"></i>
                        Taux de change: 1 {{ $from_currency }} = {{ number_format($exchange_rate, 4) }} {{ $to_currency }}
                    </p>
                </div>
            </div>

            <!-- Instructions de paiement -->
            <div class="bg-yellow-50 rounded-lg p-4 sm:p-6 mb-6">
                <h2 class="text-lg sm:text-xl font-semibold mb-4">Instructions de paiement</h2>
                
                @if($from_currency == 'FCFA')
                <div class="bg-white rounded-lg p-4 mb-4">
                    <h3 class="font-semibold text-green-600 mb-3 flex items-center gap-2">
                        <i class="fas fa-mobile-alt"></i>
                        Paiement en FCFA (Bénin)
                    </h3>
                    <p class="mb-3 text-sm sm:text-base">Veuillez envoyer <strong class="text-lg">{{ number_format($amount, 0, ',', ' ') }} FCFA</strong> au numéro suivant :</p>
                    <div class="bg-gray-100 p-3 rounded-lg mb-3">
                        <p class="text-center font-mono text-base sm:text-lg font-bold text-green-700">
                            {{ $payment_numbers['FCFA'] ?? '+229 01 96 45 51 48' }}
                        </p>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-clock mr-2"></i>
                        <span>Le traitement prendra 15-30 minutes après réception</span>
                    </div>
                </div>
                @else
                <div class="bg-white rounded-lg p-4 mb-4">
                    <h3 class="font-semibold text-blue-600 mb-3 flex items-center gap-2">
                        <i class="fas fa-university"></i>
                        Paiement en RUB (Russie)
                    </h3>
                    <p class="mb-3 text-sm sm:text-base">Veuillez envoyer <strong class="text-lg">{{ number_format($amount, 0, ',', ' ') }} RUB</strong> au numéro de compte suivant :</p>
                    <div class="bg-gray-100 p-3 rounded-lg mb-3">
                        <p class="text-center font-mono text-base sm:text-lg font-bold text-blue-700">
                            {{ $payment_numbers['RUB'] ?? '2200702005511220' }}
                        </p>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-clock mr-2"></i>
                        <span>Le traitement prendra 15-30 minutes après réception</span>
                    </div>
                </div>
                @endif

                <div class="bg-red-50 border border-red-200 rounded-lg p-3 sm:p-4">
                    <p class="text-red-600 text-sm flex items-start gap-2">
                        <i class="fas fa-exclamation-triangle mt-1"></i>
                        <span><strong>Important:</strong> Ne validez la transaction QUE après avoir effectué le paiement. Une fois validé, vous ne pourrez plus annuler.</span>
                    </p>
                </div>
            </div>

            <!-- Formulaire de preuve de paiement -->
            <form action="{{ route('exchange.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg p-4 sm:p-6 border">
                @csrf
                
                <!-- Champs cachés avec les données de l'échange -->
                <input type="hidden" name="amount" value="{{ $amount }}">
                <input type="hidden" name="from_currency" value="{{ $from_currency }}">
                <input type="hidden" name="to_currency" value="{{ $to_currency }}">
                <input type="hidden" name="converted_amount" value="{{ $converted_amount }}">
                <input type="hidden" name="exchange_rate" value="{{ $exchange_rate }}">

                <!-- Preuve de paiement -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-3 text-sm sm:text-base">
                        <i class="fas fa-camera mr-2"></i>Preuve de paiement
                    </label>
                    <p class="text-sm text-gray-600 mb-3">
                        Veuillez uploader une capture d'écran ou photo du reçu de transfert
                    </p>
                    
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 sm:p-6 text-center hover:border-blue-400 transition duration-200">
                        <div class="mb-3">
                            <i class="fas fa-cloud-upload-alt text-2xl sm:text-3xl text-blue-500"></i>
                        </div>
                        <input type="file" name="payment_proof" id="payment_proof" 
                               class="hidden" accept="image/*,.pdf" required>
                        <label for="payment_proof" class="cursor-pointer bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200 text-sm sm:text-base inline-block">
                            <i class="fas fa-upload mr-2"></i>Choisir une image
                        </label>
                        <p class="text-xs sm:text-sm text-gray-500 mt-2">Formats acceptés: JPG, PNG, JPEG, PDF (Max: 5MB)</p>
                    </div>
                    
                    <div id="image-preview" class="mt-4 hidden fade-in">
                        <p class="text-sm text-gray-600 mb-2">Aperçu :</p>
                        <div class="border rounded-lg p-2 bg-gray-50">
                            <img id="preview" class="max-w-full max-h-48 object-contain mx-auto rounded">
                            <p id="file-name" class="text-center text-sm text-gray-600 mt-2"></p>
                        </div>
                        <button type="button" id="remove-image" class="text-red-500 text-sm mt-2 hover:text-red-700">
                            <i class="fas fa-times mr-1"></i>Supprimer l'image
                        </button>
                    </div>
                </div>

                <!-- Informations supplémentaires -->
                <div class="mb-6">
                    <label for="sender_number" class="block text-gray-700 font-semibold mb-2 text-sm sm:text-base">
                        <i class="fas fa-phone mr-2"></i>Votre numéro (optionnel)
                    </label>
                    <input type="text" name="sender_number" id="sender_number" 
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base"
                           placeholder="Ex: +229 XX XX XX XX ou +7 XXX XXX XX XX">
                    <p class="text-xs text-gray-500 mt-1">Pour vous contacter en cas de besoin</p>
                </div>

                <!-- Checkbox de confirmation -->
                <div class="mb-6">
                    <label class="flex items-start">
                        <input type="checkbox" name="confirmation" 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mt-1 flex-shrink-0" required>
                        <span class="ml-2 text-gray-700 text-sm sm:text-base">
                            Je confirme avoir effectué le paiement de <strong>{{ number_format($amount, 0, ',', ' ') }} {{ $from_currency }}</strong> 
                            vers le numéro <strong>{{ $from_currency == 'FCFA' ? ($payment_numbers['FCFA'] ?? '+229 01 96 45 51 48') : ($payment_numbers['RUB'] ?? '2200702005511220') }}</strong>
                        </span>
                    </label>
                </div>

                <!-- Boutons d'action -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ url()->previous() }}" class="flex-1 bg-gray-500 text-white py-3 px-4 sm:px-6 rounded-lg text-center hover:bg-gray-600 transition duration-200 text-sm sm:text-base">
                        <i class="fas fa-arrow-left mr-2"></i>Retour
                    </a>
                    <button type="submit" id="submit-btn" 
                            class="flex-1 bg-green-500 text-white py-3 px-4 sm:px-6 rounded-lg hover:bg-green-600 transition duration-200 text-sm sm:text-base font-semibold">
                        <i class="fas fa-check-circle mr-2"></i>Valider l'échange
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="container mx-auto px-4 py-8">
            <div class="footer-content">
                <div class="footer-section">
                    <h3 class="text-lg font-semibold mb-4">ExchangeRUB</h3>
                    <p class="text-gray-300 text-sm mb-4">La solution simple et sécurisée pour tous vos échanges entre le Rouble Russe et le Franc CFA.</p>
                    <div class="social-links flex gap-3">
                        <a href="#" class="bg-gray-700 w-8 h-8 rounded-full flex items-center justify-center hover:bg-blue-600 transition"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="bg-gray-700 w-8 h-8 rounded-full flex items-center justify-center hover:bg-blue-400 transition"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="bg-gray-700 w-8 h-8 rounded-full flex items-center justify-center hover:bg-pink-600 transition"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="bg-gray-700 w-8 h-8 rounded-full flex items-center justify-center hover:bg-blue-700 transition"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h3 class="text-lg font-semibold mb-4">Liens rapides</h3>
                    <ul class="footer-links space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition text-sm">Accueil</a></li>
                        <li><a href="{{route('propos')}}" class="text-gray-300 hover:text-white transition text-sm">À propos</a></li>
                        <li><a href="{{ route('exchange_rates') }}" class="text-gray-300 hover:text-white transition text-sm">Taux de change</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3 class="text-lg font-semibold mb-4">Services</h3>
                    <ul class="footer-links space-y-2">
                        <li><a href="{{ route('exchange.create') }}" class="text-gray-300 hover:text-white transition text-sm">Échange RUB/FCFA</a></li>
                        <li><a href="{{ route('exchange.create') }}" class="text-gray-300 hover:text-white transition text-sm">Échange FCFA/RUB</a></li>
                        <li><a href="{{ route('exchange.create') }}" class="text-gray-300 hover:text-white transition text-sm">Transfert d'argent</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3 class="text-lg font-semibold mb-4">Contact</h3>
                    <ul class="footer-links space-y-2 text-sm text-gray-300">
                        <li class="flex items-center gap-2"><i class="fas fa-envelope"></i> rubexchange@mail.ru</li>
                        <li class="flex items-center gap-2"><i class="fas fa-phone"></i> +7 950 857-08-91</li>
                        <li class="flex items-center gap-2"><i class="fas fa-map-marker-alt"></i> Russie</li>
                    </ul>
                </div>
            </div>
            <div class="copyright border-t border-gray-700 mt-8 pt-6 text-center">
                <p class="text-gray-400 text-sm">&copy; 2025 ExchangeRUB. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        // Menu mobile
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            const navLinks = document.querySelector('.nav-links');
            
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', function() {
                    navLinks.classList.toggle('show');
                });
            }

            // Prévisualisation de l'image
            const fileInput = document.getElementById('payment_proof');
            const previewContainer = document.getElementById('image-preview');
            const preview = document.getElementById('preview');
            const fileName = document.getElementById('file-name');
            const removeBtn = document.getElementById('remove-image');

            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Vérification de la taille (5MB max)
                    if (file.size > 5 * 1024 * 1024) {
                        alert('Le fichier est trop volumineux. Taille maximum: 5MB');
                        this.value = '';
                        return;
                    }

                    // Vérification du type
                    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
                    if (!allowedTypes.includes(file.type)) {
                        alert('Format de fichier non supporté. Veuillez choisir une image JPG, PNG ou PDF.');
                        this.value = '';
                        return;
                    }

                    if (file.type === 'application/pdf') {
                        preview.src = 'https://cdn-icons-png.flaticon.com/512/337/337946.png';
                        preview.alt = 'PDF Document';
                        preview.style.maxHeight = '100px';
                    } else {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.alt = 'Aperçu du reçu';
                            preview.style.maxHeight = '192px';
                        }
                        reader.readAsDataURL(file);
                    }
                    
                    fileName.textContent = file.name;
                    previewContainer.classList.remove('hidden');
                }
            });

            // Supprimer l'image
            removeBtn.addEventListener('click', function() {
                fileInput.value = '';
                previewContainer.classList.add('hidden');
            });

            // Validation du formulaire
            const form = document.querySelector('form');
            const submitBtn = document.getElementById('submit-btn');
            const confirmationCheckbox = document.querySelector('input[name="confirmation"]');

            form.addEventListener('submit', function(e) {
                if (!confirmationCheckbox.checked) {
                    e.preventDefault();
                    alert('Veuillez confirmer avoir effectué le paiement en cochant la case.');
                    confirmationCheckbox.focus();
                    return;
                }

                if (!fileInput.files[0]) {
                    e.preventDefault();
                    alert('Veuillez sélectionner une preuve de paiement.');
                    fileInput.focus();
                    return;
                }

                // Désactiver le bouton pour éviter les doubles clics
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Traitement en cours...';
            });

            // Gestion du redimensionnement
            window.addEventListener('resize', function() {
                if (window.innerWidth > 767) {
                    navLinks.classList.remove('show');
                }
            });
        });
    </script>
</body>
</html>