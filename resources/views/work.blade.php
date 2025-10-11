<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExchangeRUB - Échangez RUB et FCFA en toute simplicité</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
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
            top: 50%;
            right: 0;
            background-color: rgba(73, 80, 141, 0.527);
            min-width: 160px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            z-index: 1000;
            display: none;
            margin-top: 2px;
        }
        
        .user-dropdown a {
            display: block;
            padding: 8px 12px;
            color: #e0d7d7;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        
        .user-dropdown a:hover {
            background-color: #f5f5f5;
        }
        
        .user-menu:hover .user-dropdown {
            display: block;
        }
        
        .auth-buttons {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="header-content">
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
                <div class="auth-section">
                    @auth
                    <!-- Menu utilisateur connecté -->
                    <div class="user-menu">
                        <div class="user-toggle">
                            <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                            <span>{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down" style="margin-left: 8px;"></i>
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
                        <a href="login" class="btn btn-outline">Se connecter</a>
                        <a href="register" class="btn btn-primary">S'inscrire</a>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </header>

  

    <!-- How It Works -->
    <section class="how-it-works">
        <div class="container">
            <h2 class="section-title">Comment ça marche</h2>
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h3>Inscription</h3>
                    <p>Créez votre compte en quelques minutes</p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h3>Sélection</h3>
                    <p>Choisissez les devises et le montant à échanger</p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h3>Paiement</h3>
                    <p>Effectuez le paiement de vos fonds</p>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <h3>Réception</h3>
                    <p>Recevez vos fonds convertis</p>
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
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact</h3>
                    <ul class="footer-links">
                        <li><i class="fas fa-envelope"></i> rubexchange@mail.ru</li>
                        <li><i class="fas fa-phone"></i> +7 950 857-08-91</li>
                        <li><i class="fas fa-map-marker-alt"></i> Russie</li>
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
            </div>
            <div class="copyright">
                <p>&copy; 2025 ExchangeRUB. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Taux de change (exemple)
            const exchangeRates = {
            'FCFA_RUB': {{ @app('App\Models\ExchangeRate')::getRate('FCFA', 'RUB') ?? 0.14 }},
            'RUB_FCFA': {{ @app('App\Models\ExchangeRate')::getRate('RUB', 'FCFA') ?? 7.14 }}
            };
            
            // Éléments du convertisseur
            const amountInput = document.getElementById('amount');
            const fromCurrency = document.getElementById('from-currency');
            const toCurrency = document.getElementById('to-currency');
            const convertedAmount = document.getElementById('converted-amount');
            const conversionResult = document.getElementById('conversion-result');
            const resultCurrency = document.getElementById('result-currency');
            const switchBtn = document.getElementById('switch-currencies');
            
            // Fonction de conversion
            function convertCurrency() {
                const amount = parseFloat(amountInput.value);
                const from = fromCurrency.value;
                const to = toCurrency.value;
                
                if (isNaN(amount)) {
                    convertedAmount.value = '';
                    conversionResult.textContent = '0.00';
                    return;
                }
                
                if (from === to) {
                    convertedAmount.value = amount;
                    conversionResult.textContent = amount.toFixed(2);
                    resultCurrency.textContent = to;
                    return;
                }
                
                const rate = exchangeRates[from][to];
                const result = amount * rate;
                
                convertedAmount.value = result.toFixed(2);
                conversionResult.textContent = result.toFixed(2);
                resultCurrency.textContent = to;
            }
            
            // Événements
            amountInput.addEventListener('input', convertCurrency);
            fromCurrency.addEventListener('change', convertCurrency);
            toCurrency.addEventListener('change', convertCurrency);
            
            // Bouton pour inverser les devises
            switchBtn.addEventListener('click', function() {
                const temp = fromCurrency.value;
                fromCurrency.value = toCurrency.value;
                toCurrency.value = temp;
                convertCurrency();
            });
            
            // Initialisation
            convertCurrency();
        });
    </script>
</body>
</html>