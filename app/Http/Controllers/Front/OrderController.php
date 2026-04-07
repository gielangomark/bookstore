<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Tampilkan daftar pesanan user
    public function index()
    {
        // Ambil semua pesanan milik user yang login, urutkan dari yang paling baru
        $orders = Order::where('user_id', Auth::id())
                       ->with('items.book')  // Include items dan buku yang ada di items
                       ->latest()
                       ->get();

        // Kirim ke halaman buat ditampilin
        return view('front.orders.index', compact('orders'));
    }
}