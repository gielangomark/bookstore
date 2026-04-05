<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl sm:text-3xl text-gray-900">
                {{ __('Daftar Pesanan Masuk') }}
            </h2>
            <p class="text-gray-600 text-sm mt-1">Kelola semua pesanan dari pelanggan</p>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl">
                <div class="p-4 sm:p-8 text-gray-900">

                    @if($orders->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-600">
                                <thead class="text-xs uppercase font-bold bg-gradient-to-r from-gray-100 to-gray-50 text-gray-700 border-b border-gray-200">
                                    <tr>
                                        <th class="px-4 sm:px-6 py-4">No. Order</th>
                                        <th class="px-4 sm:px-6 py-4">Pemesan</th>
                                        <th class="px-4 sm:px-6 py-4">Total Bayar</th>
                                        <th class="px-4 sm:px-6 py-4">Status</th>
                                        <th class="px-4 sm:px-6 py-4 hidden sm:table-cell">Tanggal</th>
                                        <th class="px-4 sm:px-6 py-4 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($orders as $order)
                                    <tr class="bg-white hover:bg-blue-50 transition">
                                        <td class="px-4 sm:px-6 py-4 font-bold text-indigo-600">
                                            <div class="flex items-center gap-2">
                                                <i class="fa-solid fa-receipt text-lg text-indigo-500"></i>
                                                {{ $order->order_number }}
                                            </div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4">
                                            <div class="font-semibold text-gray-900">{{ $order->user->name }}</div>
                                            <div class="text-xs text-gray-500 truncate">{{ $order->user->email }}</div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 font-bold text-indigo-600">
                                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 sm:px-6 py-4">
                                            @if($order->status == 'pending')
                                                <span class="inline-flex items-center gap-2 bg-yellow-100 text-yellow-700 text-xs font-bold px-3 py-1.5 rounded-full">
                                                    <i class="fa-solid fa-hourglass-end"></i> Pending
                                                </span>
                                            @elseif($order->status == 'paid')
                                                <span class="inline-flex items-center gap-2 bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1.5 rounded-full">
                                                    <i class="fa-solid fa-check-circle"></i> Dibayar
                                                </span>
                                            @elseif($order->status == 'shipped')
                                                <span class="inline-flex items-center gap-2 bg-purple-100 text-purple-700 text-xs font-bold px-3 py-1.5 rounded-full">
                                                    <i class="fa-solid fa-truck"></i> Dikirim
                                                </span>
                                            @elseif($order->status == 'completed')
                                                <span class="inline-flex items-center gap-2 bg-green-100 text-green-700 text-xs font-bold px-3 py-1.5 rounded-full">
                                                    <i class="fa-solid fa-check-double"></i> Selesai
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-2 bg-red-100 text-red-700 text-xs font-bold px-3 py-1.5 rounded-full">
                                                    <i class="fa-solid fa-x"></i> Batal
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 hidden sm:table-cell text-xs text-gray-600">
                                            {{ $order->created_at->format('d M Y H:i') }}
                                        </td>
                                        <td class="px-4 sm:px-6 py-4">
                                            <div class="flex justify-center">
                                                <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex items-center gap-2 bg-gray-800 text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-gray-900 transition">
                                                    <i class="fa-solid fa-eye text-sm"></i>
                                                    <span class="hidden sm:inline">Lihat Detail</span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-6 border-t border-gray-200 pt-6">
                            {{ $orders->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fa-solid fa-inbox text-5xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 font-medium mb-2">Belum ada pesanan masuk</p>
                            <p class="text-gray-400 text-sm">Pesanan dari pelanggan akan ditampilkan di sini</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>