<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/rubex.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <header class="bg-blue-600 text-white relative z-50">
        <div class="flex justify-between items-center px-4 py-3">
          <!-- Logo -->
          <div class="flex items-center text-xl font-bold">
            <i class="fas fa-exchange-alt mr-2"></i>
            <span>ExchangeRUB</span>
          </div>

          <!-- Bouton burger (mobile uniquement) -->
          <button id="menu-toggle" class="md:hidden text-white text-2xl focus:outline-none" aria-label="Ouvrir le menu">
            <i class="fas fa-bars"></i>
          </button>

          <!-- Menu desktop -->
          <nav id="main-nav" class="hidden md:flex items-center space-x-6">
            <a href="{{ route('home') }}" class="nav-links hover:text-blue-200">Accueil</a>
            <a href="{{ route('exchange_rates') }}" class="nav-links hover:text-blue-200">Taux de change</a>
            <a href="{{ route('work') }}" class="nav-links hover:text-blue-200">Comment ça marche</a>
            <a href="{{ route('propos') }}" class="nav-links hover:text-blue-200">À propos</a>

            <!-- Auth section (desktop) -->
            <div class="auth-section ml-6">
              @auth
              <!-- Menu utilisateur connecté -->
              <div class="user-menu relative">
                <button type="button" class="user-toggle flex items-center cursor-pointer focus:outline-none" aria-haspopup="true" aria-expanded="false">
                  <div class="user-avatar bg-blue-500 text-white rounded-full w-8 h-8 flex items-center justify-center">
                    {{ substr(Auth::user()->name, 0, 1) }}
                  </div>
                  <span class="hidden sm:inline ml-2">{{ Auth::user()->name }}</span>
                  <i class="fas fa-chevron-down ml-2 text-sm"></i>
                </button>

                <div class="user-dropdown absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-lg shadow-lg hidden" role="menu" aria-hidden="true">
                  <a href="{{ route('transaction') }}" class="block px-4 py-2 hover:bg-gray-100" role="menuitem">Mes transactions</a>
                  <a href="{{ route('logout') }}"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                     class="block px-4 py-2 hover:bg-gray-100" role="menuitem">Déconnexion</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                  </form>
                </div>
              </div>
              @else
              <!-- Boutons de connexion et d'inscription -->
              <div class="auth-buttons flex space-x-2">
                <a href="{{ route('login') }}" class="btn btn-outline-warning border border-white rounded-lg px-3 py-1 hover:bg-white hover:text-blue-600 transition">Se connecter</a>
                <a href="{{ route('register') }}" class="btn btn-primary bg-white text-blue-600 rounded-lg px-3 py-1 hover:bg-blue-100 transition">S'inscrire</a>
              </div>
              @endauth
            </div>
          </nav>
        </div>

        <!-- Menu mobile -->
        <nav id="mobile-menu" class="hidden flex-col bg-blue-700 mx-3 mt-2 rounded-lg shadow-lg overflow-hidden transition-all duration-300 ease-in-out">
          <a href="{{ route('home') }}" class="block py-3 px-5 hover:bg-blue-500 hover:pl-6 transition-all duration-300">Accueil</a>
          <a href="{{ route('exchange_rates') }}" class="block py-3 px-5 hover:bg-blue-500 hover:pl-6 transition-all duration-300">Taux de change</a>
          <a href="{{ route('work') }}" class="block py-3 px-5 hover:bg-blue-500 hover:pl-6 transition-all duration-300">Comment ça marche</a>
          <a href="{{ route('propos') }}" class="block py-3 px-5 hover:bg-blue-500 hover:pl-6 transition-all duration-300">À propos</a>

          <!-- Auth section mobile -->
          <div class="border-t border-blue-500 mt-2">
            @auth
            <a href="{{ route('transaction') }}" class="block py-3 px-5 hover:bg-blue-500 hover:pl-6 transition-all duration-300">Mes transactions</a>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
               class="block py-3 px-5 hover:bg-blue-500 hover:pl-6 transition-all duration-300">Déconnexion</a>
            <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display:none;">
              @csrf
            </form>
            @else
            <div class="flex flex-col items-center space-y-3 p-4">
              <a href="{{ route('login') }}" class="w-full text-center border border-white rounded-lg py-2 hover:bg-white hover:text-blue-600 transition">Se connecter</a>
              <a href="{{ route('register') }}" class="w-full text-center bg-white text-blue-600 rounded-lg py-2 hover:bg-blue-100 transition">S'inscrire</a>
            </div>
            @endauth
          </div>
        </nav>
    </header>

    <!-- Main Content -->
    @yield('content')

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
                                    <a href="{{ asset('akp/exchangerub.apk') }}" 
                                    class="hover:text-white transition flex items-center gap-2 text-green-400 hover:text-green-300 font-semibold"
                                    download="exchangerub.apk">
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
    document.addEventListener('DOMContentLoaded', function () {
        // MOBILE MENU
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const mainNav = document.getElementById('main-nav');

        if (menuToggle && mobileMenu) {
            menuToggle.addEventListener('click', function (e) {
                e.stopPropagation();
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Ensure desktop nav visible on resize (prevents stuck hidden)
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 768 && mainNav) {
                mainNav.classList.remove('hidden');
            }
        });

        // USER DROPDOWN (desktop)
        const userToggle = document.querySelector('.user-toggle');
        const userDropdown = document.querySelector('.user-dropdown');

        if (userToggle && userDropdown) {
            // ouvrir/fermer
            userToggle.addEventListener('click', function (event) {
                event.stopPropagation();
                const isHidden = userDropdown.classList.contains('hidden');
                userDropdown.classList.toggle('hidden');
                // accessibility attributes
                userToggle.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
                userDropdown.setAttribute('aria-hidden', isHidden ? 'false' : 'true');
            });

            // fermer si click en dehors
            document.addEventListener('click', function (event) {
                if (!userDropdown.contains(event.target) && !userToggle.contains(event.target)) {
                    if (!userDropdown.classList.contains('hidden')) {
                        userDropdown.classList.add('hidden');
                        userToggle.setAttribute('aria-expanded', 'false');
                        userDropdown.setAttribute('aria-hidden', 'true');
                    }
                }
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    if (!userDropdown.classList.contains('hidden')) {
                        userDropdown.classList.add('hidden');
                        userToggle.setAttribute('aria-expanded', 'false');
                        userDropdown.setAttribute('aria-hidden', 'true');
                    }
                }
            });

            // empêcher fermeture quand clique dans le menu
            userDropdown.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        }

        if (!userToggle || !userDropdown) {
            // console.log('userToggle or userDropdown missing', !!userToggle, !!userDropdown);
        }
    });
    </script>
</body>
</html>
