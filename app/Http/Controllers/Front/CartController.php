<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    
    public function index()
    {
        
        $carts = Cart::with('book')
                    ->where('user_id', Auth::id())
                    ->get();
        
        return view('front.cart', compact('carts'));
    }

    
    public function store($bookId)
    {
        
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk belanja.');
        }

        
        $book = Book::findOrFail($bookId);
        if ($book->stock < 1) {
            return back()->with('error', 'Stok buku habis!');
        }

        
        $existingCart = Cart::where('user_id', Auth::id())
                            ->where('book_id', $bookId)
                            ->first();

        if ($existingCart) {
            
            $existingCart->increment('quantity');
        } else {
            
            Cart::create([
                'user_id' => Auth::id(),
                'book_id' => $bookId,
                'quantity' => 1
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Buku masuk keranjang!');
    }

    
    public function destroy($cartId)
    {
        $cart = Cart::where('user_id', Auth::id())->where('id', $cartId)->first();
        
        if ($cart) {
            $cart->delete();
        }

        return back()->with('success', 'Item dihapus dari keranjang.');
    }
}