<div class="flex flex-col h-full w-64 bg-gray-900 border-r border-gray-800">
    
    <div class="flex items-center justify-between h-16 bg-gradient-to-r from-gray-900 to-gray-800 shadow-md border-b border-gray-700 px-4">
        <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold text-white flex items-center gap-2 hover:opacity-80 transition">
            <span>📚</span> 
            <span class="hidden sm:inline uppercase tracking-wide">Giebook Admin</span>
        </a>
        <button onclick="toggleMobileSidebar()" class="lg:hidden p-2 text-gray-400 hover:text-white transition" title="Close">
            <i class="fa-solid fa-times text-xl"></i>
        </button>
    </div>

    <div class="flex-1 flex flex-col overflow-y-auto">
        <nav class="flex-1 px-2 py-4 space-y-2">
            
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 
               {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white shadow-lg' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                <i class="fa-solid fa-gauge mr-3 text-lg flex-shrink-0"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.books.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 
               {{ request()->routeIs('admin.books.*') ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white shadow-lg' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                <i class="fa-solid fa-book mr-3 text-lg flex-shrink-0"></i>
                <span>Kelola Buku</span>
            </a>

            <a href="{{ route('admin.orders.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 
               {{ request()->routeIs('admin.orders.*') ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white shadow-lg' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                <i class="fa-solid fa-cart-shopping mr-3 text-lg flex-shrink-0"></i>
                <span>Pesanan Masuk</span>
            </a>

            <a href="{{ route('admin.messages.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 
               {{ request()->routeIs('admin.messages.*') ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white shadow-lg' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                <i class="fa-solid fa-envelope mr-3 text-lg flex-shrink-0"></i>
                <span>Pesan Masuk</span>
            </a>

            <a href="{{ route('admin.users.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 
               {{ request()->routeIs('admin.users.*') ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white shadow-lg' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                <i class="fa-solid fa-users mr-3 text-lg flex-shrink-0"></i>
                <span>Manajemen User</span>
            </a>

        </nav>
    </div>

    <div class="p-4 border-t border-gray-800 bg-gray-800 bg-opacity-50">
        <div class="flex items-center gap-3 mb-4 px-2">
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-400 to-indigo-600 flex items-center justify-center text-white font-bold flex-shrink-0">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="text-sm min-w-0">
                <p class="text-white font-bold truncate">{{ Auth::user()->name }}</p>
                <p class="text-gray-400 text-xs">Administrator</p>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-red-600 to-red-700 rounded-lg hover:from-red-700 hover:to-red-800 transition shadow-lg hover:shadow-xl">
                <i class="fa-solid fa-right-from-bracket mr-2"></i> 
                <span class="hidden sm:inline">Logout</span>
                <span class="sm:hidden">Keluar</span>
            </button>
        </form>
    </div>

</div>