<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Tampilkan semua kategori
    public function index()
    {
        // Ambil semua kategori dan hitung berapa buku di setiap kategori
        $categories = Category::withCount('books')->latest()->get();
        
        return view('admin.categories.index', compact('categories'));
    }

    // Form tambah kategori baru
    public function create()
    {
        return view('admin.categories.create');
    }

    // Simpan kategori baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string|max:1000'
        ]);

        // Buat kategori baru
        Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('admin.categories.index')
                       ->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Form edit kategori
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Update kategori
    public function update(Request $request, Category $category)
    {
        // Validasi input (nama boleh sama dengan diri sendiri)
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:1000'
        ]);

        // Update kategori
        $category->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('admin.categories.index')
                       ->with('success', 'Kategori berhasil diperbarui!');
    }

    // Hapus kategori
    public function destroy(Category $category)
    {
        // Cek apakah ada buku di kategori ini
        if ($category->books()->count() > 0) {
            return back()->with('error', 'Tidak bisa menghapus kategori yang masih memiliki buku!');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
                       ->with('success', 'Kategori berhasil dihapus!');
    }
}
