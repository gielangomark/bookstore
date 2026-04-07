<x-app-layout>
    <div class="relative bg-gray-50 min-h-screen">
        
        <div class="bg-indigo-600 pt-12 pb-28 px-6 md:px-10">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-3xl font-bold text-white">Dashboard Overview</h2>
                    <p class="text-indigo-100 mt-1 text-sm md:text-base">Halo Admin! Inilah performa toko buku Anda hari ini.</p>
                </div>
                <div class="hidden md:flex gap-3">
                    <a href="{{ route('admin.orders.index') }}" class="bg-indigo-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-400 transition shadow">
                        Cek Pesanan
                    </a>
                    <a href="{{ route('admin.books.create') }}" class="bg-white text-indigo-600 px-4 py-2 rounded-lg text-sm font-bold hover:bg-gray-100 transition shadow">
                        + Tambah Buku
                    </a>
                </div>
            </div>
        </div>

        <div class="px-6 md:px-10 -mt-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 flex items-center hover:-translate-y-1 transition duration-300">
                    <div class="p-4 bg-indigo-50 rounded-xl text-indigo-600">
                        <i class="fa-solid fa-book text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Jumlah Total Buku</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $totalBooks }}</h3>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 flex items-center hover:-translate-y-1 transition duration-300">
                    <div class="p-4 bg-blue-50 rounded-xl text-blue-600">
                        <i class="fa-solid fa-users text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Pelanggan</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $totalUsers }}</h3>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 flex items-center hover:-translate-y-1 transition duration-300">
                    <div class="p-4 bg-yellow-50 rounded-xl text-yellow-600">
                        <i class="fa-solid fa-cart-shopping text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Perlu Proses</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $pendingOrders }}</h3>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 flex items-center hover:-translate-y-1 transition duration-300">
                    <div class="p-4 bg-emerald-50 rounded-xl text-emerald-600">
                        <i class="fa-solid fa-wallet text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Pendapatan</p>
                        <h3 class="text-xl font-bold text-gray-800">Rp {{ number_format($totalRevenue / 1000, 0) }}k</h3>
                    </div>
                </div>

            </div>
        </div>

        <div class="px-6 md:px-10 mt-10 pb-10">
            {{-- KATEGORI SECTION --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-200">
                    <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800 text-lg">📁 Daftar Kategori ({{ $categories->count() }})</h3>
                        <a href="{{ route('admin.categories.index') }}" class="text-indigo-600 text-sm font-semibold hover:underline">Kelola Semua</a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        @if($categories->count() > 0)
                            <div class="px-6 py-4 space-y-2">
                                @foreach($categories->take(5) as $category)
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                    <div>
                                        <p class="text-sm font-bold text-gray-900">{{ $category->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $category->description ?? 'Tidak ada deskripsi' }}</p>
                                    </div>
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-700">
                                        <i class="fa-solid fa-book text-xs"></i> {{ $category->books_count ?? 0 }}
                                    </span>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="px-6 py-8 text-center text-gray-500">
                                <p class="text-sm">Belum ada kategori. Silakan tambahkan kategori terlebih dahulu.</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- QUICK ACTION CARD --}}
                <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl shadow-lg p-6 text-white">
                    <h3 class="text-lg font-bold mb-4">⚡ Aksi Cepat</h3>
                    <div class="space-y-3">
                        <a href="{{ route('admin.categories.create') }}" class="block bg-white bg-opacity-20 hover:bg-opacity-30 transition px-4 py-3 rounded-lg text-sm font-semibold text-center">
                            <i class="fa-solid fa-plus mr-2"></i> Tambah Kategori
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="block bg-white bg-opacity-20 hover:bg-opacity-30 transition px-4 py-3 rounded-lg text-sm font-semibold text-center">
                            <i class="fa-solid fa-cog mr-2"></i> Kelola Kategori
                        </a>
                    </div>
                </div>
            </div>

            {{-- RECENT ORDERS SECTION --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
                <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800 text-lg">Pesanan Terbaru</h3>
                    <a href="{{ route('admin.orders.index') }}" class="text-indigo-600 text-sm font-semibold hover:underline">Lihat Semua</a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 font-medium">Order ID</th>
                                <th class="px-6 py-4 font-medium">Customer</th>
                                <th class="px-6 py-4 font-medium">Total</th>
                                <th class="px-6 py-4 font-medium">Status</th>
                                <th class="px-6 py-4 font-medium text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($recentOrders as $order)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <span class="font-mono text-sm font-bold text-indigo-600">#{{ $order->id }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs">
                                            {{ substr($order->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900">{{ $order->user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $order->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-bold text-gray-700">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($order->status == 'pending')
                                        <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full font-bold">Pending</span>
                                    @elseif($order->status == 'confirmed')
                                        <span class="bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full font-bold">Konfirm</span>
                                    @elseif($order->status == 'shipped')
                                        <span class="bg-purple-100 text-purple-700 text-xs px-3 py-1 rounded-full font-bold">Dikirim</span>
                                    @elseif($order->status == 'delivered')
                                        <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-bold">Selesai</span>
                                    @else
                                        <span class="bg-red-100 text-red-700 text-xs px-3 py-1 rounded-full font-bold">Batal</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="text-gray-400 hover:text-indigo-600 transition text-lg">
                                        <i class="fa-solid fa-angle-right"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada pesanan masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>