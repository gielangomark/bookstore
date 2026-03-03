<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Checkout - TokoBuku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <a href="{{ route('home') }}" class="font-bold text-2xl text-indigo-600">📚 TokoBuku</a>
        </div>
    </nav>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">Checkout Pesanan</h1>

            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <strong class="font-bold">Ada masalah!</strong>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-xl rounded-2xl overflow-hidden flex flex-col md:flex-row">
                
                <div class="md:w-1/2 bg-gray-50 p-8 border-r">
                    <h3 class="font-bold text-lg mb-4 text-gray-700">Ringkasan Item</h3>
                    <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
                        @php $grandTotal = 0; @endphp
                        @foreach($carts as $cart)
                            @php $grandTotal += $cart->book->price * $cart->quantity; @endphp
                            <div class="flex gap-4 items-start">
                                <img src="{{ str_starts_with($cart->book->cover_image, 'http') ? $cart->book->cover_image : asset($cart->book->cover_image) }}" class="w-16 h-20 object-cover rounded shadow">
                                <div>
                                    <p class="font-bold text-sm">{{ $cart->book->title }}</p>
                                    <p class="text-xs text-gray-500">{{ $cart->quantity }} x Rp {{ number_format($cart->book->price, 0, ',', '.') }}</p>
                                    <p class="font-bold text-indigo-600 text-sm">Rp {{ number_format($cart->book->price * $cart->quantity, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-gray-600">Total Tagihan</span>
                            <span class="font-extrabold text-2xl text-indigo-600">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="md:w-1/2 p-8">
                    <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Penerima</label>
                            <input type="text" value="{{ Auth::user()->name }}" class="w-full bg-gray-100 border border-gray-300 rounded py-2 px-3 text-gray-500" readonly>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Alamat Lengkap Pengiriman</label>
                            <textarea name="shipping_address" rows="3" class="w-full border border-gray-300 rounded py-2 px-3 focus:outline-none focus:border-indigo-500" placeholder="Jalan, Nomor Rumah, Kecamatan, Kota..." required>{{ Auth::user()->address }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Metode Pembayaran</label>
                            <select name="payment_method" id="payment_method" class="w-full border border-gray-300 rounded py-2 px-3" onchange="togglePaymentInfo()">
                                <option value="cod">COD (Bayar di Tempat)</option>
                                <option value="transfer">Transfer Bank (BCA/Mandiri)</option>
                            </select>
                        </div>

                        <div id="transfer_info" class="hidden mb-6 bg-blue-50 border border-blue-200 rounded p-4 transition-all duration-300">
                            <h4 class="font-bold text-blue-800 mb-2">Info Transfer Bank</h4>
                            <p class="text-sm text-gray-700">Silakan transfer ke salah satu rekening berikut:</p>
                            <ul class="list-disc list-inside text-sm text-gray-800 mt-2 font-mono bg-white p-2 rounded border">
                                <li>BCA: <strong>645-038-1886</strong> (a.n GIELANG OMAR KHADAVI)</li>
                                <li>Mandiri: <strong>600-135-264-74</strong> (a.n GIELANG OMAR KHADAVI)</li>
                            </ul>
                            
                            <div class="mt-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Upload Bukti Transfer</label>
                                <input type="file" name="payment_proof" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                <p class="text-xs text-gray-500 mt-1">Format: JPG/PNG (Max 2MB). Pastikan foto jelas.</p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Catatan (Opsional)</label>
                            <input type="text" name="notes" class="w-full border border-gray-300 rounded py-2 px-3" placeholder="Contoh: Jangan dibanting">
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700 transition duration-300">
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
            
            if (method === 'transfer') {
                infoDiv.classList.remove('hidden');
            } else {
                infoDiv.classList.add('hidden');
            }
        }
    </script>
</body>
</html>