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
    // 1. Tabel CATEGORIES
    Schema::create('categories', function (Blueprint $table) {
        $table->id(); // id PK
        $table->string('name');
        $table->text('description')->nullable();
        $table->timestamp('created_at')->useCurrent(); // Gambar minta created_at
        $table->timestamp('updated_at')->nullable();
    });

    // 2. Tabel SETTINGS
    Schema::create('settings', function (Blueprint $table) {
        $table->id(); // id PK
        $table->string('setting_key')->unique();
        $table->text('setting_value')->nullable();
        $table->timestamp('updated_at')->nullable(); // Gambar minta updated_at
        $table->timestamp('created_at')->useCurrent();
    });

    // 3. Tabel BOOKS (Ada FK ke Categories)
    Schema::create('books', function (Blueprint $table) {
        $table->id(); // id PK
        $table->foreignId('category_id')->constrained('categories'); // FK
        $table->string('title');
        $table->string('author');
        $table->string('publisher')->nullable();
        $table->string('isbn')->nullable();
        $table->integer('year');
        $table->decimal('price', 12, 2);
        $table->integer('stock');
        $table->text('description')->nullable();
        $table->string('cover_image')->nullable();
        $table->timestamp('created_at')->useCurrent(); // Gambar minta created_at
        $table->timestamp('updated_at')->nullable();
    });
}

public function down(): void
{
    Schema::dropIfExists('books');
    Schema::dropIfExists('settings');
    Schema::dropIfExists('categories');
}
};
