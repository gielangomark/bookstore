<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi
    protected $fillable = ['user_id', 'book_id', 'quantity'];

    // Relasi: Keranjang milik User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Keranjang berisi Buku
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}