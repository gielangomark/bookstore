<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Book; // <--- Pastikan Model Book di-import
use Illuminate\Http\Request;

class BookStoreController extends Controller
{
    public function index(Request $request)
    {
        // 1. Siapkan Query
        $query = Book::with('category'); // Pakai 'with' biar loading kategori lebih ringan

        // 2. Cek apakah ada pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
        }

        // 3. Ambil data (terbaru)
        $books = $query->latest()->get();

        // 4. Kirim variabel $books ke View
        // Bagian 'compact' inilah yang menyuplai data agar error "Undefined variable" hilang
        return view('front.home', compact('books'));
    }

    public function show(Book $book)
    {
        return view('front.detail', compact('book'));
    }
}