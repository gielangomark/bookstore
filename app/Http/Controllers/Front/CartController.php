<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // 1. Tampilkan Isi Keranjang
    public function index()
    {
        // Ambil data keranjang milik user yang sedang login
        $carts = Cart::with('book')
                    ->where('user_id', Auth::id())
                    ->get();
        
        return view('front.cart', compact('carts'));
    }

    // 2. Tambah Buku ke Keranjang
    public function store($bookId)
    {
        // Cek dulu apakah user sudah login? (Sebenarnya sudah dijaga middleware, tapi buat safety)
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk belanja.');
        }

        // Cek stok buku
        $book = Book::findOrFail($bookId);
        if ($book->stock < 1) {
            return back()->with('error', 'Stok buku habis!');
        }

        // Cek apakah buku ini sudah ada di keranjang user?
        $existingCart = Cart::where('user_id', Auth::id())
                            ->where('book_id', $bookId)
                            ->first();

        if ($existingCart) {
            // Kalau sudah ada, tambah jumlahnya (Quantity + 1)
            $existingCart->increment('quantity');
        } else {
            // Kalau belum ada, buat baris baru di database
            Cart::create([
                'user_id' => Auth::id(),
                'book_id' => $bookId,
                'quantity' => 1
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Buku masuk keranjang!');
    }

    // 3. Hapus Item dari Keranjang
    public function destroy($cartId)
    {
        $cart = Cart::where('user_id', Auth::id())->where('id', $cartId)->first();
        
        if ($cart) {
            $cart->delete();
        }

        return back()->with('success', 'Item dihapus dari keranjang.');
    }
}