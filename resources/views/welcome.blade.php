<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExchangeRUB - Échangez RUB et FCFA en toute simplicité</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Styles pour le menu utilisateur */
        .user-menu {
            position: relative;
            display: inline-block;
        }
        
        .user-toggle {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        
        .user-toggle:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #08090c;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            font-weight: bold;
        }
        
        .user-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: rgba(73, 80, 141, 0.95);
            min-width: 160px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            z-index: 1000;
            display: none;
            margin-top: 5px;
        }
        
        .user-dropdown a {
            display: block;
            padding: 10px 12px;
            color: #e0d7d7;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        
        .user-dropdown a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        .user-menu:hover .user-dropdown {
            display: block;
        }
        
        .auth-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
        }

        /* Header responsive */
        .header-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
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
            gap: 1.5rem;
            margin: 1rem 0;
        }

        @media (min-width: 768px) {
            .nav-links {
                margin: 0;
            }
        }

        .nav-links li a {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .nav-links li a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Hero section responsive */
        .hero {
            padding: 3rem 1rem;
            text-align: center;
        }

        @media (min-width: 768px) {
            .hero {
                padding: 5rem 1rem;
            }
        }

        .hero h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        @media (min-width: 768px) {
            .hero h1 {
                font-size: 3rem;
            }
        }

        /* Converter responsive */
        .converter-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        @media (min-width: 768px) {
            .converter-form {
                flex-direction: row;
                align-items: center;
                justify-content: center;
            }
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            flex: 1;
        }

        @media (min-width: 640px) {
            .input-group {
                flex-direction: row;
            }
        }

        .input-field {
            flex: 1;
        }

        .switch-btn {
            align-self: center;
            margin: 1rem 0;
        }

        @media (min-width: 768px) {
            .switch-btn {
                margin: 0 1rem;
            }
        }

        /* Features grid responsive */
        .features-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        @media (min-width: 640px) {
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .features-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        /* Rates table responsive */
        .rates-table {
            width: 100%;
            overflow-x: auto;
            display: block;
        }

        @media (max-width: 768px) {
            .rates-table {
                font-size: 0.875rem;
            }
            
            .rates-table th,
            .rates-table td {
                padding: 0.5rem;
            }
        }

        /* Steps responsive */
        .steps {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        @media (min-width: 640px) {
            .steps {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .steps {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        .step {
            text-align: center;
            padding: 1.5rem;
        }

        /* Footer responsive */
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

        .footer-section {
            text-align: center;
        }

        @media (min-width: 768px) {
            .footer-section {
                text-align: left;
            }
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1rem;
        }

        @media (min-width: 768px) {
            .social-links {
                justify-content: flex-start;
            }
        }

        /* Mobile menu */
        .mobile-menu-btn {
            display: block;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            position: absolute;
            top: 1rem;
            right: 1rem;
        }

        @media (min-width: 768px) {
            .mobile-menu-btn {
                display: none;
            }
        }

        .nav-links-mobile {
            display: none;
            flex-direction: column;
            gap: 1rem;
            margin-top: 1rem;
            width: 100%;
        }

        .nav-links-mobile.show {
            display: flex;
        }

        @media (min-width: 768px) {
            .nav-links-mobile {
                display: none !important;
            }
        }

        /* Container responsive */
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* General responsive improvements */
        .section-title {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 1.5rem;
        }

        @media (min-width: 768px) {
            .section-title {
                font-size: 2rem;
            }
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s;
            font-weight: 500;
        }

        .btn-primary {
            background-color: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2563eb;
        }

        .btn-outline {
            border: 1px solid white;
            color: white;
        }

        .btn-outline:hover {
            background-color: white;
            color: #3b82f6;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-blue-600 text-white">
        <div class="container">
            <div class="header-content">
                <div class="logo flex items-center text-xl font-bold">
                    <i class="fas fa-exchange-alt mr-2"></i>
                    <span>ExchangeRUB</span>
                </div>

                <!-- Desktop Navigation -->
                <ul class="nav-links hidden md:flex">
                    <li><a href="{{ route('home') }}">Accueil</a></li>
                    <li><a href="{{ route('exchange_rates') }}">Taux de change</a></li>
                    <li><a href="{{ route('work') }}">Comment ça marche</a></li>
                    <li><a href="{{ route('propos') }}">À propos</a></li>
                </ul>

                <!-- Mobile Menu Button -->
                <button class="mobile-menu-btn md:hidden">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Mobile Navigation -->
                <ul class="nav-links-mobile md:hidden bg-blue-700 rounded-lg p-4">
                    <li><a href="{{ route('home') }}" class="block py-2 px-4 hover:bg-blue-600 rounded">Accueil</a></li>
                    <li><a href="{{ route('exchange_rates') }}" class="block py-2 px-4 hover:bg-blue-600 rounded">Taux de change</a></li>
                    <li><a href="{{ route('work') }}" class="block py-2 px-4 hover:bg-blue-600 rounded">Comment ça marche</a></li>
                    <li><a href="{{ route('propos') }}" class="block py-2 px-4 hover:bg-blue-600 rounded">À propos</a></li>
                </ul>

                <div class="auth-section">
                    @auth
                    <!-- Menu utilisateur connecté -->
                    <div class="user-menu">
                        <div class="user-toggle">
                            <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                            <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down ml-2"></i>
                        </div>
                        <div class="user-dropdown">
                            <a href="{{ route('transaction') }}">Mes transactions</a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    @else
                    <!-- Boutons de connexion et d'inscription -->
                    <div class="auth-buttons">
                        <a href="login" class="btn btn-outline text-sm">Se connecter</a>
                        <a href="register" class="btn btn-primary text-sm">S'inscrire</a>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="container">
            <div class="hero-content max-w-4xl mx-auto">
                <h1 class="font-bold leading-tight">Échangez entre RUB et FCFA en toute simplicité</h1>
                <p class="text-xl mb-8 opacity-90">Des taux compétitifs, des transactions sécurisées et un service rapide pour tous vos échanges entre le Rouble Russe et le Franc CFA.</p>
                <a href="{{ route('exchange.create') }}" class="btn btn-primary text-lg">Faire un échange maintenant</a>
            </div>
        </div>
    </section>

    <!-- Converter Section -->
    <section id="converter" class="py-12 bg-white">
        <div class="container">
            <div class="converter max-w-4xl mx-auto bg-gray-50 rounded-lg shadow-md p-6">
                <h2 class="converter-title text-2xl font-bold text-center mb-8">Convertisseur de devises</h2>
                <form action="{{ route('exchange.confirm') }}" method="GET">
                    <input type="hidden" name="from_currency" id="hidden-from-currency" value="FCFA">
                    <input type="hidden" name="to_currency" id="hidden-to-currency" value="RUB">
        
                    <div class="converter-form">
                        <div class="input-group">
                            <div class="input-field">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Je donne</label>
                                <input type="number" id="amount" placeholder="Montant" name="amount" 
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div class="input-field">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Devise</label>
                                <select id="from-currency" name="from_currency" 
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="RUB">Rouble Russe (RUB)</option>
                                    <option value="FCFA" selected>Franc CFA (FCFA)</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="input-group">
                            <button type="button" class="switch-btn bg-blue-600 text-white p-3 rounded-full hover:bg-blue-700 transition duration-300">
                                <i class="fas fa-exchange-alt"></i>
                            </button>
                        </div>
                        
                        <div class="input-group">
                            <div class="input-field">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Je reçois</label>
                                <input type="number" id="converted-amount" placeholder="Montant converti" readonly
                                       class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100">
                            </div>
                            <div class="input-field">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Devise</label>
                                <select id="to-currency" name="to_currency" 
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="RUB" selected>Rouble Russe (RUB)</option>
                                    <option value="FCFA">Franc CFA (FCFA)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="result bg-blue-50 rounded-lg p-4 mt-6 text-center">
                        <p class="text-lg font-semibold">
                            <span id="conversion-result">0.00</span> 
                            <span id="result-currency">RUB</span>
                        </p>
                    </div>
                    
                    <!-- Bouton pour procéder à l'échange -->
                    <button type="submit" class="submit-btn w-full bg-blue-600 text-white p-4 rounded-lg hover:bg-blue-700 transition duration-300 mt-6 font-semibold text-lg">
                        Procéder à l'échange
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features py-12 bg-gray-50">
        <div class="container">
            <h2 class="section-title font-bold text-gray-800">Pourquoi nous choisir ?</h2>
            <div class="features-grid">
                <div class="feature-card bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition duration-300">
                    <div class="feature-icon bg-blue-100 text-blue-600 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-lock text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Transactions sécurisées</h3>
                    <p class="text-gray-600">Vos transactions sont cryptées et protégées par les normes de sécurité les plus strictes.</p>
                </div>
                <div class="feature-card bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition duration-300">
                    <div class="feature-icon bg-blue-100 text-blue-600 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-chart-line text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Taux compétitifs</h3>
                    <p class="text-gray-600">Nous proposons les meilleurs taux du marché pour vos échanges RUB/FCFA.</p>
                </div>
                <div class="feature-card bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition duration-300">
                    <div class="feature-icon bg-blue-100 text-blue-600 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-bolt text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Transactions rapides</h3>
                    <p class="text-gray-600">Vos fonds sont transférés en moins de 24 heures, souvent en quelques minutes.</p>
                </div>
                <div class="feature-card bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition duration-300">
                    <div class="feature-icon bg-blue-100 text-blue-600 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-headset text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Support 24/7</h3>
                    <p class="text-gray-600">Notre équipe est disponible à tout moment pour répondre à vos questions.</p>
                </div>
            </div>
        </div>
    </section>

   <!-- Rates Section -->
    <section class="rates py-12 bg-white">
        <div class="container">
            <h2 class="section-title font-bold text-gray-800">Taux de change actuels</h2>
            <div class="overflow-x-auto">
                <table class="rates-table min-w-full bg-white rounded-lg overflow-hidden shadow-md">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="py-3 px-4 text-left">Devise source</th>
                            <th class="py-3 px-4 text-left">Devise cible</th>
                            <th class="py-3 px-4 text-left">Taux d'échange</th>
                            <th class="py-3 px-4 text-left">Dernière mise à jour</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($exchangeRates as $rate)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $rate->from_currency }}</td>
                            <td class="py-3 px-4">{{ $rate->to_currency }}</td>
                            <td class="py-3 px-4">{{ $rate->rate }}</td>
                            <td class="py-3 px-4">{{ $rate->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works py-12 bg-gray-50">
        <div class="container">
            <h2 class="section-title font-bold text-gray-800">Comment ça marche</h2>
            <div class="steps">
                <div class="step bg-white rounded-lg shadow-md p-6">
                    <div class="step-number bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
                    <h3 class="text-xl font-semibold text-center mb-3">Inscription</h3>
                    <p class="text-gray-600 text-center">Créez votre compte en quelques minutes</p>
                </div>
                <div class="step bg-white rounded-lg shadow-md p-6">
                    <div class="step-number bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
                    <h3 class="text-xl font-semibold text-center mb-3">Sélection</h3>
                    <p class="text-gray-600 text-center">Choisissez les devises et le montant à échanger</p>
                </div>
                <div class="step bg-white rounded-lg shadow-md p-6">
                    <div class="step-number bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
                    <h3 class="text-xl font-semibold text-center mb-3">Paiement</h3>
                    <p class="text-gray-600 text-center">Effectuez le paiement de vos fonds</p>
                </div>
                <div class="step bg-white rounded-lg shadow-md p-6">
                    <div class="step-number bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-4 text-xl font-bold">4</div>
                    <h3 class="text-xl font-semibold text-center mb-3">Réception</h3>
                    <p class="text-gray-600 text-center">Recevez vos fonds convertis</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container mx-auto">
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
                        <li><a href="{{ route('admin.exchange_rates') }}">Taux en direct</a></li>
                        <li>
                            <a href="{{ asset('apk/exchangerub.apk') }}" 
                            class="hover:text-white transition flex items-center gap-2 text-green-400 hover:text-green-300 font-semibold"
                            download="ExchangeRUB-App.apk">
                                <i class="fas fa-download"></i>
                                Télécharger l'App
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact</h3>
                    <ul class="footer-links">
                        <li><i class="fas fa-envelope"></i> rubexchange@mail.ru</li>
                        <li><i class="fas fa-phone"></i> +7 950 857-08-91</li>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Menu mobile
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            const mobileNav = document.querySelector('.nav-links-mobile');
            
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', function() {
                    mobileNav.classList.toggle('show');
                });
            }

            // Éléments du DOM pour le convertisseur
            const amountInput = document.getElementById('amount');
            const fromCurrency = document.getElementById('from-currency');
            const toCurrency = document.getElementById('to-currency');
            const convertedAmount = document.getElementById('converted-amount');
            const switchBtn = document.getElementById('switch-currencies');
            const conversionResult = document.getElementById('conversion-result');
            const resultCurrency = document.getElementById('result-currency');
            
            // Taux de change (fixe pour cet exemple)
            const exchangeRates = {
                'FCFA_RUB': {{ @app('App\Models\ExchangeRate')::getRate('FCFA', 'RUB') ?? 0.14 }},
                'RUB_FCFA': {{ @app('App\Models\ExchangeRate')::getRate('RUB', 'FCFA') ?? 7.14 }}
            };
            
            // Fonction de conversion
            function convertCurrency() {
                const amount = parseFloat(amountInput.value);
                const from = fromCurrency.value;
                const to = toCurrency.value;
                
                if (isNaN(amount) || amount <= 0) {
                    convertedAmount.value = "Montant invalide";
                    conversionResult.textContent = "0.00";
                    return;
                }
                
                let result;
                
                if (from === to) {
                    result = amount;
                } else {
                    const rateKey = `${from}_${to}`;
                    result = amount * exchangeRates[rateKey];
                }
                
                convertedAmount.value = result.toFixed(2);
                conversionResult.textContent = result.toFixed(2);
                resultCurrency.textContent = to;
            }
            
            // Échanger les devises
            function switchCurrencies() {
                const temp = fromCurrency.value;
                fromCurrency.value = toCurrency.value;
                toCurrency.value = temp;
                
                convertCurrency();
            }
            
            // Événements
            amountInput.addEventListener('input', convertCurrency);
            fromCurrency.addEventListener('change', convertCurrency);
            toCurrency.addEventListener('change', convertCurrency);
            switchBtn.addEventListener('click', switchCurrencies);
            
            // Conversion initiale
            convertCurrency();
        });
    </script>
</body>
</html>