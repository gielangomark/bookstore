<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Keranjang Belanja - TokoBuku</title>
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Keranjang Belanja Kamu</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($carts->count() > 0)
            <div class="flex flex-col lg:flex-row gap-8">
                
                <div class="lg:w-2/3">
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <table class="w-full text-left">
                            <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
                                <tr>
                                    <th class="py-3 px-6">Produk</th>
                                    <th class="py-3 px-6 text-center">Jumlah</th>
                                    <th class="py-3 px-6 text-right">Harga</th>
                                    <th class="py-3 px-6 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                @php $total = 0; @endphp
                                @foreach($carts as $cart)
                                    @php $subtotal = $cart->book->price * $cart->quantity; $total += $subtotal; @endphp
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-4 px-6 flex items-center gap-4">
                                            <img src="{{ str_starts_with($cart->book->cover_image, 'http') ? $cart->book->cover_image : asset($cart->book->cover_image) }}" 
                                                 class="w-12 h-16 object-cover rounded">
                                            <div>
                                                <p class="font-bold">{{ $cart->book->title }}</p>
                                                <p class="text-xs text-gray-500">{{ $cart->book->author }}</p>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            <span class="bg-gray-200 px-3 py-1 rounded text-sm font-bold">{{ $cart->quantity }}</span>
                                        </td>
                                        <td class="py-4 px-6 text-right font-medium">
                                            Rp {{ number_format($cart->book->price, 0, ',', '.') }}
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-bold">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="lg:w-1/3">
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Ringkasan Pesanan</h2>
                        <div class="flex justify-between mb-2 text-gray-600">
                            <span>Total Item</span>
                            <span>{{ $carts->sum('quantity') }} Pcs</span>
                        </div>
                        <div class="flex justify-between mt-4 pt-4 border-t text-xl font-bold text-indigo-600">
                            <span>Total Bayar</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        
                        <a href="{{ route('checkout.index') }}" class="block text-center w-full mt-6 bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700 transition">
                            Checkout Sekarang
                        </a>
                    </div>
                </div>

            </div>
        @else
            <div class="text-center py-12 bg-white rounded-lg shadow-sm">
                <p class="text-gray-500 text-lg mb-4">Keranjang belanja kamu masih kosong.</p>
                <a href="{{ route('home') }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-md font-bold hover:bg-indigo-700">
                    Mulai Belanja
                </a>
            </div>
        @endif
    </div>

</body>
</html>