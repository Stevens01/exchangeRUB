<div class="sidebar bg-primary-900 text-white w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 md:relative md:translate-x-0">
    <!-- Logo -->
    <div class="flex items-center justify-center px-4 mb-10">
        <i class="fas fa-exchange-alt text-2xl mr-2"></i>
        <span class="text-xl font-bold">ExchangeRUB</span>
    </div>
    <!-- Navigation -->
    <nav>
        <a href="{{ route('admin.dashboard') }}" class="py-3 px-4 flex items-center space-x-3 rounded-lg text-gray-300 hover:bg-primary-800 hover:text-white mt-2">
            <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
        </a>
        <a href="{{ route('exchange.index') }}" class="py-3 px-4 flex items-center space-x-3 rounded-lg text-gray-300 hover:bg-primary-800 hover:text-white mt-2">
            <i class="fas fa-exchange-alt"></i>
            <span>Transactions</span>
        </a>
        <a href="{{ route('admin.exchange_rates') }}" class="py-3 px-4 flex items-center space-x-3 rounded-lg text-gray-300 hover:bg-primary-800 hover:text-white">
            <i class="fas fa-exchange-alt"></i>
            <span>Taux de change</span>
        </a>
        <a href="{{ route('admin.all_users') }}" class="py-3 px-4 flex items-center space-x-3 rounded-lg text-gray-300 hover:bg-primary-800 hover:text-white mt-2">
            <i class="fas fa-wallet"></i>
            <span>Comptes</span> 
        </a>
       
        <a href="{{ route('admin.pending_users') }}" class="py-3 px-4 flex items-center space-x-3 rounded-lg text-gray-300 hover:bg-primary-800 hover:text-white mt-2">
            <i class="fas fa-user-check mr-1"></i> Validations
        </a>
        
        <a href="{{ route('home') }}" class="py-3 px-4 flex items-center space-x-3 rounded-lg text-gray-300 hover:bg-primary-800 hover:text-white mt-2">
            <i class="fas fa-home mr-1"></i> Site public
        </a>

        <a href="{{ route('admin.payment_settings') }}" 
            class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition duration-200 {{ request()->routeIs('admin.payment-settings') ? 'bg-gray-700 text-white' : '' }}">
            <i class="fas fa-credit-card mr-3"></i>
            Numéros de paiement
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="py-3 px-4 flex items-center space-x-3 rounded-lg text-gray-300 hover:bg-primary-800 hover:text-white mt-2">
                <i class="fas fa-sign-out-alt mr-1"></i> Déconnexion
            </button>
        </form>
    </nav>
    
</div>