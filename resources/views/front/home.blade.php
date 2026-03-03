<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-900 antialiased font-sans">

    <nav class="bg-white shadow-sm sticky top-0 z-50 font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                
                <div class="flex items-center gap-8">
                    <a href="{{ route('home') }}" class="font-bold text-2xl text-indigo-600 flex items-center gap-2 hover:opacity-80 transition">
                        <span>📚</span> TokoBuku
                    </a>
                    
                    <div class="hidden md:flex items-center space-x-6">
                        <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition {{ request()->routeIs('home') ? 'text-indigo-600' : '' }}">
                            Beranda
                        </a>
                        <a href="{{ route('about') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition {{ request()->routeIs('about') ? 'text-indigo-600' : '' }}">
                            Tentang Kami
                        </a>
                    </div>
                </div>

                <div class="flex items-center space-x-4 md:space-x-6">
                    @auth
                        <a href="{{ route('cart.index') }}" class="text-gray-500 hover:text-indigo-600 font-medium flex items-center gap-1 transition relative group">
                            <i class="fa-solid fa-cart-shopping text-lg"></i>
                            <span class="hidden sm:inline text-sm">Keranjang</span>
                        </a>
                        
                        <a href="{{ route('my-orders.index') }}" class="text-gray-500 hover:text-indigo-600 font-medium flex items-center gap-1 transition">
                            <i class="fa-solid fa-box text-lg"></i>
                            <span class="hidden sm:inline text-sm">Pesanan Saya</span>
                        </a>

                        <div class="h-6 w-px bg-gray-300 hidden sm:block"></div>

                        <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-gray-700 hover:text-indigo-600 transition">
                            {{ Auth::user()->name }}
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-bold ml-2 transition" title="Keluar">
                                <i class="fa-solid fa-right-from-bracket text-lg"></i>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-gray-500 hover:text-indigo-600 transition">Masuk</a>
                        <a href="{{ route('register') }}" class="px-5 py-2 bg-indigo-600 text-white rounded-full text-xs font-bold uppercase tracking-wider hover:bg-indigo-700 transition shadow-md hover:shadow-lg">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm relative" role="alert">
                <p class="font-bold">Berhasil!</p>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm relative" role="alert">
                <p class="font-bold">Gagal!</p>
                <p>{{ session('error') }}</p>
            </div>
        </div>
    @endif
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 py-20 mt-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold text-white tracking-tight sm:text-5xl drop-shadow-md">
                Temukan Buku Favoritmu
            </h1>
            <p class="mt-4 text-xl text-indigo-100 max-w-2xl mx-auto">
                Jelajahi ribuan koleksi buku best-seller, novel, teknologi, hingga pengembangan diri dengan harga terbaik.
            </p>
            
            <div class="mt-10 max-w-xl mx-auto">
                <form action="{{ route('home') }}" method="GET" class="relative flex shadow-lg rounded-md">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           class="w-full rounded-l-md border-0 py-4 px-6 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-base" 
                           placeholder="Cari judul buku, penulis, atau ISBN...">
                    <button type="submit" class="bg-white text-indigo-700 px-8 py-4 rounded-r-md font-bold hover:bg-gray-50 transition border-l">
                        Cari
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Koleksi Terbaru</h2>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
            @forelse($books as $book)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full border border-gray-100">
                    
                    <div class="aspect-[2/3] w-full bg-gray-200 relative group overflow-hidden">
                        <img src="{{ str_starts_with($book->cover_image, 'http') ? $book->cover_image : asset($book->cover_image) }}" 
                             alt="{{ $book->title }}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>

                        @if($book->category)
                            <span class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-indigo-700 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                {{ $book->category->name }}
                            </span>
                        @endif
                    </div>

                    <div class="p-5 flex flex-col flex-grow">
                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-900 leading-tight mb-1 line-clamp-2 min-h-[3rem]" title="{{ $book->title }}">
                                {{ $book->title }}
                            </h3>
                            <p class="text-sm text-gray-500 font-medium">{{ $book->author }}</p>
                        </div>
                        
                        <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                            <span class="text-lg font-extrabold text-indigo-600">
                                Rp {{ number_format($book->price, 0, ',', '.') }}
                            </span>
                            <a href="{{ route('book.detail', $book->id) }}" class="inline-flex items-center justify-center w-10 h-10 bg-gray-900 text-white rounded-full hover:bg-indigo-600 transition-colors" title="Lihat Detail">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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

    <footer class="bg-gray-900 text-white py-12 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-2xl font-bold mb-4">📚 TokoBuku</h2>
            <p class="text-gray-400 mb-8">Platform pembelian buku terpercaya dengan koleksi terlengkap.</p>
            <div class="border-t border-gray-800 pt-8 text-sm text-gray-500">
                &copy; {{ date('Y') }} TokoBuku. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>