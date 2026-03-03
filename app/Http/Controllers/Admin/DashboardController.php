<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung Statistik
        $totalBooks = Book::count();
        $totalUsers = User::where('role', 'user')->count();
        $pendingOrders = Order::where('status', 'pending')->count();
        
        // Hitung total pendapatan dari order yang sudah 'paid', 'shipped', atau 'completed'
        $totalRevenue = Order::whereIn('status', ['paid', 'shipped', 'completed'])->sum('total_amount');

        // 2. Ambil 5 Order Terbaru untuk Tabel
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalBooks', 
            'totalUsers', 
            'pendingOrders', 
            'totalRevenue', 
            'recentOrders'
        ));
    }
}