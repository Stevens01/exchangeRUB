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
            <div class="flex flex-col md:flex-row items-center justify-between">
                <!-- Logo -->
                <div class="logo mb-4 md:mb-0 flex items-center">
                    <i class="fas fa-exchange-alt text-blue-600 text-xl mr-2"></i>
                    <span class="text-xl font-bold text-gray-800">ExchangeRUB</span>
                </div>
                
                <!-- Navigation -->
                <nav class="w-full md:w-auto">
                    <ul class="nav-links flex flex-wrap justify-center md:justify-end space-x-0 md:space-x-6 space-y-2 md:space-y-0">
                        <li class="px-2 py-1 md:px-0 md:py-0">
                            <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 transition duration-300 font-medium">Accueil</a>
                        </li>
                        <li class="px-2 py-1 md:px-0 md:py-0">
                            <a href="{{ route('exchange_rates') }}" class="text-gray-600 hover:text-blue-600 transition duration-300 font-medium">Taux de change</a>
                        </li>
                        <li class="px-2 py-1 md:px-0 md:py-0">
                            <a href="{{ route('work') }}" class="text-gray-600 hover:text-blue-600 transition duration-300 font-medium">Comment ça marche</a>
                        </li>
                        <li class="px-2 py-1 md:px-0 md:py-0">
                            <a href="{{ route('propos') }}" class="text-gray-600 hover:text-blue-600 transition duration-300 font-medium">À propos</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="main-content">
             @yield('content')
        </div>
    </div>

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
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 ExchangeRUB. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
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

            // Menu mobile (optionnel - pour les écrans très petits)
            const menuToggle = document.createElement('button');
            menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
            menuToggle.className = 'md:hidden bg-blue-600 text-white p-2 rounded absolute top-4 right-4';
            
            const nav = document.querySelector('nav');
            const header = document.querySelector('header .container > div');
            
            if (window.innerWidth < 768) {
                header.style.position = 'relative';
                header.appendChild(menuToggle);
                
                menuToggle.addEventListener('click', function() {
                    nav.classList.toggle('hidden');
                });
            }
        });

        // Gestion du redimensionnement de la fenêtre
        window.addEventListener('resize', function() {
            const nav = document.querySelector('nav');
            if (window.innerWidth >= 768) {
                nav.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>