<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pesanan Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3">No. Order</th>
                                    <th class="px-6 py-3">Pemesan</th>
                                    <th class="px-6 py-3">Total Bayar</th>
                                    <th class="px-6 py-3">Status</th>
                                    <th class="px-6 py-3">Tanggal</th>
                                    <th class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-bold text-indigo-600">
                                        #{{ $order->order_number }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $order->user->name }}
                                        <div class="text-xs text-gray-400">{{ $order->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 font-bold">
                                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($order->status == 'pending')
                                            <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2.5 py-0.5 rounded">Pending</span>
                                        @elseif($order->status == 'paid')
                                            <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2.5 py-0.5 rounded">Dibayar</span>
                                        @elseif($order->status == 'shipped')
                                            <span class="bg-purple-100 text-purple-800 text-xs font-bold px-2.5 py-0.5 rounded">Dikirim</span>
                                        @elseif($order->status == 'completed')
                                            <span class="bg-green-100 text-green-800 text-xs font-bold px-2.5 py-0.5 rounded">Selesai</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 text-xs font-bold px-2.5 py-0.5 rounded">Batal</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $order->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="bg-gray-800 text-white px-3 py-1.5 rounded text-xs font-bold hover:bg-gray-900">
                                            Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center">Belum ada pesanan masuk.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $orders->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>