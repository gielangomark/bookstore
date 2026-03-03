<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// --- CONTROLLERS ADMIN ---
use App\Http\Controllers\Admin\DashboardController; // <--- PENTING: Import ini agar Dashboard tampil benar
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;

// --- CONTROLLERS USER (FRONT) ---
use App\Http\Controllers\Front\BookStoreController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\Front\OrderController as UserOrderController; 


// =========================================
// 1. HALAMAN PUBLIK (User & Tamu)
// =========================================

// Halaman Depan (Katalog)
Route::get('/', [BookStoreController::class, 'index'])->name('home');

// Halaman Detail Buku
Route::get('/book/{book}', [BookStoreController::class, 'show'])->name('book.detail');

// Halaman About Us
Route::get('/about', [PageController::class, 'about'])->name('about');


// =========================================
// 2. DASHBOARD PINTAR (Redirect Logic)
// =========================================
Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('home'); // User biasa dilempar ke Home
})->middleware(['auth', 'verified'])->name('dashboard');


// =========================================
// 3. GRUP KHUSUS ADMIN
// =========================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // DASHBOARD ADMIN (SUDAH DIPERBAIKI)
    // Mengarah ke DashboardController, bukan BookController lagi
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Kelola Buku
    Route::resource('books', BookController::class);

    // Kelola Order
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');

    // Kelola User
    Route::resource('users', UserController::class);
});


// =========================================
// 4. GRUP KHUSUS USER (Login Required)
// =========================================
Route::middleware('auth')->group(function () {

    // Fitur Cart (Keranjang)
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{book}', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/remove/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Fitur Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Riwayat Pesanan Saya
    Route::get('/my-orders', [UserOrderController::class, 'index'])->name('my-orders.index');

    // Profile Bawaan Laravel
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';