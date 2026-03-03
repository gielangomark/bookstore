<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    // 1. Tabel CARTS
    Schema::create('carts', function (Blueprint $table) {
        $table->id(); // id PK
        $table->foreignId('user_id')->constrained('users'); // FK
        $table->foreignId('book_id')->constrained('books'); // FK
        $table->integer('quantity');
        $table->timestamp('created_at')->useCurrent(); // Gambar minta created_at
        $table->timestamp('updated_at')->nullable();
    });

    // 2. Tabel ORDERS
    Schema::create('orders', function (Blueprint $table) {
        $table->id(); // id PK
        $table->foreignId('user_id')->constrained('users'); // FK
        $table->string('order_number')->unique();
        $table->decimal('total_amount', 12, 2);
        $table->text('shipping_address');
        $table->enum('payment_method', ['transfer', 'cod']); // Contoh opsi
        $table->string('payment_proof')->nullable();
        $table->enum('status', ['pending', 'paid', 'shipped', 'completed', 'cancelled']);
        $table->text('notes')->nullable();
        $table->timestamp('created_at')->useCurrent(); // Gambar minta created_at
        $table->timestamp('updated_at')->nullable();
    });

    // 3. Tabel ORDER_ITEMS
    Schema::create('order_items', function (Blueprint $table) {
        $table->id(); // id PK
        $table->foreignId('order_id')->constrained('orders'); // FK
        $table->foreignId('book_id')->constrained('books');   // FK
        $table->integer('quantity');
        $table->decimal('price', 12, 2);
        $table->decimal('subtotal', 12, 2);
        // Di gambar ERD tabel ini tidak ada kolom timestamp, jadi kita tidak buat.
    });
}

public function down(): void
{
    Schema::dropIfExists('order_items');
    Schema::dropIfExists('orders');
    Schema::dropIfExists('carts');
}
};
