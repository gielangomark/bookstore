<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
{
    
    Schema::create('carts', function (Blueprint $table) {
        $table->id(); 
        $table->foreignId('user_id')->constrained('users'); 
        $table->foreignId('book_id')->constrained('books'); 
        $table->integer('quantity');
        $table->timestamp('created_at')->useCurrent(); 
        $table->timestamp('updated_at')->nullable();
    });

    
    Schema::create('orders', function (Blueprint $table) {
        $table->id(); 
        $table->foreignId('user_id')->constrained('users'); 
        $table->string('order_number')->unique();
        $table->decimal('total_amount', 12, 2);
        $table->text('shipping_address');
        $table->enum('payment_method', ['transfer', 'cod']); 
        $table->string('payment_proof')->nullable();
        $table->enum('status', ['pending', 'paid', 'shipped', 'completed', 'cancelled']);
        $table->text('notes')->nullable();
        $table->timestamp('created_at')->useCurrent(); 
        $table->timestamp('updated_at')->nullable();
    });

    
    Schema::create('order_items', function (Blueprint $table) {
        $table->id(); 
        $table->foreignId('order_id')->constrained('orders'); 
        $table->foreignId('book_id')->constrained('books');   
        $table->integer('quantity');
        $table->decimal('price', 12, 2);
        $table->decimal('subtotal', 12, 2);
        
    });
}

public function down(): void
{
    Schema::dropIfExists('order_items');
    Schema::dropIfExists('orders');
    Schema::dropIfExists('carts');
}
};
