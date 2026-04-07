<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Tampilkan daftar item yang ada di keranjang belanja user
    public function index()
    {
        // Ambil semua buku yang ada di keranjang, jangan lupa relasi book-nya
        $carts = Cart::with('book')
                    ->where('user_id', Auth::id())
                    ->get();
        
        // Kirimin data ke view buat ditampilin
        return view('front.cart', compact('carts'));
    }

    
    // Masukin buku ke keranjang
    public function store($bookId)
    {
        // Cek dulu, user udah login atau belum
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk belanja.');
        }

        // Cari buku berdasarkan ID, kalo ga ada ya error
        $book = Book::findOrFail($bookId);
        // Jangan lupa cek stoknya, harus ada
        if ($book->stock < 1) {
            return back()->with('error', 'Stok buku habis!');
        }

        // Cek apa buku ini udah ada di keranjang atau belum
        $existingCart = Cart::where('user_id', Auth::id())
                            ->where('book_id', $bookId)
                            ->first();

        // Kalo udah ada, tinggal tambahin jumlahnya
        if ($existingCart) {
            $existingCart->increment('quantity');
        } else {
            // Kalo belum, buat item cart baru
            Cart::create([
                'user_id' => Auth::id(),
                'book_id' => $bookId,
                'quantity' => 1
            ]);
        }

        // Balik ke halaman keranjang dengan pesan sukses
        return redirect()->route('cart.index')->with('success', 'Buku masuk keranjang!');
    }

    // Hapus item dari keranjang
    public function destroy($cartId)
    {
        // Cari item cart berdasarkan ID dan pastiin punya si user ini
        $cart = Cart::where('user_id', Auth::id())->where('id', $cartId)->first();
        
        // Kalo ketemu, langsung hapus aja
        if ($cart) {
            $cart->delete();
        }

        // Kasih tahu user kalo item udah terhapus
        return back()->with('success', 'Item dihapus dari keranjang.');
    }
}