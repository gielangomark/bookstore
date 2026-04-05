<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang Kami - giebook</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-800">

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

    <div class="relative bg-indigo-900 py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <img src="https://images.unsplash.com/photo-1507842217153-eeb5fe6149kd?q=80&w=1920&auto=format&fit=crop" alt="Library Background" class="w-full h-full object-cover">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight mb-4">
                Lebih Dari Sekadar <br> <span class="text-indigo-300">Toko Buku</span>
            </h1>
            <p class="text-lg text-indigo-100 max-w-2xl mx-auto">
                Kami percaya bahwa satu buku dapat mengubah hidup seseorang. Misi kami adalah menghubungkan Anda dengan cerita dan ilmu pengetahuan terbaik dari seluruh dunia.
            </p>
        </div>
    </div>

    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="w-full md:w-1/2">
                    <div class="relative">
                        <div class="absolute -top-4 -left-4 w-full h-full bg-indigo-100 rounded-2xl z-0"></div>
                        <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?q=80&w=800&auto=format&fit=crop" 
                             alt="Reading Book" 
                             class="relative z-10 rounded-2xl shadow-xl w-full h-80 object-cover hover:scale-[1.02] transition-transform duration-500">
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Cerita Kami</h2>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Berdiri sejak tahun 2024, <strong>giebook</strong> dimulai dari sebuah kamar kecil dengan tumpukan buku bekas. Kecintaan kami terhadap literatur mendorong kami untuk membangun platform yang memudahkan siapa saja mengakses buku berkualitas dengan harga terjangkau.
                    </p>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Kini, kami telah melayani ribuan pembaca di seluruh Indonesia. Kami hanya menjual buku **100% Original** langsung dari penerbit terpercaya.
                    </p>
                    
                    <div class="flex items-center gap-4">
                        <div class="h-px w-12 bg-indigo-600"></div>
                        <span class="font-handwriting text-xl italic text-indigo-800">CEO giebook</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900">Kenapa Belanja di Sini?</h2>
                <p class="text-gray-500 mt-2">Komitmen kami untuk kepuasan membaca Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition text-center group">
                    <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-check-circle text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">100% Original</h3>
                    <p class="text-gray-500 text-sm">Garansi uang kembali jika buku yang Anda terima bajakan. Kami anti buku bajakan.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition text-center group">
                    <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-truck-fast text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Pengiriman Cepat</h3>
                    <p class="text-gray-500 text-sm">Kerjasama dengan ekspedisi terbaik agar buku sampai dengan aman dan cepat.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition text-center group">
                    <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-headset text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Layanan Ramah</h3>
                    <p class="text-gray-500 text-sm">Tim support kami siap membantu merekomendasikan buku terbaik untuk Anda.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-3xl p-10 md:p-16 shadow-2xl text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-white opacity-10 rounded-full"></div>
                <div class="absolute bottom-0 left-0 -ml-10 -mb-10 w-40 h-40 bg-white opacity-10 rounded-full"></div>

                <h2 class="text-3xl md:text-4xl font-bold mb-4">Butuh Bantuan atau Rekomendasi?</h2>
                <p class="text-green-100 mb-8 text-lg">Admin kami siap menjawab pertanyaan Anda seputar stok, pengiriman, atau curhat buku.</p>
                
                <a href="https://wa.me/6287784728925?text=Halo%20Admin%20GIEBOOK,%20saya%20mau%20tanya..." 
                   target="_blank"
                   class="inline-flex items-center gap-3 bg-white text-green-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-green-50 hover:scale-105 transition-all shadow-lg">
                    <i class="fa-brands fa-whatsapp text-2xl"></i>
                    Chat WhatsApp Admin
                </a>
            </div>
        </div>
    </div>

    <div class="py-16 md:py-24 bg-gradient-to-br from-indigo-50 via-white to-purple-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl md:rounded-[2rem] shadow-2xl overflow-hidden border border-indigo-100/50 flex flex-col md:flex-row relative z-10">
                
                <!-- Let's Add a Left Info Section -->
                <div class="w-full md:w-5/12 bg-indigo-600 p-8 sm:p-10 lg:p-12 text-white flex flex-col justify-between relative overflow-hidden">
                    <div class="relative z-10">
                        <h2 class="text-2xl sm:text-3xl font-extrabold mb-3 sm:mb-4 text-white">Mari Berbincang!</h2>
                        <p class="text-indigo-100 text-base sm:text-lg leading-relaxed mb-6 sm:mb-8">Punya pertanyaan, saran, atau peluang kerja sama? Jangan ragu tinggalkan pesan. Tim admin kami akan segera merespons.</p>
                        
                        <div class="space-y-4 sm:space-y-6 mt-6 sm:mt-8 flex flex-row md:flex-col gap-4 md:gap-0 flex-wrap">
                            <div class="flex items-center gap-3 sm:gap-4 w-full sm:w-auto">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-indigo-500/50 rounded-full flex items-center justify-center backdrop-blur-sm shrink-0">
                                    <i class="fa-solid fa-envelope text-lg sm:text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm text-indigo-200">Email Utama</p>
                                    <p class="font-medium tracking-wide text-sm sm:text-base">admin@tokobuku.com</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 sm:gap-4 w-full sm:w-auto">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-indigo-500/50 rounded-full flex items-center justify-center backdrop-blur-sm shrink-0">
                                    <i class="fa-solid fa-location-dot text-lg sm:text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm text-indigo-200">Kunjungi Toko</p>
                                    <p class="font-medium tracking-wide text-sm sm:text-base line-clamp-1">Jl. Literasi No. 1, Jakarta</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Decorative background circles -->
                    <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-indigo-500 rounded-full mix-blend-multiply filter blur-2xl opacity-50"></div>
                    <div class="absolute -top-24 -left-24 w-64 h-64 bg-purple-500 rounded-full mix-blend-multiply filter blur-2xl opacity-50"></div>
                </div>

                <!-- Right Form Section -->
                <div class="w-full md:w-7/12 p-6 sm:p-8 lg:p-12">
                    <div class="mb-6 sm:mb-8">
                        <h3 class="text-xl sm:text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600">Kirim Pesan ke Kami</h3>
                        <p class="text-xs sm:text-sm text-gray-500 mt-2">Isi form di bawah ini dan pesanmu akan langsung masuk ke panel admin.</p>
                    </div>

                    @if(session('success'))
                        <div class="mb-6 rounded-xl border border-green-200 bg-green-50/50 px-5 py-4 text-green-700 flex items-center gap-3 backdrop-blur-sm shadow-sm scale-in text-sm font-medium">
                            <span>🎉 {{ session('success') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 rounded-xl border border-red-200 bg-red-50/50 px-5 py-4 text-red-700 flex items-start gap-3 backdrop-blur-sm shadow-sm text-sm">
                            <div>
                                <strong class="font-bold block mb-1">Ada yang terlewat:</strong>
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('about.message.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 transition-colors group-focus-within:text-indigo-600" for="name">Nama Lengkap</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-4 py-3.5 text-gray-800 placeholder-gray-400 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-300" placeholder="Masukkan nama lengkapmu">
                        </div>

                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 transition-colors group-focus-within:text-indigo-600" for="email">Alamat Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-4 py-3.5 text-gray-800 placeholder-gray-400 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-300" placeholder="nama@email.com">
                        </div>

                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 transition-colors group-focus-within:text-indigo-600" for="message">Pesan / Topik</label>
                            <textarea id="message" name="message" rows="4" class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-4 py-3.5 text-gray-800 placeholder-gray-400 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-300 resize-none" placeholder="Tuliskan pertanyaan, saran, atau kerja samamu di sini...">{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="w-full rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4 font-bold text-white shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2">
                            Kirim Pesan Sekarang
                            <i class="fa-solid fa-paper-plane text-sm ml-1"></i>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-2xl font-bold mb-4 uppercase tracking-wide">📚 Giebook</h2>
            <p class="text-gray-400 mb-8">Membaca adalah jendela dunia.</p>
            <div class="border-t border-gray-800 pt-8 text-sm text-gray-500">
                &copy; {{ date('Y') }} giebook. All rights reserved.
            </div>
        </div>
    </footer>

    <a href="https://wa.me/6287784728925?text=Halo%20Admin%20giebook,%20saya%20mau%20tanya..." target="_blank" class="fixed bottom-6 right-6 bg-green-500 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-2xl hover:bg-green-600 hover:-translate-y-1 transition-all z-50">
        <i class="fa-brands fa-whatsapp text-3xl"></i>
    </a>

</body>
</html>