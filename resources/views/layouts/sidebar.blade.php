<div class="flex flex-col w-64 bg-gray-900 h-full border-r border-gray-800">
    
    <div class="flex items-center justify-center h-16 bg-gray-900 shadow-md border-b border-gray-800">
        <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold text-white flex items-center gap-2">
            <span>📚</span> AdminPanel
        </a>
    </div>

    <div class="flex-1 flex flex-col overflow-y-auto">
        <nav class="flex-1 px-2 py-4 space-y-2">
            
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors duration-200 
               {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                <i class="fa-solid fa-gauge mr-3 text-lg"></i>
                Dashboard
            </a>

            <a href="{{ route('admin.books.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors duration-200 
               {{ request()->routeIs('admin.books.*') ? 'bg-indigo-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                <i class="fa-solid fa-book mr-3 text-lg"></i>
                Kelola Buku
            </a>

            <a href="{{ route('admin.orders.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors duration-200 
               {{ request()->routeIs('admin.orders.*') ? 'bg-indigo-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                <i class="fa-solid fa-cart-shopping mr-3 text-lg"></i>
                Pesanan Masuk
            </a>

                <a href="{{ route('admin.messages.index') }}" 
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors duration-200 
                    {{ request()->routeIs('admin.messages.*') ? 'bg-indigo-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                     <i class="fa-solid fa-envelope mr-3 text-lg"></i>
                     Pesan Masuk
                </a>

            <a href="{{ route('admin.users.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors duration-200 
               {{ request()->routeIs('admin.users.*') ? 'bg-indigo-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                <i class="fa-solid fa-users mr-3 text-lg"></i>
                Manajemen User
            </a>

        </nav>
    </div>

    <div class="p-4 border-t border-gray-800">
        <div class="flex items-center gap-3 mb-4 px-2">
            <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="text-sm">
                <p class="text-white font-bold">{{ Auth::user()->name }}</p>
                <p class="text-gray-500 text-xs">Administrator</p>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 transition">
                <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
            </button>
        </form>
    </div>

</div>