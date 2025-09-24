<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExchangeRUB - Échangez RUB et FCFA en toute simplicité</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
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