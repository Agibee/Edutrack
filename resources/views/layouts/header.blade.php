<header class="bg-white shadow px-6 py-4 flex justify-between items-center">
    <div class="flex items-center">
        <button id="sidebar-toggle" class="md:hidden mr-4 text-gray-600 hover:text-gray-800">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="text-2xl font-semibold text-gray-800">
            @yield('page-title')
        </h1>
    </div>
    <div class="flex items-center space-x-4 border-l border-slate-400 px-4">
        <span class="text-gray-600">{{ session('user.name') ?? 'User' }}</span>
        <img src="https://ui-avatars.com/api/?name={{ urlencode(session('user.name') ?? 'User') }}"
             class="w-8 h-8 rounded-full">
        <form action="{{ route('logout') }}" method="GET" class="inline">
            @csrf
            <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
        </form>
    </div>
</header>
