<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Ambil order milik user yang sedang login saja
        $orders = Order::where('user_id', Auth::id())
                       ->with('items.book') // Load detail buku biar bisa ditampilkan
                       ->latest()
                       ->get();

        return view('front.orders.index', compact('orders'));
    }
}