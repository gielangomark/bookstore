<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; // Tambahan untuk upload file

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Cart::with('book')->where('user_id', Auth::id())->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjangmu kosong!');
        }

        return view('front.checkout', compact('carts'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input (Tambahan validasi file gambar)
        $request->validate([
            'shipping_address' => 'required|string|max:500',
            'payment_method' => 'required|in:transfer,cod',
            'payment_proof' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        DB::transaction(function () use ($request) {
            
            $user = Auth::user();
            $carts = Cart::with('book')->where('user_id', $user->id)->get();

            // Hitung Total
            $totalAmount = 0;
            foreach ($carts as $cart) {
                $totalAmount += $cart->book->price * $cart->quantity;
            }

            // 2. Upload Bukti Bayar (Jika ada)
            $proofPath = null;
            if ($request->hasFile('payment_proof')) {
                $proofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
            }

            // 3. Buat Order Header
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'TRX-' . time(),
                'total_amount' => $totalAmount,
                'shipping_address' => $request->shipping_address,
                'payment_method' => $request->payment_method,
                'payment_proof' => $proofPath ? 'storage/' . $proofPath : null, // Simpan path gambar
                'status' => 'pending',
                'notes' => $request->notes
            ]);

            // 4. Pindahkan item & KURANGI STOK
            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id' => $cart->book_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->book->price,
                    'subtotal' => $cart->book->price * $cart->quantity
                ]);

                // --- LOGIKA PENGURANGAN STOK ---
                // Kita panggil buku aslinya, lalu kurangi stoknya
                $cart->book->decrement('stock', $cart->quantity);
            }

            // 5. Kosongkan Keranjang
            Cart::where('user_id', $user->id)->delete();
        });

        // Redirect ke halaman "Pesanan Saya" (Nanti kita buat)
        return redirect()->route('my-orders.index')->with('success', 'Pesanan berhasil dibuat! Silakan pantau statusnya di sini.');
    }
}