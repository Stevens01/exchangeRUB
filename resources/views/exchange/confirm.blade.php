<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation d'échange - ExchangeRUB</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="logo">
                    <i class="fas fa-exchange-alt"></i>
                    <span>ExchangeRUB</span>
                </div>
               <ul class="nav-links">
                    <li><a href="{{ route('home') }}">Accueil</a></li>
                    <li><a href="{{ route('exchange_rates') }}">Taux de change</a></li>
                    <li><a href="{{ route('work') }}">Comment ça marche</a></li>
                    <li><a href="{{ route('propos') }}">À propos</a></li>
                </ul>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Bonjour, {{ Auth::user()->name }}</span>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        Déconnexion
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="bg-white rounded-lg shadow-md p-6">
            <!-- En-tête -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-blue-800">Confirmation de votre échange</h1>
                <p class="text-gray-600">Veuillez vérifier les détails de votre transaction</p>
            </div>

            <!-- Récapitulatif de l'échange -->
            <div class="bg-blue-50 rounded-lg p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Récapitulatif de l'échange</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-gray-600">Vous envoyez</p>
                        <p class="text-2xl font-bold">{{ $amount }} {{ $from_currency }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Vous recevez</p>
                        <p class="text-2xl font-bold">{{ $converted_amount }} {{ $to_currency }}</p>
                    </div>
                </div>

                <div class="border-t pt-4">
                    <p class="text-sm text-gray-600">
                        <i class="fas fa-info-circle mr-2"></i>
                        Taux de change: 1 {{ $from_currency }} = {{ $exchange_rate }} {{ $to_currency }}
                    </p>
                </div>
            </div>

            <!-- Instructions de paiement -->
            <div class="bg-yellow-50 rounded-lg p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Instructions de paiement</h2>
                
                @if($from_currency == 'FCFA')
                <div class="bg-white rounded-lg p-4 mb-4">
                    <h3 class="font-semibold text-green-600 mb-2">📱 Paiement en FCFA (Bénin)</h3>
                    <p class="mb-2">Veuillez envoyer <strong>{{ $amount }} FCFA</strong> au numéro suivant :</p>
                    <div class="bg-gray-100 p-3 rounded-lg">
                        <p class="text-center font-mono text-lg font-bold">+229 01 96 45 51 48</p>
                    </div>
                    <p class="text-sm text-gray-600 mt-2">
                        <i class="fas fa-clock mr-1"></i> Le traitement prendra 15-30 minutes après réception
                    </p>
                </div>
                @else
                <div class="bg-white rounded-lg p-4 mb-4">
                    <h3 class="font-semibold text-blue-600 mb-2">📱 Paiement en RUB (Russie)</h3>
                    <p class="mb-2">Veuillez envoyer <strong>{{ $amount }} RUB</strong> au numéro de compte suivant :</p>
                    <div class="bg-gray-100 p-3 rounded-lg">
                        <p class="text-center font-mono text-lg font-bold">2200702005511220</p>
                    </div>
                    <p class="text-sm text-gray-600 mt-2">
                        <i class="fas fa-clock mr-1"></i> Le traitement prendra 15-30 minutes après réception
                    </p>
                </div>
                @endif

                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <p class="text-red-600 text-sm">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <strong>Important:</strong> Ne validez la transaction QUE après avoir effectué le paiement.
                    </p>
                </div>
            </div>

            <!-- Formulaire de preuve de paiement -->
            <form action="{{ route('exchange.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg p-6 border">
                @csrf
                
                <!-- Champs cachés avec les données de l'échange -->
                <input type="hidden" name="amount" value="{{ $amount }}">
                <input type="hidden" name="from_currency" value="{{ $from_currency }}">
                <input type="hidden" name="to_currency" value="{{ $to_currency }}">
                <input type="hidden" name="converted_amount" value="{{ $converted_amount }}">
                <input type="hidden" name="exchange_rate" value="{{ $exchange_rate }}">

                <!-- Preuve de paiement -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-camera mr-2"></i>Preuve de paiement
                    </label>
                    <p class="text-sm text-gray-600 mb-3">
                        Veuillez uploader une capture d'écran ou photo du reçu de transfert
                    </p>
                    
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                        <div class="mb-3">
                            <i class="fas fa-cloud-upload-alt text-3xl text-blue-500"></i>
                        </div>
                        <input type="file" name="payment_proof" id="payment_proof" 
                               class="hidden" accept="image/*" required>
                        <label for="payment_proof" class="cursor-pointer bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                            Choisir une image
                        </label>
                        <p class="text-sm text-gray-500 mt-2">Formats acceptés: JPG, PNG, JPEG (Max: 2MB)</p>
                    </div>
                    
                    <div id="image-preview" class="mt-3 hidden">
                        <img id="preview" class="max-w-full h-48 object-contain rounded-lg border">
                    </div>
                </div>

                <!-- Informations supplémentaires -->
                <div class="mb-6">
                    <label for="sender_number" class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-phone mr-2"></i>Votre numéro (optionnel)
                    </label>
                    <input type="text" name="sender_number" id="sender_number" 
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                           placeholder="Votre numéro pour les notifications">
                </div>

                <!-- Checkbox de confirmation -->
                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="confirmation" 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required>
                        <span class="ml-2 text-gray-700">
                            Je confirme avoir effectué le paiement vers le numéro indiqué
                        </span>
                    </label>
                </div>

                <!-- Boutons d'action -->
                <div class="flex space-x-4">
                    <a href="{{ url()->previous() }}" class="flex-1 bg-gray-500 text-white py-3 px-6 rounded-lg text-center hover:bg-gray-600">
                        <i class="fas fa-arrow-left mr-2"></i>Retour
                    </a>
                    <button type="submit" class="flex-1 bg-green-500 text-white py-3 px-6 rounded-lg hover:bg-green-600">
                        <i class="fas fa-check-circle mr-2"></i>Valider l'échange
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>ExchangeRUB</h3>
                    <p>La solution simple et sécurisée pour tous vos échanges entre le Rouble Russe et le Franc CFA.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h3>Liens rapides</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Accueil</a></li>
                        <li><a href="{{route('propos')}}">À propos</a></li>
                        <li><a href="{{ route('exchange_rates') }}">Taux de change</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Services</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('exchange.create') }}">Échange RUB/FCFA</a></li>
                        <li><a href="{{ route('exchange.create') }}">Échange FCFA/RUB</a></li>
                        <li><a href="{{ route('exchange.create') }}">Transfert d'argent</a></li>
                        <li><a href="{{ route('admin.exchange_rates') }}') }}">Taux en direct</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact</h3>
                    <ul class="footer-links">
                        <li><i class="fas fa-envelope"></i> rubexchange@mail.ru</li>
                        <li><i class="fas fa-phone"></i> +7 ... ...-..-..</li>
                        <li><i class="fas fa-map-marker-alt"></i> Russie</li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 ExchangeRUB. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        // Prévisualisation de l'image
        document.getElementById('payment_proof').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('preview');
                    preview.src = e.target.result;
                    document.getElementById('image-preview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // Empêcher la soumission si la confirmation n'est pas cochée
        document.querySelector('form').addEventListener('submit', function(e) {
            const confirmation = document.querySelector('input[name="confirmation"]');
            if (!confirmation.checked) {
                e.preventDefault();
                alert('Veuillez confirmer avoir effectué le paiement.');
            }
        });
    </script>
</body>
</html>