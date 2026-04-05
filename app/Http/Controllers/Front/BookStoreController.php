<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Book; 
use Illuminate\Http\Request;

class BookStoreController extends Controller
{
    public function index(Request $request)
    {
        
        $query = Book::with('category'); 

        
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
        }

        
        $books = $query->latest()->get();

        
        
        return view('front.home', compact('books'));
    }

    public function show(Book $book)
    {
        return view('front.detail', compact('book'));
    }
}