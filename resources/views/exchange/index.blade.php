
    <title>Liste des Transactions - ExchangeRUB</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>



    @extends('layouts.dash')

    @section('content')

        <!-- En-tête de page -->
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Historique des Transactions</h1>
            <p class="text-gray-600 text-sm sm:text-base">Suivez l'ensemble de vos opérations d'échange</p>
        </div>

        <!-- Filtres et Recherche -->
        <div class="bg-white rounded-lg shadow p-4 sm:p-6 mb-6">
            <div class="filters-container">
                <div class="search-container">
                    <div class="relative">
                        <input type="text" placeholder="Rechercher une transaction..." 
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
                <div class="filters-group">
                    <select class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 text-sm sm:text-base w-full sm:w-auto">
                        <option>Tous les statuts</option>
                        <option>En attente</option>
                        <option>Approuvé</option>
                        <option>Rejeté</option>
                    </select>
                    <select class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 text-sm sm:text-base w-full sm:w-auto">
                        <option>Tous les types</option>
                        <option>FCFA → RUB</option>
                        <option>RUB → FCFA</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Cartes de transactions (Vue mobile) -->
        <div class="block md:hidden space-y-4">
            @forelse($transactions as $transaction)
            <div class="bg-white rounded-lg shadow transaction-card p-4 sm:p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <span class="text-xs sm:text-sm text-gray-500">#{{ $transaction->id }}</span>
                        <h3 class="font-semibold text-gray-800 text-sm sm:text-base">{{ $transaction->user->name }}</h3>
                    </div>
                    <span class="status-badge {{ $transaction->status == 'complété' ? 'bg-green-100 text-green-800' : ($transaction->status == 'en attente' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                        {{ $transaction->status }}
                    </span>
                </div>
                
                <div class="space-y-2 text-sm">
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
                
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('exchange.show', $transaction->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium inline-flex items-center gap-1">
                            <i class="fas fa-eye"></i> Détails
                        </a>
                        @if($transaction->status == 'en attente')
                        <form action="{{ route('admin.transactions.approve', $transaction->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-green-600 hover:text-green-800 text-sm font-medium inline-flex items-center gap-1" onclick="return confirm('Approuver cette transaction?')">
                                <i class="fas fa-check"></i> Approuver
                            </button>
                        </form>
                        <form action="{{ route('admin.transactions.reject', $transaction->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium inline-flex items-center gap-1" onclick="return confirm('Rejeter cette transaction?')">
                                <i class="fas fa-times"></i> Rejeter
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <i class="fas fa-exchange-alt text-gray-400 text-4xl mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Aucune transaction</h3>
                <p class="text-gray-600">Aucune transaction n'a été trouvée.</p>
            </div>
            @endforelse
        </div>

        <!-- Tableau de transactions (Vue desktop) -->
        <div class="hidden md:block bg-white rounded-lg shadow overflow-hidden">
            <div class="table-container">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant envoyé</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant reçu</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Taux</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($transactions as $transaction)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $transaction->id }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $transaction->user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $transaction->user->email }}</div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $transaction->currency_sended }} → {{ $transaction->currency_received }}
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="font-medium">{{ number_format($transaction->amount_sended, 0, ',', ' ') }} {{ $transaction->currency_sended }}</div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="font-medium text-green-600">{{ number_format($transaction->amount_received, 0, ',', ' ') }} {{ $transaction->currency_received }}</div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                1 {{ $transaction->currency_sended }} = {{ $transaction->exchange_rate }} {{ $transaction->currency_received }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="status-badge {{ $transaction->status == 'complété' ? 'bg-green-100 text-green-800' : ($transaction->status == 'en attente' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ $transaction->status }}
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $transaction->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium actions-cell">
                                <a href="{{ route('exchange.show', $transaction->id) }}" class="text-blue-600 hover:text-blue-900 inline-flex items-center gap-1">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                                @if($transaction->status == 'en attente')
                                <form action="{{ route('admin.transactions.approve', $transaction->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-900 inline-flex items-center gap-1" onclick="return confirm('Approuver cette transaction?')">
                                        <i class="fas fa-check"></i> Approuver
                                    </button>
                                </form>
                                <form action="{{ route('admin.transactions.reject', $transaction->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-900 inline-flex items-center gap-1" onclick="return confirm('Rejeter cette transaction?')">
                                        <i class="fas fa-times"></i> Rejeter
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-4 py-8 text-center text-gray-500">
                                <i class="fas fa-exchange-alt text-gray-400 text-3xl mb-2"></i>
                                <p class="text-lg font-semibold">Aucune transaction trouvée</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($transactions->hasPages())
        <div class="mt-6 bg-white rounded-lg shadow px-4 py-4 sm:px-6">
            <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                <div class="pagination-info text-sm text-gray-700">
                    Affichage de {{ $transactions->firstItem() }} à {{ $transactions->lastItem() }} sur {{ $transactions->total() }} transactions
                </div>
                <div class="pagination-links">
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
        @endif

    <script>
        // Script pour les filtres et interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Menu mobile
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const navLinks = document.getElementById('navLinks');
            
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

            // Fonctionnalité de recherche en temps réel
            const searchInput = document.querySelector('input[type="text"]');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    const cards = document.querySelectorAll('.transaction-card');
                    const rows = document.querySelectorAll('tbody tr');
                    
                    // Recherche dans les cartes (mobile)
                    cards.forEach(card => {
                        const text = card.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                    
                    // Recherche dans les lignes du tableau (desktop)
                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }

            // Gestion du redimensionnement
            window.addEventListener('resize', function() {
                if (window.innerWidth > 767) {
                    navLinks.classList.remove('show');
                }
            });
        });
    </script>


@endsection