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

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Échangez entre RUB et FCFA en toute simplicité</h1>
                <p>Des taux compétitifs, des transactions sécurisées et un service rapide pour tous vos échanges entre le Rouble Russe et le Franc CFA.</p>
                <a href="{{ route('exchange.create') }}" class="btn btn-primary">Faire un échange maintenant</a>
            </div>
        </div>
    </section>

    <!-- Converter Section -->
    <section id="converter" class="container">
        <div class="container">
            <div class="converter">
                <h2 class="converter-title">Convertisseur de devises</h2>
                <form action="{{ route('exchange.confirm') }}" method="GET">
                    <input type="hidden" name="from_currency" id="hidden-from-currency" value="FCFA">
                    <input type="hidden" name="to_currency" id="hidden-to-currency" value="RUB">
        
                    <div class="converter-form">
                        <div class="input-group">
                            <div class="input-field">
                                <label>Je donne</label>
                                <input type="number" id="amount" placeholder="Montant" name="amount">
                            </div>
                            <div class="input-field">
                                <label>Devise</label>
                                <select id="from-currency" name="from_currency">
                                    <option value="RUB">Rouble Russe (RUB)</option>
                                    <option value="FCFA" selected>Franc CFA (FCFA)</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="input-group">
                            <button class="switch-btn" id="switch-currencies">
                                <i class="fas fa-exchange-alt"></i>
                            </button>
                        </div>
                        
                        <div class="input-group">
                            <div class="input-field">
                                <label>Je reçois</label>
                                <input type="number" id="converted-amount" placeholder="Montant converti" readonly>
                            </div>
                            <div class="input-field">
                                <label>Devise</label>
                                <select id="to-currency" name="to_currency">
                                    <option value="RUB" selected>Rouble Russe (RUB)</option>
                                    <option value="FCFA">Franc CFA (FCFA)</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="result">
                            <p><span id="conversion-result">0.00</span> <span id="result-currency">RUB</span></p>
                        </div>
                        
                        <!-- Bouton pour procéder à l'échange -->
                        <button type="submit" class="submit-btn">Procéder à l'échange</button>
                    </div>
            </form>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <h2 class="section-title">Pourquoi nous choisir ?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h3>Transactions sécurisées</h3>
                    <p>Vos transactions sont cryptées et protégées par les normes de sécurité les plus strictes.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Taux compétitifs</h3>
                    <p>Nous proposons les meilleurs taux du marché pour vos échanges RUB/FCFA.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3>Transactions rapides</h3>
                    <p>Vos fonds sont transférés en moins de 24 heures, souvent en quelques minutes.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3>Support 24/7</h3>
                    <p>Notre équipe est disponible à tout moment pour répondre à vos questions.</p>
                </div>
            </div>
        </div>
    </section>

   <!-- Rates Section -->
    <section class="rates">
        <div class="container">
            <h2 class="section-title">Taux de change actuels</h2>
            <table class="rates-table">
                <thead>
                    <tr>
                        <th>Devise source</th>
                        <th>Devise cible</th>
                        <th>Taux d'échange</th>
                        <th>Dernière mise à jour</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($exchangeRates as $rate)
                    <tr>
                        <td>{{ $rate->from_currency }}</td>
                        <td>{{ $rate->to_currency }}</td>
                        <td>{{ $rate->rate }}</td>
                        <td>{{ $rate->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

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
                        <li><i class="fas fa-phone"></i> +7 950 857 -08 -91</li>
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
            // Éléments du DOM
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