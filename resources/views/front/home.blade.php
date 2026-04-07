<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-900 antialiased font-sans">

    <nav class="bg-white shadow-sm sticky top-0 z-50 font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <!-- Logo -->
                <a href="{{ route('home') }}" class="font-bold text-xl sm:text-2xl text-indigo-600 flex items-center gap-2 hover:opacity-80 transition flex-shrink-0">
                    <span>📚</span> <span class="hidden sm:inline uppercase tracking-wide">Giebook</span>
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
        // Toggle tampil-sembunyiin mobile menu saat tombol hamburger diklik
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Tutup menu kalo user klik diluar area menu
        document.addEventListener('click', function(e) {
            const menu = document.getElementById('mobile-menu');
            const btn = document.getElementById('mobile-menu-btn');
            if (menu && btn && !menu.contains(e.target) && !btn.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>

    @if(session('success'))
        {{-- Notif sukses --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm relative" role="alert">
                <p class="font-bold">Berhasil!</p>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        {{-- Notif error --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm relative" role="alert">
                <p class="font-bold">Gagal!</p>
                <p>{{ session('error') }}</p>
            </div>
        </div>
    @endif
    
    {{-- Banner hero dengan form pencarian --}}
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 py-12 sm:py-16 md:py-20 lg:py-24 mt-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            {{-- Judul hero section --}}
            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-white tracking-tight drop-shadow-md">
                Temukan Buku Favoritmu
            </h1>
            {{-- Deskripsi short --}}
            <p class="mt-3 sm:mt-4 text-base sm:text-lg md:text-xl text-indigo-100 max-w-2xl mx-auto px-2">
                Jelajahi ribuan koleksi buku best-seller, novel, teknologi, hingga pengembangan diri dengan harga terbaik.
            </p>
            
            {{-- Form pencarian buku --}}
            <div class="mt-6 sm:mt-8 md:mt-10 max-w-xl mx-auto px-4">
                <form action="{{ route('home') }}" method="GET" class="relative flex flex-col sm:flex-row shadow-lg rounded-lg overflow-hidden gap-2 sm:gap-0">
                    {{-- Input search --}}
                    <input type="text" name="search" value="{{ request('search') }}" 
                           class="w-full rounded-lg sm:rounded-l-lg sm:rounded-r-none border-0 py-3 sm:py-4 px-4 sm:px-6 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:text-base" 
                           placeholder="Cari judul buku, penulis, atau ISBN...">
                    {{-- Tombol search --}}
                    <button type="submit" class="bg-white text-indigo-700 px-6 sm:px-8 py-3 sm:py-4 rounded-lg sm:rounded-r-lg sm:rounded-l-none font-bold hover:bg-gray-50 transition border-0 sm:border-l min-w-max">
                        Cari
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Section koleksi terbaru buku --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 md:py-16">
        {{-- Title section --}}
        <div class="flex items-center justify-between mb-6 sm:mb-8">
            <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-gray-800">Koleksi Terbaru</h2>
        </div>
        
        {{-- Grid daftar buku --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 sm:gap-4 md:gap-6 lg:gap-8">
            @forelse($books as $book)
                {{-- Card buku --}}
                <div class="bg-white rounded-lg sm:rounded-xl shadow-md overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full border border-gray-100">
                    
                    {{-- Cover buku dengan category badge --}}
                    <div class="aspect-[2/3] w-full bg-gray-200 relative group overflow-hidden">
                        {{-- Gambar cover --}}
                        <img src="{{ str_starts_with($book->cover_image, 'http') ? $book->cover_image : asset($book->cover_image) }}" 
                             alt="{{ $book->title }}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        
                        {{-- Effect overlay gelap saat hover --}}
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>

                        {{-- Badge kategori --}}
                        @if($book->category)
                            <span class="absolute top-2 sm:top-3 right-2 sm:right-3 bg-white/90 backdrop-blur-sm text-indigo-700 text-xs font-bold px-2 sm:px-3 py-1 rounded-full shadow-sm">
                                {{ $book->category->name }}
                            </span>
                        @endif
                    </div>

                    {{-- Info buku: judul, penulis, harga, tombol detail --}}
                    <div class="p-3 sm:p-4 md:p-5 flex flex-col flex-grow">
                        {{-- Judul dan penulis --}}
                        <div class="mb-3 sm:mb-4">
                            {{-- Judul buku --}}
                            <h3 class="text-sm sm:text-base md:text-lg font-bold text-gray-900 leading-tight mb-1 line-clamp-2 min-h-[2.5rem] sm:min-h-[3rem]" title="{{ $book->title }}">
                                {{ $book->title }}
                            </h3>
                            {{-- Nama penulis --}}
                            <p class="text-xs sm:text-sm text-gray-500 font-medium line-clamp-1">{{ $book->author }}</p>
                        </div>
                        
                        {{-- Harga dan tombol lihat detail --}}
                        <div class="mt-auto pt-3 sm:pt-4 border-t border-gray-100 flex items-center justify-between gap-2">
                            {{-- Harga --}}
                            <span class="text-sm sm:text-base md:text-lg font-extrabold text-indigo-600 line-clamp-1">
                                Rp {{ number_format($book->price, 0, ',', '.') }}
                            </span>
                            {{-- Tombol detail --}}
                            <a href="{{ route('book.detail', $book->id) }}" class="inline-flex items-center justify-center w-8 h-8 sm:w-9 sm:h-9 md:w-10 md:h-10 bg-gray-900 text-white rounded-full hover:bg-indigo-600 transition-colors flex-shrink-0" title="Lihat Detail">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center bg-white rounded-lg border border-dashed border-gray-300">
                    <div class="mx-auto h-12 w-12 text-gray-400">
                        <svg class="h-full w-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada buku ditemukan</h3>
                    <p class="mt-1 text-sm text-gray-500">Coba kata kunci lain atau kembali lagi nanti.</p>
                </div>
            @endforelse
        </div>
    </div>

    <footer class="bg-gray-900 text-white py-8 sm:py-12 mt-8 sm:mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-xl sm:text-2xl font-bold mb-3 sm:mb-4">📚 GIEBOOK</h2>
            <p class="text-gray-400 mb-6 sm:mb-8 text-sm sm:text-base">Platform pembelian buku terpercaya dengan koleksi terlengkap.</p>
            <div class="border-t border-gray-800 pt-6 sm:pt-8 text-xs sm:text-sm text-gray-500">
                &copy; {{ date('Y') }} giebook. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>