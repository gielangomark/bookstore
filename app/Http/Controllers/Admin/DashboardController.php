<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;

class DashboardController extends Controller
{
    // Tampilkan dashboard admin dengan statistik lengkap
    public function index()
    {
        // Hitung total buku
        $totalBooks = Book::count();
        
        // Hitung total user (only customer, exclude admin)
        $totalUsers = User::where('role', 'customer')->count();
        
        // Hitung pending orders
        $pendingOrders = Order::where('status', 'pending')->count();
        
        // Hitung total revenue dari order yang sudah terbayar/selesai
        $totalRevenue = Order::whereIn('status', ['confirmed', 'shipped', 'delivered'])->sum('total_amount');

        // Ambil 5 order terakhir dengan relasi user
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        
        // Ambil semua kategori dengan jumlah buku di setiap kategori
        $categories = Category::withCount('books')->latest()->get();

        return view('admin.dashboard', compact(
            'totalBooks', 
            'totalUsers', 
            'pendingOrders', 
            'totalRevenue', 
            'recentOrders',
            'categories'
        ));
    }
}