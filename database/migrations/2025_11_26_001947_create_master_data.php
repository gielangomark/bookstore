<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
{
    
    Schema::create('categories', function (Blueprint $table) {
        $table->id(); 
        $table->string('name');
        $table->text('description')->nullable();
        $table->timestamp('created_at')->useCurrent(); 
        $table->timestamp('updated_at')->nullable();
    });

    
    Schema::create('settings', function (Blueprint $table) {
        $table->id(); 
        $table->string('setting_key')->unique();
        $table->text('setting_value')->nullable();
        $table->timestamp('updated_at')->nullable(); 
        $table->timestamp('created_at')->useCurrent();
    });

    
    Schema::create('books', function (Blueprint $table) {
        $table->id(); 
        $table->foreignId('category_id')->constrained('categories'); 
        $table->string('title');
        $table->string('author');
        $table->string('publisher')->nullable();
        $table->string('isbn')->nullable();
        $table->integer('year');
        $table->decimal('price', 12, 2);
        $table->integer('stock');
        $table->text('description')->nullable();
        $table->string('cover_image')->nullable();
        $table->timestamp('created_at')->useCurrent(); 
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
