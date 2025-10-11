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
        /* Reset et styles de base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8fafc;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Header responsive */
        header {
            background: linear-gradient(135deg, #4a6cf7 0%, #3a5cd8 100%);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

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

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .logo i {
            font-size: 1.75rem;
        }

        .nav-links {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
            list-style: none;
        }

        @media (min-width: 768px) {
            .nav-links {
                gap: 2rem;
            }
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.3s;
            font-weight: 500;
        }

        .nav-links a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Hero section responsive */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem 0;
            text-align: center;
        }

        @media (min-width: 768px) {
            .hero {
                padding: 5rem 0;
            }
        }

        .hero-content h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        @media (min-width: 768px) {
            .hero-content h1 {
                font-size: 3rem;
            }
        }

        .hero-content p {
            font-size: 1.125rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }

        @media (min-width: 768px) {
            .hero-content p {
                font-size: 1.25rem;
            }
        }

        /* Converter section responsive */
        #converter {
            padding: 3rem 0;
        }

        @media (min-width: 768px) {
            #converter {
                padding: 5rem 0;
            }
        }

        .converter {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 800px;
            margin: 0 auto;
        }

        @media (min-width: 768px) {
            .converter {
                padding: 3rem;
            }
        }

        .converter-title {
            text-align: center;
            font-size: 1.75rem;
            margin-bottom: 2rem;
            color: #2d3748;
            font-weight: 700;
        }

        @media (min-width: 768px) {
            .converter-title {
                font-size: 2.25rem;
            }
        }

        .converter-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        @media (min-width: 768px) {
            .converter-form {
                gap: 2rem;
            }
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        @media (min-width: 640px) {
            .input-group {
                flex-direction: row;
                align-items: end;
            }
        }

        .input-field {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .input-field label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #4a5568;
            font-size: 0.875rem;
        }

        @media (min-width: 768px) {
            .input-field label {
                font-size: 1rem;
            }
        }

        .input-field input,
        .input-field select {
            padding: 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.3s;
            width: 100%;
        }

        .input-field input:focus,
        .input-field select:focus {
            outline: none;
            border-color: #4a6cf7;
            box-shadow: 0 0 0 3px rgba(74, 108, 247, 0.1);
        }

        .input-field input[readonly] {
            background-color: #f7fafc;
            color: #718096;
        }

        /* Switch button */
        .switch-btn {
            background: #4a6cf7;
            color: white;
            border: none;
            border-radius: 50%;
            width: 3rem;
            height: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            align-self: center;
            margin: 1rem 0;
        }

        @media (min-width: 640px) {
            .switch-btn {
                margin: 0 1rem;
                align-self: end;
                margin-bottom: 0.5rem;
            }
        }

        .switch-btn:hover {
            background: #3a5cd8;
            transform: scale(1.05);
        }

        .switch-btn i {
            font-size: 1.25rem;
        }

        /* Result section */
        .result {
            text-align: center;
            padding: 1.5rem;
            background: linear-gradient(135deg, #f0f5ff 0%, #e6f0ff 100%);
            border-radius: 0.75rem;
            border: 2px dashed #4a6cf7;
        }

        .result p {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d3748;
        }

        @media (min-width: 768px) {
            .result p {
                font-size: 2rem;
            }
        }

        #conversion-result {
            color: #4a6cf7;
        }

        #result-currency {
            color: #718096;
            font-size: 1.25rem;
        }

        @media (min-width: 768px) {
            #result-currency {
                font-size: 1.5rem;
            }
        }

        /* Submit button */
        .submit-btn {
            background: linear-gradient(135deg, #4a6cf7 0%, #3a5cd8 100%);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 0.75rem;
            font-size: 1.125rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
            margin-top: 1rem;
        }

        @media (min-width: 768px) {
            .submit-btn {
                width: auto;
                margin-top: 0;
                align-self: center;
                padding: 1.25rem 3rem;
            }
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(74, 108, 247, 0.3);
        }

        /* Mobile menu */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            position: absolute;
            top: 1rem;
            right: 1rem;
        }

        @media (max-width: 767px) {
            .mobile-menu-btn {
                display: block;
            }

            .nav-links {
                display: none;
                flex-direction: column;
                width: 100%;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 0.5rem;
                padding: 1rem;
                margin-top: 1rem;
            }

            .nav-links.show {
                display: flex;
            }

            .nav-links li {
                width: 100%;
            }

            .nav-links a {
                display: block;
                text-align: center;
                padding: 0.75rem 1rem;
            }
        }

        /* Animation pour les résultats */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .result {
            animation: fadeInUp 0.5s ease-out;
        }

        /* Loading state */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        /* Error state */
        .error {
            border-color: #e53e3e !important;
            background-color: #fed7d7;
        }

        /* Success state */
        .success {
            border-color: #38a169 !important;
            background-color: #f0fff4;
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

                <!-- Mobile Menu Button -->
                <button class="mobile-menu-btn" id="mobileMenuBtn">
                    <i class="fas fa-bars"></i>
                </button>

                <ul class="nav-links" id="navLinks">
                    <li><a href="{{route('home')}}">Accueil</a></li>
                    <li><a href="{{ route('exchange_rates') }}">Taux de change</a></li>
                    <li><a href="{{route('work')}}">Comment ça marche</a></li>
                    <li><a href="{{route('propos')}}">À propos</a></li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Échangez entre RUB et FCFA en toute simplicité</h1>
                <p>Des taux compétitifs, des transactions sécurisées et un service rapide pour tous vos échanges entre le Rouble Russe et le Franc CFA.</p>
            </div>
        </div>
    </section>

    <!-- Converter Section -->
    <section id="converter">
        <div class="container">
            <div class="converter">
                <h2 class="converter-title">Convertisseur de devises</h2>
                <form action="{{ route('exchange.confirm') }}" method="GET">
                    <input type="hidden" name="from_currency" id="hidden-from-currency" value="FCFA">
                    <input type="hidden" name="to_currency" id="hidden-to-currency" value="RUB">
        
                    <div class="converter-form">
                        <!-- First input group -->
                        <div class="input-group">
                            <div class="input-field">
                                <label for="amount">Je donne</label>
                                <input type="number" id="amount" placeholder="Montant" name="amount" min="0" step="0.01">
                            </div>
                            <div class="input-field">
                                <label for="from-currency">Devise</label>
                                <select id="from-currency" name="from_currency">
                                    <option value="RUB">Rouble Russe (RUB)</option>
                                    <option value="FCFA" selected>Franc CFA (FCFA)</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Switch button -->
                        <div class="input-group">
                            <button type="button" class="switch-btn" id="switch-currencies">
                                <i class="fas fa-exchange-alt"></i>
                            </button>
                        </div>
                        
                        <!-- Second input group -->
                        <div class="input-group">
                            <div class="input-field">
                                <label for="converted-amount">Je reçois</label>
                                <input type="number" id="converted-amount" placeholder="Montant converti" readonly>
                            </div>
                            <div class="input-field">
                                <label for="to-currency">Devise</label>
                                <select id="to-currency" name="to_currency">
                                    <option value="RUB" selected>Rouble Russe (RUB)</option>
                                    <option value="FCFA">Franc CFA (FCFA)</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Result display -->
                        <div class="result">
                            <p><span id="conversion-result">0.00</span> <span id="result-currency">RUB</span></p>
                        </div>
                        
                        <!-- Submit button -->
                        <button type="submit" class="submit-btn">Procéder à l'échange</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

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
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const navLinks = document.getElementById('navLinks');
            
            // Menu mobile
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', function() {
                    navLinks.classList.toggle('show');
                });
            }

            // Fermer le menu mobile en cliquant à l'extérieur
            document.addEventListener('click', function(event) {
                if (!event.target.closest('.header-content') && navLinks.classList.contains('show')) {
                    navLinks.classList.remove('show');
                }
            });

            // Taux de change
            const exchangeRates = {
                'FCFA_RUB': {{ @app('App\Models\ExchangeRate')::getRate('FCFA', 'RUB') ?? 0.14 }},
                'RUB_FCFA': {{ @app('App\Models\ExchangeRate')::getRate('RUB', 'FCFA') ?? 7.14 }}
            };
            
            // Fonction de conversion
            function convertCurrency() {
                const amount = parseFloat(amountInput.value);
                const from = fromCurrency.value;
                const to = toCurrency.value;
                
                // Mise à jour des champs cachés
                document.getElementById('hidden-from-currency').value = from;
                document.getElementById('hidden-to-currency').value = to;
                
                if (isNaN(amount) || amount <= 0) {
                    convertedAmount.value = "";
                    conversionResult.textContent = "0.00";
                    amountInput.classList.add('error');
                    return;
                }
                
                amountInput.classList.remove('error');
                
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
                
                // Animation du résultat
                const resultElement = document.querySelector('.result');
                resultElement.style.animation = 'none';
                setTimeout(() => {
                    resultElement.style.animation = 'fadeInUp 0.5s ease-out';
                }, 10);
            }
            
            // Échanger les devises
            function switchCurrencies() {
                const temp = fromCurrency.value;
                fromCurrency.value = toCurrency.value;
                toCurrency.value = temp;
                
                convertCurrency();
                
                // Animation du bouton switch
                switchBtn.style.transform = 'rotate(180deg)';
                setTimeout(() => {
                    switchBtn.style.transform = 'rotate(0)';
                }, 300);
            }
            
            // Événements
            amountInput.addEventListener('input', convertCurrency);
            fromCurrency.addEventListener('change', convertCurrency);
            toCurrency.addEventListener('change', convertCurrency);
            switchBtn.addEventListener('click', switchCurrencies);
            
            // Conversion initiale
            convertCurrency();

            // Gestion du redimensionnement
            window.addEventListener('resize', function() {
                if (window.innerWidth > 767) {
                    navLinks.classList.remove('show');
                }
            });

            // Validation du formulaire
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const amount = parseFloat(amountInput.value);
                if (isNaN(amount) || amount <= 0) {
                    e.preventDefault();
                    amountInput.classList.add('error');
                    amountInput.focus();
                    return false;
                }
            });
        });
    </script>
</body>
</html>