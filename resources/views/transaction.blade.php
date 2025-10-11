<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Transactions - ExchangeRUB</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .transaction-card {
            transition: all 0.3s ease;
        }
        .transaction-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
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

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- En-tête de page -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Mes Transactions</h1>
            <p class="text-gray-600">Historique de toutes vos opérations d'échange</p>
        </div>

        <!-- Statistiques personnelles -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="rounded-full bg-green-100 p-3 mr-4">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Transactions complétées</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $completedCount }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="rounded-full bg-yellow-100 p-3 mr-4">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">En attente</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $pendingCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtres et Recherche -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" placeholder="Rechercher une transaction..." 
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <select class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                        <option>Tous les statuts</option>
                        <option>En attente</option>
                        <option>Complété</option>
                        <option>Rejeté</option>
                    </select>
                    <select class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                        <option>Tous les types</option>
                        <option>FCFA → RUB</option>
                        <option>RUB → FCFA</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Message si aucune transaction -->
        @if($transactions->isEmpty())
        <div class="bg-white rounded-lg shadow p-8 text-center">
            <div class="text-blue-600 text-5xl mb-4">
                <i class="fas fa-exchange-alt"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Aucune transaction pour le moment</h3>
            <p class="text-gray-600 mb-6">Vous n'avez effectué aucune transaction. Faites votre premier échange maintenant!</p>
            <a href="{{ route('exchange.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                Faire un échange
            </a>
        </div>
        @else
        <!-- Cartes de transactions (Vue mobile) -->
        <div class="md:hidden space-y-4">
            @foreach($transactions as $transaction)
            <div class="bg-white rounded-lg shadow transaction-card p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <span class="text-sm text-gray-500">#{{ $transaction->id }}</span>
                        <h3 class="font-semibold text-gray-800">{{ $transaction->currency_sended }} → {{ $transaction->currency_received }}</h3>
                    </div>
                    <span class="px-2 py-1 text-xs rounded-full {{ $transaction->status == 'complété' ? 'bg-green-100 text-green-800' : ($transaction->status == 'en attente' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                        {{ $transaction->status }}
                    </span>
                </div>
                
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Montant envoyé:</span>
                        <span class="font-medium">{{ number_format($transaction->amount_sended, 0, ',', ' ') }} {{ $transaction->currency_sended }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Montant reçu:</span>
                        <span class="font-medium text-green-600">{{ number_format($transaction->amount_received, 0, ',', ' ') }} {{ $transaction->currency_received }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Taux:</span>
                        <span class="font-medium">1 {{ $transaction->currency_sended }} = {{ $transaction->exchange_rate }} {{ $transaction->currency_received }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Date:</span>
                        <span class="font-medium">{{ $transaction->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
                
            </div>
            @endforeach
        </div>

        <!-- Tableau de transactions (Vue desktop) -->
        <div class="hidden md:block bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant envoyé</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant reçu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Taux</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($transactions as $transaction)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $transaction->currency_sended }} → {{ $transaction->currency_received }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="font-medium">{{ number_format($transaction->amount_sended, 0, ',', ' ') }} {{ $transaction->currency_sended }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="font-medium text-green-600">{{ number_format($transaction->amount_received, 0, ',', ' ') }} {{ $transaction->currency_received }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                1 {{ $transaction->currency_sended }} = {{ $transaction->exchange_rate }} {{ $transaction->currency_received }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full {{ $transaction->status == 'complété' ? 'bg-green-100 text-green-800' : ($transaction->status == 'en attente' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ $transaction->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $transaction->created_at->format('d/m/Y à  H:i') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </main>

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
        });
    </script>
</body>
</html>