<header class="bg-white shadow">
    <div class="flex items-center justify-between p-4">
        <div class="flex items-center">
            <button class="md:hidden text-gray-500 focus:outline-none" id="menu-toggle">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h1 class="ml-4 text-2xl font-semibold text-gray-900">@yield('page-title', 'Dashboard')</h1>
        </div>
        
        <div class="flex items-center space-x-4">
            <div class="relative">
                <button class="text-gray-500 focus:outline-none">
                    <i class="fas fa-bell text-xl"></i>
                    <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                </button>
            </div>
            
            <div class="relative group">
                <button class="flex items-center focus:outline-none">
                    <div class="h-10 w-10 rounded-full bg-primary-600 flex items-center justify-center text-white font-semibold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <span class="ml-2 text-gray-700">{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down ml-1 text-gray-500 group-hover:rotate-180 transition-transform"></i>
                </button>
                
            </div>
        </div>
    </div>
</header>