<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Pesanan Saya - TokoBuku</title>
    <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body class="bg-gray-50 font-sans antialiased">

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

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Riwayat Pesanan Saya</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-6">
            @forelse($orders as $order)
                <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-100">
                    <div class="bg-gray-50 px-6 py-4 border-b flex justify-between items-center">
                        <div>
                            <p class="font-bold text-gray-700">#{{ $order->order_number }}</p>
                            <p class="text-xs text-gray-500">{{ $order->created_at->format('d M Y') }}</p>
                        </div>
                        <div>
                            @if($order->status == 'pending')
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-3 py-1 rounded-full">Menunggu Konfirmasi</span>
                            @elseif($order->status == 'paid')
                                <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full">Diproses</span>
                            @elseif($order->status == 'shipped')
                                <span class="bg-purple-100 text-purple-800 text-xs font-bold px-3 py-1 rounded-full">Dikirim</span>
                            @elseif($order->status == 'completed')
                                <span class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full">Selesai</span>
                            @else
                                <span class="bg-red-100 text-red-800 text-xs font-bold px-3 py-1 rounded-full">Dibatalkan</span>
                            @endif
                        </div>
                    </div>

                    <div class="p-6">
                        @foreach($order->items as $item)
                            <div class="flex items-center gap-4 mb-4 last:mb-0">
                                <img src="{{ str_starts_with($item->book->cover_image, 'http') ? $item->book->cover_image : asset($item->book->cover_image) }}" class="w-16 h-20 object-cover rounded shadow-sm">
                                <div>
                                    <h4 class="font-bold text-gray-800">{{ $item->book->title }}</h4>
                                    <p class="text-sm text-gray-600">{{ $item->quantity }} barang x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="bg-gray-50 px-6 py-4 border-t flex justify-between items-center">
                        <p class="text-sm text-gray-500">Metode: {{ strtoupper($order->payment_method) }}</p>
                        <p class="text-xl font-bold text-indigo-600">Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 bg-white rounded-lg border border-dashed">
                    <p class="text-gray-500">Belum ada riwayat pesanan.</p>
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>