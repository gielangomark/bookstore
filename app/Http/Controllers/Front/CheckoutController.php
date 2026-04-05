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
    public function index(Request $request)
    {
        $selectedCartIds = $request->input('selected_carts', []);

        if (!$request->has('selected_carts') || empty($selectedCartIds)) {
            return redirect()->route('cart.index')->with('error', 'Pilih minimal satu item untuk checkout!');
        }

        $cartsQuery = Cart::with('book')->where('user_id', Auth::id());

        $cartsQuery->whereIn('id', $selectedCartIds);

        $carts = $cartsQuery->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Pilih minimal satu item untuk checkout!');
        }

        return view('front.checkout', compact('carts'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'selected_carts' => 'required|array|min:1',
            'selected_carts.*' => 'integer',
            'shipping_address' => 'required|string|max:500',
            'payment_method' => 'required|in:transfer,cod',
            'payment_proof' => 'required_if:payment_method,transfer|nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        DB::transaction(function () use ($request) {
            
            $user = Auth::user();
            $carts = Cart::with('book')
                ->where('user_id', $user->id)
                ->whereIn('id', $request->selected_carts)
                ->get();

            if ($carts->isEmpty()) {
                abort(422, 'Item checkout tidak ditemukan.');
            }

            
            $totalAmount = 0;
            foreach ($carts as $cart) {
                $totalAmount += $cart->book->price * $cart->quantity;
            }

            
            $proofPath = null;
            if ($request->hasFile('payment_proof')) {
                $proofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
            }

            
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

            
            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id' => $cart->book_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->book->price,
                    'subtotal' => $cart->book->price * $cart->quantity
                ]);

                
                
                $cart->book->decrement('stock', $cart->quantity);
            }

            
            Cart::where('user_id', $user->id)
                ->whereIn('id', $request->selected_carts)
                ->delete();
        });

        
        return redirect()->route('my-orders.index')->with('success', 'Pesanan berhasil dibuat! Silakan pantau statusnya di sini.');
    }
}