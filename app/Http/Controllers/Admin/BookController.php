<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Penting untuk fitur hapus gambar

class BookController extends Controller
{
    // --- 1. TAMPILKAN DAFTAR BUKU ---
    public function index()
    {
        $books = Book::with('category')->latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    // --- 2. TAMPILKAN FORM TAMBAH ---
    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    // --- 3. PROSES SIMPAN DATA BARU ---
    public function store(Request $request)
    {
        // A. Validasi Input
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'author'      => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'year'        => 'required|integer|min:1900|max:'.(date('Y')+1),
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // B. Upload Gambar (Jika ada)
        $imagePath = null;
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('books', 'public');
        }

        // C. Simpan ke Database
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
            // Simpan path lengkap dengan 'storage/'
            'cover_image'   => $imagePath ? 'storage/' . $imagePath : null,
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    // --- 4. TAMPILKAN FORM EDIT (Baru) ---
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    // --- 5. PROSES UPDATE DATA (Baru) ---
    public function update(Request $request, Book $book)
    {
        // A. Validasi
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'author'      => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'year'        => 'required|integer',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // B. Ambil data input kecuali gambar
        $data = $request->except(['cover_image']);

        // C. Logika Ganti Gambar
        if ($request->hasFile('cover_image')) {
            // 1. Hapus gambar lama jika ada
            if ($book->cover_image) {
                // Kita harus buang kata 'storage/' agar Storage::delete bisa menemukannya
                $oldPath = str_replace('storage/', '', $book->cover_image);
                Storage::disk('public')->delete($oldPath);
            }

            // 2. Upload gambar baru
            $imagePath = $request->file('cover_image')->store('books', 'public');
            
            // 3. Masukkan ke array data untuk diupdate
            $data['cover_image'] = 'storage/' . $imagePath;
        }

        // D. Update Database
        $book->update($data);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    // --- 6. PROSES HAPUS DATA (Baru) ---
    public function destroy(Book $book)
    {
        // Hapus file gambar fisik di folder public
        if ($book->cover_image) {
            $oldPath = str_replace('storage/', '', $book->cover_image);
            Storage::disk('public')->delete($oldPath);
        }

        // Hapus data di database
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus!');
    }
}