<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class BookController extends Controller
{
    
    public function index()
    {
        $books = Book::with('category')->latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    
    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    
    public function store(Request $request)
    {
        
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'author'      => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'year'        => 'required|integer|min:1900|max:'.(date('Y')+1),
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        
        $imagePath = null;
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('books', 'public');
        }

        
        Book::create([
            'title'         => $request->title,
            'category_id'   => $request->category_id,
            'author'        => $request->author,
            'publisher'     => $request->publisher,
            'isbn'          => $request->isbn,
            'year'          => $request->year,
            'price'         => $request->price,
            'stock'         => $request->stock,
            'description'   => $request->description,
            
            'cover_image'   => $imagePath ? 'storage/' . $imagePath : null,
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    
    public function update(Request $request, Book $book)
    {
        
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'author'      => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'year'        => 'required|integer',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        
        $data = $request->except(['cover_image']);

        
        if ($request->hasFile('cover_image')) {
            
            if ($book->cover_image) {
                
                $oldPath = str_replace('storage/', '', $book->cover_image);
                Storage::disk('public')->delete($oldPath);
            }

            
            $imagePath = $request->file('cover_image')->store('books', 'public');
            
            
            $data['cover_image'] = 'storage/' . $imagePath;
        }

        
        $book->update($data);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    
    public function destroy(Book $book)
    {
        
        if ($book->cover_image) {
            $oldPath = str_replace('storage/', '', $book->cover_image);
            Storage::disk('public')->delete($oldPath);
        }

        
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus!');
    }
}