<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pesanan #') . $order->order_number }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('admin.orders.index') }}" class="mb-4 inline-block text-indigo-600 font-bold hover:underline">
                &larr; Kembali ke Daftar Pesanan
            </a>

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="md:col-span-2 bg-white shadow sm:rounded-lg p-6 h-fit">
                    <h3 class="font-bold text-lg mb-4 text-gray-800 border-b pb-2">Item yang Dibeli</h3>
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                        <div class="flex items-start gap-4 border-b border-gray-100 pb-4 last:border-0 last:pb-0">
                            <img src="{{ str_starts_with($item->book->cover_image, 'http') ? $item->book->cover_image : asset($item->book->cover_image) }}" 
                                 class="w-16 h-20 object-cover rounded border shadow-sm">
                            <div>
                                <h4 class="font-bold text-gray-900">{{ $item->book->title }}</h4>
                                <p class="text-sm text-gray-500">
                                    {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                                </p>
                                <p class="font-bold text-indigo-600 mt-1">
                                    Subtotal: Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-6 pt-4 border-t flex justify-between items-center bg-gray-50 p-4 rounded">
                        <span class="text-lg font-bold text-gray-700">Total Grand</span>
                        <span class="text-2xl font-extrabold text-indigo-600">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <div class="md:col-span-1 space-y-6">
                    
                    <div class="bg-white shadow sm:rounded-lg p-6">
                        <h3 class="font-bold text-gray-800 mb-2 border-b pb-1">Info Pembeli</h3>
                        <p class="text-sm font-bold text-gray-900">{{ $order->user->name }}</p>
                        <p class="text-xs text-gray-500 mb-2">{{ $order->user->email }}</p>
                        
                        <h3 class="font-bold text-gray-800 mb-2 mt-4 border-b pb-1">Pengiriman</h3>
                        <div class="bg-gray-50 p-3 rounded border border-gray-200 text-sm text-gray-700">
                            {{ $order->shipping_address }}
                        </div>
                        
                        @if($order->notes)
                            <div class="mt-3">
                                <span class="text-xs font-bold text-gray-500 uppercase">Catatan:</span>
                                <p class="text-sm text-gray-800 italic">"{{ $order->notes }}"</p>
                            </div>
                        @endif

                        <div class="mt-4 pt-2 border-t">
                            <span class="text-xs font-bold text-gray-500 uppercase">Metode Bayar:</span>
                            <span class="block font-bold text-indigo-700 uppercase">{{ $order->payment_method }}</span>
                        </div>
                    </div>

                    @if($order->payment_proof)
                        <div class="bg-white shadow sm:rounded-lg p-6">
                            <h3 class="font-bold text-gray-800 mb-3 border-b pb-1">Bukti Pembayaran</h3>
                            
                            <a href="{{ asset($order->payment_proof) }}" target="_blank" class="block group relative overflow-hidden rounded border bg-gray-100">
                                
                                <img src="{{ asset($order->payment_proof) }}" 
                                     alt="Bukti Transfer" 
                                     class="w-24 h-24 object-contain group-hover:scale-105 transition-transform duration-300">
                                
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition bg-black bg-opacity-50">
                                    <span class="bg-white text-gray-900 text-xs font-bold px-2 py-1 rounded shadow-sm">
                                        🔍 Klik Zoom
                                    </span>
                                </div>
                            </a>
                        </div>
                    @elseif($order->payment_method == 'transfer')
                        <div class="bg-red-50 shadow sm:rounded-lg p-4 border border-red-200">
                            <p class="text-sm text-red-700 font-bold">⚠️ Belum upload bukti</p>
                        </div>
                    @endif

                    <div class="bg-white shadow sm:rounded-lg p-6 border-l-4 border-indigo-500">
                        <h3 class="font-bold text-gray-800 mb-4">Update Status</h3>
                        
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            
                            <select name="status" class="w-full border-gray-300 rounded mb-4 p-2 text-sm">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid (Sudah Dibayar)</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped (Dikirim)</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed (Selesai)</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled (Batal)</option>
                            </select>

                            <button type="submit" 
                                    style="background-color: #4F46E5; color: white; width: 100%; padding: 10px; border-radius: 6px; font-weight: bold; cursor: pointer;">
                                Simpan Status
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>