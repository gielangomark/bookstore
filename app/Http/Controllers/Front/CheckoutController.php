<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // Tampilkan form checkout sebelum user confirm pesanan
    public function index(Request $request)
    {
        // Ambil ID cart yang dipilih user dari request
        $selectedCartIds = $request->input('selected_carts', []);

        // Validasi, harus ada minimal 1 item yang dipilih
        if (!$request->has('selected_carts') || empty($selectedCartIds)) {
            return redirect()->route('cart.index')->with('error', 'Pilih minimal satu item untuk checkout!');
        }

        // Query item cart dan ambil relasi bukunya
        $cartsQuery = Cart::with('book')->where('user_id', Auth::id());

        // Filter hanya item yang dipilih user
        $cartsQuery->whereIn('id', $selectedCartIds);

        $carts = $cartsQuery->get();

        // Cek lagi, pastiin ada data
        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Pilih minimal satu item untuk checkout!');
        }

        // Kirim ke halaman checkout
        return view('front.checkout', compact('carts'));
    }

    // Proses checkout dan buat pesanan baru
    public function store(Request $request)
    {
        // Validasi semua input dari form
        $request->validate([
            'selected_carts' => 'required|array|min:1',
            'selected_carts.*' => 'integer',
            'shipping_address' => 'required|string|max:500',
            'payment_method' => 'required|in:transfer,cod',
            'payment_proof' => 'required_if:payment_method,transfer|nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        // Pake transaction supaya kalo ada error, semua perubahan bisa di-rollback
        DB::transaction(function () use ($request) {
            // Ambil user yang lagi checkout
            $user = Auth::user();
            // Cari item cart yang dipilih
            $carts = Cart::with('book')
                ->where('user_id', $user->id)
                ->whereIn('id', $request->selected_carts)
                ->get();

            // Pastiin ada data cart
            if ($carts->isEmpty()) {
                abort(422, 'Item checkout tidak ditemukan.');
            }

            // Hitung total harga semua item yang di-checkout
            $totalAmount = 0;
            foreach ($carts as $cart) {
                $totalAmount += $cart->book->price * $cart->quantity;
            }

            // Simpan bukti pembayaran kalo metode transfer
            $proofPath = null;
            if ($request->hasFile('payment_proof')) {
                $proofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
            }

            // Bikin order baru di database
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'TRX-' . time(),
                'total_amount' => $totalAmount,
                'shipping_address' => $request->shipping_address,
                'payment_method' => $request->payment_method,
                'payment_proof' => $proofPath ? 'storage/' . $proofPath : null, 
                'status' => 'pending',
                'notes' => $request->notes
            ]);

            // Buat item detail untuk setiap buku di order
            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id' => $cart->book_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->book->price,
                    'subtotal' => $cart->book->price * $cart->quantity
                ]);

                // Kurangi stok buku karena udah di-order
                $cart->book->decrement('stock', $cart->quantity);
            }

            // Hapus item dari keranjang user karena udah di-checkout
            Cart::where('user_id', $user->id)
                ->whereIn('id', $request->selected_carts)
                ->delete();
        });

        // Arahkan ke halaman pesanan dengan pesan sukses
        return redirect()->route('my-orders.index')->with('success', 'Pesanan berhasil dibuat! Silakan pantau statusnya di sini.');
    }
}