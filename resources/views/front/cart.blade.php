<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Keranjang Belanja - TokoBuku</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans antialiased">

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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-12">
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-6 sm:mb-8">Keranjang Belanja Kamu</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm md:text-base">
                {{ session('success') }}
            </div>
        @endif

        @if($carts->count() > 0)
            <form action="{{ route('checkout.index') }}" method="GET" class="flex flex-col lg:flex-row gap-4 sm:gap-6 md:gap-8" id="checkout-selection-form">
                
                <div class="w-full lg:w-2/3">
                    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                        <table class="w-full text-left text-sm md:text-base">
                            <thead class="bg-gray-100 text-gray-600 uppercase text-xs md:text-sm">
                                <tr>
                                    <th class="py-3 px-2 sm:px-4 text-center">Pilih</th>
                                    <th class="py-3 px-2 sm:px-4 md:px-6">Produk</th>
                                    <th class="py-3 px-2 sm:px-4 md:px-6 text-center hidden sm:table-cell">Jumlah</th>
                                    <th class="py-3 px-2 sm:px-4 md:px-6 text-right hidden sm:table-cell">Harga</th>
                                    <th class="py-3 px-2 sm:px-4 md:px-6 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 divide-y">
                                @php $total = 0; @endphp
                                @foreach($carts as $cart)
                                    @php $subtotal = $cart->book->price * $cart->quantity; $total += $subtotal; @endphp
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-4 px-2 sm:px-4 text-center align-middle">
                                            <input type="checkbox" name="selected_carts[]" value="{{ $cart->id }}" checked class="cart-item-checkbox h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" data-subtotal="{{ $subtotal }}">
                                        </td>
                                        <td class="py-4 px-2 sm:px-4 md:px-6">
                                            <div class="flex items-center gap-2 sm:gap-4">
                                                <img src="{{ str_starts_with($cart->book->cover_image, 'http') ? $cart->book->cover_image : asset($cart->book->cover_image) }}" 
                                                     class="w-8 h-12 sm:w-12 sm:h-16 object-cover rounded">
                                                <div class="min-w-0">
                                                    <p class="font-bold text-xs sm:text-sm md:text-base line-clamp-2">{{ $cart->book->title }}</p>
                                                    <p class="text-xs text-gray-500 hidden sm:block">{{ $cart->book->author }}</p>
                                                    <p class="sm:hidden text-xs text-indigo-600 font-bold mt-1">Rp {{ number_format($cart->book->price, 0, ',', '.') }}</p>
                                                    <p class="sm:hidden text-xs text-gray-500 mt-1">Qty: {{ $cart->quantity }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-2 sm:px-4 md:px-6 text-center hidden sm:table-cell">
                                            <span class="bg-gray-200 px-3 py-1 rounded text-xs md:text-sm font-bold">{{ $cart->quantity }}</span>
                                        </td>
                                        <td class="py-4 px-2 sm:px-4 md:px-6 text-right font-medium hidden sm:table-cell">
                                            Rp {{ number_format($cart->book->price, 0, ',', '.') }}
                                        </td>
                                        <td class="py-4 px-2 sm:px-4 md:px-6 text-center">
                                            <form action="{{ route('cart.destroy', $cart->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 text-xs sm:text-sm font-bold">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="w-full lg:w-1/3">
                    <div class="bg-white shadow-md rounded-lg p-4 sm:p-6 sticky top-24 lg:top-20">
                        <h2 class="text-lg sm:text-xl font-bold text-gray-800 mb-4 border-b pb-2 text-base sm:text-lg">Ringkasan Pesanan</h2>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm sm:text-base text-gray-600">
                                <span>Item Dipilih</span>
                                <span id="selected-item-count" class="font-medium">{{ $carts->count() }} Item</span>
                            </div>
                            <div class="flex justify-between text-sm sm:text-base text-gray-600">
                                <span>Total Qty</span>
                                <span id="selected-quantity-count" class="font-medium">{{ $carts->sum('quantity') }} Pcs</span>
                            </div>
                        </div>
                        <div class="flex justify-between pt-4 border-t text-base sm:text-lg md:text-xl font-bold text-indigo-600">
                            <span>Total Bayar</span>
                            <span id="selected-total">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        
                        <button type="submit" class="block text-center w-full mt-6 bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700 transition text-sm sm:text-base">
                            Checkout Sekarang
                        </button>
                    </div>
                </div>
            </form>
        @else
            <div class="text-center py-12 bg-white rounded-lg shadow-sm">
                <p class="text-gray-500 text-lg mb-4">Keranjang belanja kamu masih kosong.</p>
                <a href="{{ route('home') }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-md font-bold hover:bg-indigo-700">
                    Mulai Belanja
                </a>
            </div>
        @endif
    </div>

    <script>
        function updateCheckoutSummary() {
            const checkboxes = document.querySelectorAll('.cart-item-checkbox');
            let selectedCount = 0;
            let selectedQuantity = 0;
            let selectedTotal = 0;

            checkboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    selectedCount += 1;
                    selectedQuantity += Number(checkbox.closest('tr').querySelector('.bg-gray-200').textContent.trim());
                    selectedTotal += Number(checkbox.dataset.subtotal);
                }
            });

            document.getElementById('selected-item-count').textContent = selectedCount + ' Item';
            document.getElementById('selected-quantity-count').textContent = selectedQuantity + ' Pcs';
            document.getElementById('selected-total').textContent = 'Rp ' + selectedTotal.toLocaleString('id-ID');
        }

        document.querySelectorAll('.cart-item-checkbox').forEach((checkbox) => {
            checkbox.addEventListener('change', updateCheckoutSummary);
        });

        updateCheckoutSummary();
    </script>

</body>
</html>