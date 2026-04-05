<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout - TokoBuku</title>
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
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition">
                        Beranda
                    </a>
                    <a href="{{ route('about') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition">
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
                    <a href="{{ route('home') }}" class="block text-sm font-medium text-gray-600 hover:text-indigo-600 transition py-2">
                        <i class="fa-solid fa-home mr-2"></i> Beranda
                    </a>
                    <a href="{{ route('about') }}" class="block text-sm font-medium text-gray-600 hover:text-indigo-600 transition py-2">
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

    <div class="py-6 sm:py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-6 sm:mb-8 text-center">Checkout Pesanan</h1>

            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-sm md:text-base">
                    <strong class="font-bold block mb-2">Ada masalah!</strong>
                    <ul class="mt-2 list-disc list-inside text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-xl rounded-xl md:rounded-2xl overflow-hidden flex flex-col md:flex-row">
                
                <div class="w-full md:w-1/2 bg-gray-50 p-4 sm:p-6 md:p-8 border-b md:border-r md:border-b-0">
                    <h3 class="font-bold text-lg sm:text-xl md:text-2xl mb-4 text-gray-700">Ringkasan Item</h3>
                    <div class="space-y-3 sm:space-y-4 max-h-64 sm:max-h-96 overflow-y-auto pr-2">
                        @php $grandTotal = 0; @endphp
                        @foreach($carts as $cart)
                            @php $grandTotal += $cart->book->price * $cart->quantity; @endphp
                            <div class="flex gap-3 sm:gap-4 items-start pb-3 sm:pb-4 border-b last:border-b-0">
                                <img src="{{ str_starts_with($cart->book->cover_image, 'http') ? $cart->book->cover_image : asset($cart->book->cover_image) }}" class="w-12 h-16 sm:w-16 sm:h-20 object-cover rounded shadow flex-shrink-0">
                                <div class="flex-grow min-w-0">
                                    <p class="font-bold text-sm sm:text-base line-clamp-2">{{ $cart->book->title }}</p>
                                    <p class="text-xs sm:text-sm text-gray-500 mt-1">{{ $cart->quantity }} x Rp {{ number_format($cart->book->price, 0, ',', '.') }}</p>
                                    <p class="font-bold text-indigo-600 text-sm sm:text-base mt-1">Rp {{ number_format($cart->book->price * $cart->quantity, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex justify-between items-start md:items-center flex-col md:flex-row gap-2">
                            <span class="font-bold text-gray-600 text-sm sm:text-base">Total Tagihan</span>
                            <span class="font-extrabold text-xl sm:text-2xl md:text-3xl text-indigo-600">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-1/2 p-4 sm:p-6 md:p-8">
                    <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @foreach($carts as $cart)
                            <input type="hidden" name="selected_carts[]" value="{{ $cart->id }}">
                        @endforeach
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Penerima</label>
                            <input type="text" value="{{ Auth::user()->name }}" class="w-full bg-gray-100 border border-gray-300 rounded py-2 px-3 text-gray-500 text-sm sm:text-base" readonly>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Alamat Lengkap Pengiriman</label>
                            <textarea name="shipping_address" rows="3" class="w-full border border-gray-300 rounded py-2 px-3 focus:outline-none focus:border-indigo-500 text-sm sm:text-base" placeholder="Jalan, Nomor Rumah, Kecamatan, Kota..." required>{{ Auth::user()->address }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Metode Pembayaran</label>
                            <select name="payment_method" id="payment_method" class="w-full border border-gray-300 rounded py-2 px-3 text-sm sm:text-base" onchange="togglePaymentInfo()">
                                <option value="cod" {{ old('payment_method') === 'cod' ? 'selected' : '' }}>COD (Bayar di Tempat)</option>
                                <option value="transfer" {{ old('payment_method') === 'transfer' ? 'selected' : '' }}>Transfer Bank (BCA/Mandiri)</option>
                            </select>
                        </div>

                        <div id="transfer_info" class="hidden mb-6 bg-blue-50 border border-blue-200 rounded p-3 sm:p-4 transition-all duration-300">
                            <h4 class="font-bold text-blue-800 mb-2 text-sm sm:text-base">Info Transfer Bank</h4>
                            <p class="text-xs sm:text-sm text-gray-700">Silakan transfer ke salah satu rekening berikut:</p>
                            <ul class="list-disc list-inside text-xs sm:text-sm text-gray-800 mt-2 font-mono bg-white p-2 rounded border space-y-1">
                                <li>BCA: <strong>645-038-1886</strong> (a.n GIELANG OMAR KHADAVI)</li>
                                <li>Mandiri: <strong>600-135-264-74</strong> (a.n GIELANG OMAR KHADAVI)</li>
                            </ul>

                            <div class="mt-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Upload Bukti Pembayaran</label>
                                <input id="payment_proof" type="file" name="payment_proof" class="w-full text-xs sm:text-sm text-gray-500 file:mr-2 sm:file:mr-4 file:py-2 file:px-3 sm:file:px-4 file:rounded-full file:border-0 file:text-xs sm:file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                <p class="text-xs text-gray-500 mt-1">Wajib untuk metode transfer. Format: JPG/PNG (Max 2MB).</p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Catatan (Opsional)</label>
                            <input type="text" name="notes" class="w-full border border-gray-300 rounded py-2 px-3 text-sm sm:text-base" placeholder="Contoh: Jangan dibanting">
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700 transition duration-300 text-sm sm:text-base">
                            Konfirmasi & Bayar
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        function togglePaymentInfo() {
            const method = document.getElementById('payment_method').value;
            const infoDiv = document.getElementById('transfer_info');
            const paymentProofInput = document.getElementById('payment_proof');
            
            if (method === 'transfer') {
                infoDiv.classList.remove('hidden');
                paymentProofInput.required = true;
            } else {
                infoDiv.classList.add('hidden');
                paymentProofInput.required = false;
                paymentProofInput.value = '';
            }
        }

        togglePaymentInfo();
    </script>
</body>
</html>