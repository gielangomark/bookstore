<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        
        $orders = Order::where('user_id', Auth::id())
                       ->with('items.book') 
                       ->latest()
                       ->get();

        return view('front.orders.index', compact('orders'));
    }
}