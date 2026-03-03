<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $book->title }} - TokoBuku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased">

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

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <a href="{{ route('home') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 mb-6 font-medium">
                &larr; Kembali ke Katalog
            </a>

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl flex flex-col md:flex-row">
                
                <div class="md:w-1/3 bg-gray-100 flex items-center justify-center p-8">
                    <img src="{{ str_starts_with($book->cover_image, 'http') ? $book->cover_image : asset($book->cover_image) }}" 
                         alt="{{ $book->title }}" 
                         class="w-48 md:w-64 shadow-2xl rounded-lg transform hover:scale-105 transition-transform duration-500 object-cover">
                </div>

                <div class="md:w-2/3 p-8 md:p-12 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="bg-indigo-100 text-indigo-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                                {{ $book->category->name }}
                            </span>
                            @if($book->stock > 0)
                                <span class="text-green-600 text-sm font-semibold flex items-center">
                                    ✅ Stok Tersedia ({{ $book->stock }})
                                </span>
                            @else
                                <span class="text-red-600 text-sm font-semibold flex items-center">
                                    ❌ Stok Habis
                                </span>
                            @endif
                        </div>

                        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2 leading-tight">
                            {{ $book->title }}
                        </h1>
                        <p class="text-lg text-gray-500 mb-6 font-medium">Penulis: {{ $book->author }}</p>

                        <div class="prose max-w-none text-gray-600 mb-8 leading-relaxed">
                            <h3 class="font-bold text-gray-800 mb-2">Sinopsis</h3>
                            <p>{{ $book->description }}</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-8 text-sm text-gray-500 border-t border-b py-4">
                            <div>
                                <span class="block font-bold text-gray-700">Penerbit</span>
                                {{ $book->publisher ?? '-' }}
                            </div>
                            <div>
                                <span class="block font-bold text-gray-700">Tahun Terbit</span>
                                {{ $book->year }}
                            </div>
                            <div>
                                <span class="block font-bold text-gray-700">ISBN</span>
                                {{ $book->isbn ?? '-' }}
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-4 pt-6 border-t border-gray-100">
                        <div>
                            <p class="text-sm text-gray-400">Harga Spesial</p>
                            <p class="text-3xl font-bold text-indigo-600">
                                Rp {{ number_format($book->price, 0, ',', '.') }}
                            </p>
                        </div>
                        
                        <form action="{{ route('cart.store', $book->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-indigo-600 text-white px-8 py-4 rounded-xl font-bold text-lg shadow-lg hover:bg-indigo-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
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