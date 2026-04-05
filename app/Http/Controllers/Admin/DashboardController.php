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
        
        $totalBooks = Book::count();
        $totalUsers = User::where('role', 'user')->count();
        $pendingOrders = Order::where('status', 'pending')->count();
        
        
        $totalRevenue = Order::whereIn('status', ['paid', 'shipped', 'completed'])->sum('total_amount');

        
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