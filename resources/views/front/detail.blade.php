<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $book->title }} - TokoBuku</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased">

    <nav class="bg-white shadow-sm sticky top-0 z-50 font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <!-- Logo -->
                <a href="{{ route('home') }}" class="font-bold text-xl sm:text-2xl text-indigo-600 flex items-center gap-2 hover:opacity-80 transition flex-shrink-0">
                    <span>📚</span> <span class="hidden xs:inline">TokoBuku</span>
                </a>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition {{ request()->routeIs('home') ? 'text-indigo-600' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('about') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition {{ request()->routeIs('about') ? 'text-indigo-600' : '' }}">
                        Tentang Kami
                    </a>
                </div>

                <!-- Right Side Icons -->
                <div class="flex items-center gap-3 sm:gap-4 md:gap-6">
                    @auth
                        <a href="{{ route('cart.index') }}" class="text-gray-500 hover:text-indigo-600 font-medium flex items-center gap-1 transition" title="Keranjang">
                            <i class="fa-solid fa-cart-shopping text-lg"></i>
                            <span class="hidden sm:inline text-xs md:text-sm">Keranjang</span>
                        </a>
                        
                        <a href="{{ route('my-orders.index') }}" class="text-gray-500 hover:text-indigo-600 font-medium flex items-center gap-1 transition hidden sm:flex" title="Pesanan Saya">
                            <i class="fa-solid fa-box text-lg"></i>
                            <span class="hidden md:inline text-xs md:text-sm">Pesanan Saya</span>
                        </a>

                        <div class="h-6 w-px bg-gray-300 hidden md:block"></div>

                        <!-- Mobile Menu Toggle -->
                        <button id="mobile-menu-btn" class="md:hidden text-gray-600 hover:text-indigo-600 transition p-2">
                            <i class="fa-solid fa-bars text-lg"></i>
                        </button>

                        <!-- Desktop User Menu -->
                        <div class="hidden md:flex items-center gap-2">
                            <a href="{{ url('/dashboard') }}" class="text-xs md:text-sm font-bold text-gray-700 hover:text-indigo-600 transition truncate max-w-[120px]" title="{{ Auth::user()->name }}">
                                {{ Auth::user()->name }}
                            </a>

                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-700 text-xs md:text-sm font-bold transition" title="Keluar">
                                    <i class="fa-solid fa-right-from-bracket text-lg"></i>
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-xs sm:text-sm font-bold text-gray-500 hover:text-indigo-600 transition">Masuk</a>
                        <a href="{{ route('register') }}" class="px-3 sm:px-5 py-2 bg-indigo-600 text-white rounded-full text-xs font-bold uppercase tracking-wider hover:bg-indigo-700 transition shadow-md hover:shadow-lg flex-shrink-0">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100 py-3 bg-white absolute left-0 right-0 top-16 shadow-lg z-40">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 space-y-3">
                    <a href="{{ route('home') }}" class="block text-sm font-medium text-gray-600 hover:text-indigo-600 transition py-2 {{ request()->routeIs('home') ? 'text-indigo-600' : '' }}">
                        <i class="fa-solid fa-home mr-2"></i> Beranda
                    </a>
                    <a href="{{ route('about') }}" class="block text-sm font-medium text-gray-600 hover:text-indigo-600 transition py-2 {{ request()->routeIs('about') ? 'text-indigo-600' : '' }}">
                        <i class="fa-solid fa-circle-info mr-2"></i> Tentang Kami
                    </a>
                    
                    @auth
                        <a href="{{ route('my-orders.index') }}" class="block text-sm font-medium text-gray-600 hover:text-indigo-600 transition py-2 sm:hidden">
                            <i class="fa-solid fa-box mr-2"></i> Pesanan Saya
                        </a>
                        
                        <div class="border-t border-gray-100 pt-3 mt-3">
                            <a href="{{ url('/dashboard') }}" class="block text-sm font-bold text-gray-700 hover:text-indigo-600 transition py-2">
                                <i class="fa-solid fa-user mr-2"></i> {{ Auth::user()->name }}
                            </a>

                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left text-red-500 hover:text-red-700 text-sm font-bold transition py-2">
                                    <i class="fa-solid fa-right-from-bracket mr-2"></i> Keluar
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            const menu = document.getElementById('mobile-menu');
            const btn = document.getElementById('mobile-menu-btn');
            if (menu && btn && !menu.contains(e.target) && !btn.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>
                </div>
            </div>
        </div>
    </nav>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <a href="{{ route('home') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 mb-4 sm:mb-6 font-medium text-sm sm:text-base">
                &larr; Kembali ke Katalog
            </a>

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-sm md:text-base">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-sm md:text-base">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl rounded-lg md:rounded-2xl flex flex-col md:flex-row">
                
                <div class="w-full md:w-1/3 bg-gray-100 flex items-center justify-center p-4 sm:p-8">
                    <img src="{{ str_starts_with($book->cover_image, 'http') ? $book->cover_image : asset($book->cover_image) }}" 
                         alt="{{ $book->title }}" 
                         class="w-32 sm:w-48 md:w-64 shadow-2xl rounded-lg transform hover:scale-105 transition-transform duration-500 object-cover">
                </div>

                <div class="w-full md:w-2/3 p-4 sm:p-6 md:p-8 lg:p-12 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4 flex-wrap gap-2">
                            <span class="bg-indigo-100 text-indigo-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                                {{ $book->category->name }}
                            </span>
                            @if($book->stock > 0)
                                <span class="text-green-600 text-xs sm:text-sm font-semibold flex items-center">
                                    ✅ Stok Tersedia ({{ $book->stock }})
                                </span>
                            @else
                                <span class="text-red-600 text-xs sm:text-sm font-semibold flex items-center">
                                    ❌ Stok Habis
                                </span>
                            @endif
                        </div>

                        <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-extrabold text-gray-900 mb-2 leading-tight">
                            {{ $book->title }}
                        </h1>
                        <p class="text-base sm:text-lg text-gray-500 mb-6 font-medium">Penulis: {{ $book->author }}</p>

                        <div class="prose max-w-none text-gray-600 mb-8 leading-relaxed text-sm sm:text-base">
                            <h3 class="font-bold text-gray-800 mb-2">Sinopsis</h3>
                            <p>{{ $book->description }}</p>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4 mb-8 text-xs sm:text-sm text-gray-500 border-t border-b py-4">
                            <div>
                                <span class="block font-bold text-gray-700 mb-1">Penerbit</span>
                                <span class="text-xs sm:text-sm">{{ $book->publisher ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="block font-bold text-gray-700 mb-1">Tahun Terbit</span>
                                <span class="text-xs sm:text-sm">{{ $book->year }}</span>
                            </div>
                            <div>
                                <span class="block font-bold text-gray-700 mb-1">ISBN</span>
                                <span class="text-xs sm:text-sm">{{ $book->isbn ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-4 pt-6 border-t border-gray-100 flex-col sm:flex-row gap-4">
                        <div>
                            <p class="text-xs sm:text-sm text-gray-400">Harga Spesial</p>
                            <p class="text-2xl sm:text-3xl md:text-4xl font-bold text-indigo-600">
                                Rp {{ number_format($book->price, 0, ',', '.') }}
                            </p>
                        </div>
                        
                        <form action="{{ route('cart.store', $book->id) }}" method="POST" class="w-full sm:w-auto">
                            @csrf
                            <button type="submit" class="w-full bg-indigo-600 text-white px-6 sm:px-8 py-3 sm:py-4 rounded-lg md:rounded-xl font-bold text-base sm:text-lg shadow-lg hover:bg-indigo-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                🛒 Masukkan Keranjang
                            </button>
                        </form>
                        </div>
                </div>

            </div>
        </div>
    </div>

    <footer class="bg-white border-t mt-12 py-8 text-center text-gray-500 text-sm">
        &copy; {{ date('Y') }} TokoBuku.
    </footer>

</body>
</html>