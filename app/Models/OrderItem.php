<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    
    // Matikan timestamp karena tabel ini tidak punya kolom created_at/updated_at
    public $timestamps = false; 

    protected $fillable = [
        'order_id', 
        'book_id', 
        'quantity', 
        'price', 
        'subtotal'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}