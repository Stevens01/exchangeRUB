<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - ExchangeRUB Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navigation Admin -->
    <nav class="bg-blue-800 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold">
                    ExchangeRUB Admin
                </a>
                <div class="flex space-x-4">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-200">
                        <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.pending.users') }}" class="hover:text-blue-200">
                        <i class="fas fa-user-check mr-1"></i> Validations
                    </a>
                    <a href="{{ route('admin.all.users') }}" class="hover:text-blue-200">
                        <i class="fas fa-users mr-1"></i> Utilisateurs
                    </a>
                    <a href="{{ route('home') }}" class="hover:text-blue-200">
                        <i class="fas fa-home mr-1"></i> Site public
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="hover:text-blue-200">
                            <i class="fas fa-sign-out-alt mr-1"></i> Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Scripts -->
    @yield('scripts')
</body>
</html>