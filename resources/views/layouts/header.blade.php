<header class="bg-white shadow px-6 py-4 flex justify-between items-center">
    <div class="flex items-center">
        <button id="sidebar-toggle" class="md:hidden mr-4 text-gray-600 hover:text-gray-800">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="text-2xl font-semibold text-gray-800">
            @yield('page-title')
        </h1>
    </div>

    <!-- USER DROPDOWN -->
    <div class="relative">
        <button onclick="toggleUserMenu()"
                class="flex items-center space-x-3 border-l border-slate-400 px-4 focus:outline-none">
            <span class="text-gray-600">
                {{ session('user.name') ?? 'User' }}
            </span>
            <img src="https://ui-avatars.com/api/?name={{ urlencode(session('user.name') ?? 'User') }}" 
                 class="w-8 h-8 rounded-full">
              <i class="fas fa-chevron-down text-gray-500 text-xs ml-1"></i>
        </button>

        <div id="userMenu" class="hidden absolute right-0 mt-2 w-44 bg-white border border-gray-200 rounded-lg shadow-lg z-50">

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 hover:text-red-700">
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>

<script>
    function toggleUserMenu() {
        document.getElementById('userMenu').classList.toggle('hidden');
    }

    // Tutup dropdown kalau klik di luar
    document.addEventListener('click', function (e) {
        const menu = document.getElementById('userMenu');
        const button = e.target.closest('button');

        if (!e.target.closest('.relative') && !menu.classList.contains('hidden')) {
            menu.classList.add('hidden');
        }
    });
</script>
