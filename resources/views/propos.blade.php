<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos - ExchangeRUB</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .hero-pattern {
            background: linear-gradient(135deg, #4a6cf7 0%, #6a11cb 100%);
        }
        .value-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .value-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .team-member {
            transition: transform 0.3s ease;
        }
        .team-member:hover {
            transform: scale(1.03);
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #4a6cf7, #6a11cb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-32">
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
                <div class="flex-1 items-center space-x-8">
                    @auth
                    <span >Bonjour, {{ Auth::user()->name }}</span>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        Déconnexion
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 transition">Connexion</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        Inscription
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-pattern text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Notre Mission: Révolutionner l'Échange de Devises</h1>
            <p class="text-xl max-w-3xl mx-auto mb-8">ExchangeRUB facilite les transferts entre le Rouble Russe et le Franc CFA avec rapidité, sécurité et transparence.</p>
            <a href="{{ route('register') }}" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-medium hover:bg-gray-100 transition">
                Commencer maintenant
            </a>
        </div>
    </section>

    <!-- Notre Histoire -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Notre Histoire</h2>
                    <p class="text-gray-600 mb-4">
                        Fondée en 2025, ExchangeRUB est née d'un constat simple : les échanges entre la Russie et les pays africains de la zone Franc CFA étaient complexes, coûteux et peu transparents.
                    </p>
                    <p class="text-gray-600 mb-4">
                        Notre équipe de spécialistes en finance internationale et en technologie s'est donnée pour mission de simplifier ces transactions, en offrant une plateforme sécurisée, rapide et économique.
                    </p>
                    <p class="text-gray-600">
                        Aujourd'hui, nous sommes fiers de compter des milliers d'utilisateurs satisfaits et d'avoir traité plusieurs millions d'euros en transactions.
                    </p>
                </div>
                <div class="md:w-1/2 md:pl-12">
                    <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" 
                         alt="Équipe ExchangeRUB" class="rounded-lg shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Nos Valeurs -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Nos Valeurs</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="value-card bg-white p-8 rounded-lg shadow text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-shield-alt text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Sécurité</h3>
                    <p class="text-gray-600">La sécurité de vos fonds et de vos données personnelles est notre priorité absolue. Nous utilisons les technologies de cryptage les plus avancées.</p>
                </div>
                <div class="value-card bg-white p-8 rounded-lg shadow text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-hand-holding-usd text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Transparence</h3>
                    <p class="text-gray-600">Aucun frais caché, aucun mauvais surprise. Nous affichons clairement nos taux et nos commissions avant chaque transaction.</p>
                </div>
                <div class="value-card bg-white p-8 rounded-lg shadow text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-bolt text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Rapidité</h3>
                    <p class="text-gray-600">Nous traitons la majorité des transactions en moins de 24 heures, et souvent en quelques minutes seulement. Votre temps est précieux.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistiques -->
    <section class="py-16 bg-blue-600 text-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="stat-number">1 000+</div>
                    <p class="text-blue-100">Clients satisfaits</p>
                </div>
                <div>
                    <div class="stat-number">5M+</div>
                    <p class="text-blue-100">RUB échangés</p>
                </div>
                <div>
                    <div class="stat-number">99.7%</div>
                    <p class="text-blue-100">Transactions réussies</p>
                </div>
                <div>
                    <div class="stat-number">24/7</div>
                    <p class="text-blue-100">Support client</p>
                </div>
            </div>
        </div>
    </section>

    

    <!-- FAQ -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Questions Fréquentes</h2>
            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-xl font-semibold mb-2">Comment fonctionne ExchangeRUB ?</h3>
                    <p class="text-gray-600">ExchangeRUB agit comme intermédiaire entre les personnes souhaitant échanger des RUB contre des FCFA et vice-versa. Nous garantissons les meilleurs taux et une transaction sécurisée.</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-xl font-semibold mb-2">Quels sont les frais appliqués ?</h3>
                    <p class="text-gray-600">Nos frais sont parmi les plus compétitifs du marché. Ils sont toujours indiqués clairement avant validation de toute transaction, sans surprise.</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-xl font-semibold mb-2">Combien de temps prend une transaction ?</h3>
                    <p class="text-gray-600">La majorité des transactions sont traitées en moins de 24 heures. Les transactions simples peuvent être exécutées en quelques minutes.</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold mb-2">Est-ce sécurisé ?</h3>
                    <p class="text-gray-600">Absolument. Nous utilisons un cryptage de niveau bancaire et respectons toutes les réglementations en vigueur pour garantir la sécurité de vos fonds et données.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-16 bg-blue-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Prêt à commencer ?</h2>
            <p class="text-xl max-w-2xl mx-auto mb-8">Rejoignez les milliers de clients qui nous font confiance pour leurs échanges entre le Rouble Russe et le Franc CFA.</p>
            <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-4 rounded-lg font-medium text-lg hover:bg-gray-100 transition">
                Créer un compte gratuit
            </a>
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
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 ExchangeRUB. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>