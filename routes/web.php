<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\Admin\DashboardController; 
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;


use App\Http\Controllers\Front\BookStoreController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\Front\OrderController as UserOrderController; 







Route::get('/', [BookStoreController::class, 'index'])->name('home');


Route::get('/book/{book}', [BookStoreController::class, 'show'])->name('book.detail');


Route::get('/about', [PageController::class, 'about'])->name('about');
Route::post('/about/messages', [PageController::class, 'storeMessage'])->name('about.message.store');





Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('home'); 
})->middleware(['auth', 'verified'])->name('dashboard');





Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Kategori management
    Route::resource('categories', CategoryController::class);
    
    // Book management
    Route::resource('books', BookController::class);

    
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');

    Route::get('/messages', [ContactMessageController::class, 'index'])->name('messages.index');

    
    Route::resource('users', UserController::class);
});





Route::middleware('auth')->group(function () {

    
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{book}', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/remove/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

    
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    
    Route::get('/my-orders', [UserOrderController::class, 'index'])->name('my-orders.index');

    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';