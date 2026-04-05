<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesanan Saya - giebook</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans antialiased">

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

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-12">
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-6 sm:mb-8">Riwayat Pesanan Saya</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 text-sm md:text-base">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-4 sm:space-y-6">
            @forelse($orders as $order)
                <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-100">
                    <div class="bg-gray-50 px-4 sm:px-6 py-3 sm:py-4 border-b flex justify-between items-start sm:items-center flex-col sm:flex-row gap-3">
                        <div>
                            <p class="font-bold text-gray-700 text-sm sm:text-base">#{{ $order->order_number }}</p>
                            <p class="text-xs text-gray-500">{{ $order->created_at->format('d M Y') }}</p>
                        </div>
                        <div>
                            @if($order->status == 'pending')
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2 sm:px-3 py-1 rounded-full inline-block">Menunggu Konfirmasi</span>
                            @elseif($order->status == 'paid')
                                <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2 sm:px-3 py-1 rounded-full inline-block">Diproses</span>
                            @elseif($order->status == 'shipped')
                                <span class="bg-purple-100 text-purple-800 text-xs font-bold px-2 sm:px-3 py-1 rounded-full inline-block">Dikirim</span>
                            @elseif($order->status == 'completed')
                                <span class="bg-green-100 text-green-800 text-xs font-bold px-2 sm:px-3 py-1 rounded-full inline-block">Selesai</span>
                            @else
                                <span class="bg-red-100 text-red-800 text-xs font-bold px-2 sm:px-3 py-1 rounded-full inline-block">Dibatalkan</span>
                            @endif
                        </div>
                    </div>

                    <div class="p-4 sm:p-6">
                        @foreach($order->items as $item)
                            <div class="flex items-start gap-2 sm:gap-4 mb-3 sm:mb-4 last:mb-0 pb-3 sm:pb-4 last:pb-0 border-b last:border-b-0">
                                <img src="{{ str_starts_with($item->book->cover_image, 'http') ? $item->book->cover_image : asset($item->book->cover_image) }}" class="w-12 h-16 sm:w-16 sm:h-20 object-cover rounded shadow-sm flex-shrink-0">
                                <div class="flex-grow min-w-0">
                                    <h4 class="font-bold text-gray-800 text-sm sm:text-base line-clamp-2">{{ $item->book->title }}</h4>
                                    <p class="text-xs sm:text-sm text-gray-600 mt-1">{{ $item->quantity }} barang x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="bg-gray-50 px-4 sm:px-6 py-3 sm:py-4 border-t flex justify-between items-start sm:items-center flex-col sm:flex-row gap-2">
                        <p class="text-xs sm:text-sm text-gray-500">Metode: {{ strtoupper($order->payment_method) }}</p>
                        <p class="text-lg sm:text-xl font-bold text-indigo-600">Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 bg-white rounded-lg border border-dashed">
                    <p class="text-gray-500 text-sm md:text-base">Belum ada riwayat pesanan.</p>
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>