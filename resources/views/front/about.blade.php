<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang Kami - TokoBuku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-800">

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
                        Berdiri sejak tahun 2024, <strong>TokoBuku</strong> dimulai dari sebuah kamar kecil dengan tumpukan buku bekas. Kecintaan kami terhadap literatur mendorong kami untuk membangun platform yang memudahkan siapa saja mengakses buku berkualitas dengan harga terjangkau.
                    </p>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Kini, kami telah melayani ribuan pembaca di seluruh Indonesia. Kami hanya menjual buku **100% Original** langsung dari penerbit terpercaya.
                    </p>
                    
                    <div class="flex items-center gap-4">
                        <div class="h-px w-12 bg-indigo-600"></div>
                        <span class="font-handwriting text-xl italic text-indigo-800">CEO TokoBuku</span>
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
                
                <a href="https://wa.me/6287784728925?text=Halo%20Admin%20TokoBuku,%20saya%20mau%20tanya..." 
                   target="_blank"
                   class="inline-flex items-center gap-3 bg-white text-green-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-green-50 hover:scale-105 transition-all shadow-lg">
                    <i class="fa-brands fa-whatsapp text-2xl"></i>
                    Chat WhatsApp Admin
                </a>
            </div>
        </div>
    </div>

    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-2xl font-bold mb-4">📚 TokoBuku</h2>
            <p class="text-gray-400 mb-8">Membaca adalah jendela dunia.</p>
            <div class="border-t border-gray-800 pt-8 text-sm text-gray-500">
                &copy; {{ date('Y') }} TokoBuku. All rights reserved.
            </div>
        </div>
    </footer>

    <a href="https://wa.me/6287784728925?text=Halo%20Admin%20TokoBuku,%20saya%20mau%20tanya..." target="_blank" class="fixed bottom-6 right-6 bg-green-500 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-2xl hover:bg-green-600 hover:-translate-y-1 transition-all z-50">
        <i class="fa-brands fa-whatsapp text-3xl"></i>
    </a>

</body>
</html>