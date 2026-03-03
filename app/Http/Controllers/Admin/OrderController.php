<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    // 1. Tampilkan Semua Pesanan Masuk
    public function index()
    {
        // Ambil data order, urutkan dari yang terbaru
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    // 2. Tampilkan Detail Pesanan (Isinya beli buku apa aja)
    public function show(Order $order)
    {
        // Load detail item dan informasi bukunya
        $order->load('items.book', 'user');
        return view('admin.orders.show', compact('order'));
    }

    // 3. Update Status Pesanan (Pending -> Paid -> Shipped)
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,shipped,completed,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}