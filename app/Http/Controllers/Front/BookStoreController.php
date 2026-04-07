<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Book; 
use Illuminate\Http\Request;

class BookStoreController extends Controller
{
    // Tampilkan semua buku di halaman toko, bisa juga dengan filter pencarian
    public function index(Request $request)
    {
        // Mulai query buku, jangan lupa include kategorinya
        $query = Book::with('category'); 

        // Cek kalo ada pencarian dari user
        if ($request->has('search') && $request->search != '') {
            // Cari di judul berdasarkan huruf paling depan (gak perlu orWhere, cukup judul aja)
            $query->where('title', 'like', $request->search . '%');
        }

        // Ambil hasilnya, urut dari yang terbaru
        $books = $query->latest()->get();

        // Kirim ke halaman buat ditampilin
        return view('front.home', compact('books'));
    }


    // Tampilkan detail lengkap satu buku
    public function show(Book $book)
    {
        // Tinggal kirim data buku ke halaman detail
        return view('front.detail', compact('book'));
    }
}