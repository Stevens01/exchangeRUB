<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Transactions - ExchangeRUB</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                <div class="flex items-center space-x-2">
                    <i class="fas fa-exchange-alt text-blue-600 text-2xl"></i>
                    <span class="text-xl font-bold text-gray-800">ExchangeRUB</span>
                </div>
                <nav class="hidden md:flex space-x-6">
                    <a href="{{route('home')}}" class="text-gray-600 hover:text-blue-600 transition">Accueil</a>
                    <a href="{{ route('exchange_rates') }}" class="text-gray-600 hover:text-blue-600 transition">Taux de change</a>
                    <a href="{{route('work')}}" class="text-gray-600 hover:text-blue-600 transition">Comment ça marche</a>
                    <a href="{{route('propos')}}" class="text-gray-600 hover:text-blue-600 transition">À propos</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- En-tête de page -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Historique des Transactions</h1>
            <p class="text-gray-600">Suivez l'ensemble de vos opérations d'échange</p>
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
                        <option>Approuvé</option>
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

        <!-- Cartes de transactions (Vue mobile) -->
        <div class="md:hidden space-y-4">
            @foreach($transactions as $transaction)
            <div class="bg-white rounded-lg shadow transaction-card p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <span class="text-sm text-gray-500">#{{ $transaction->id }}</span>
                        <h3 class="font-semibold text-gray-800">{{ $transaction->user->name }}</h3>
                    </div>
                    <span class="px-2 py-1 text-xs rounded-full {{ $transaction->status == 'complété' ? 'bg-green-100 text-green-800' : ($transaction->status == 'en attente' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                        {{ $transaction->status }}
                    </span>
                </div>
                
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Type:</span>
                        <span class="font-medium">{{ $transaction->currency_sended }} → {{ $transaction->currency_received }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Montant:</span>
                        <span class="font-medium">{{ number_format($transaction->amount_sended, 0, ',', ' ') }} {{ $transaction->currency_sended }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Reçu:</span>
                        <span class="font-medium">{{ number_format($transaction->amount_received, 0, ',', ' ') }} {{ $transaction->currency_received }}</span>
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
                
                <div class="mt-4 pt-4 border-t">
                    <a href="{{ route('exchange.show', $transaction->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        <i class="fas fa-eye mr-1"></i> Voir détails
                    </a>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant envoyé</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant reçu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Taux</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($transactions as $transaction)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $transaction->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $transaction->user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $transaction->user->email }}</div>
                            </td>
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
                                {{ $transaction->created_at->format('d/m/Y H:i') }}
                            </td>
                           <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('exchange.show', $transaction->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                                @if($transaction->status == 'en attente')
                                <form action="{{ route('admin.transactions.approve', $transaction->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-900 mr-3" onclick="return confirm('Approuver cette transaction?')">
                                        <i class="fas fa-check"></i> Approuver
                                    </button>
                                </form>
                                <form action="{{ route('admin.transactions.reject', $transaction->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Rejeter cette transaction?')">
                                        <i class="fas fa-times"></i> Rejeter
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6 bg-white rounded-lg shadow px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Affichage de {{ $transactions->firstItem() }} à {{ $transactions->lastItem() }} sur {{ $transactions->total() }} transactions
                </div>
                <div class="flex space-x-2">
                    @if($transactions->onFirstPage())
                    <span class="px-3 py-1 rounded-lg border bg-gray-100 text-gray-400 text-sm font-medium">
                        Précédent
                    </span>
                    @else
                    <a href="{{ $transactions->previousPageUrl() }}" class="px-3 py-1 rounded-lg border bg-white text-gray-700 text-sm font-medium hover:bg-gray-50">
                        Précédent
                    </a>
                    @endif

                    @foreach($transactions->getUrlRange(1, $transactions->lastPage()) as $page => $url)
                    <a href="{{ $url }}" class="px-3 py-1 rounded-lg border {{ $transactions->currentPage() == $page ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }} text-sm font-medium">
                        {{ $page }}
                    </a>
                    @endforeach

                    @if($transactions->hasMorePages())
                    <a href="{{ $transactions->nextPageUrl() }}" class="px-3 py-1 rounded-lg border bg-white text-gray-700 text-sm font-medium hover:bg-gray-50">
                        Suivant
                    </a>
                    @else
                    <span class="px-3 py-1 rounded-lg border bg-gray-100 text-gray-400 text-sm font-medium">
                        Suivant
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </main>

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
                        <li><i class="fas fa-phone"></i> +7 ... ...-..-..</li>
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