<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 
        'title', 
        'author', 
        'publisher', 
        'isbn', 
        'year', 
        'price', 
        'stock', 
        'description', 
        'cover_image'
    ];

    // --- BAGIAN INI YANG KEMUNGKINAN HILANG ATAU SALAH NAMA ---
    public function category()
    {
        // Ini memberitahu Laravel bahwa 'category_id' milik tabel Category
        return $this->belongsTo(Category::class);
    }
    // -----------------------------------------------------------
}