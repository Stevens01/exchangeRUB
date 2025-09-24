<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Transactions - ExchangeRUB</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="https://cdn.tailwindcss.com"></script>
    
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
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
            </div>
        </div>
    </header>


    <!-- Main Content -->
    <div class="container">
        <div class="main-content">
             @yield('content')
        </div>
    </div>

    <script>
        // Script pour les filtres et interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Fonctionnalité de recherche en temps réel
            const searchInput = document.querySelector('input[type="text"]');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    const cards = document.querySelectorAll('.transaction-card');
                    
                    cards.forEach(card => {
                        const text = card.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>