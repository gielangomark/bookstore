<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Buku: ') . $book->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if ($errors->any())
                        <div class="mb-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                            <strong class="font-bold">Gagal Update!</strong>
                            <span class="block sm:inline">Ada input yang kurang pas:</span>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Judul Buku</label>
                            <input type="text" name="title" value="{{ old('title', $book->title) }}" 
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                                <select name="category_id" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Penulis</label>
                                <input type="text" name="author" value="{{ old('author', $book->author) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Penerbit</label>
                                <input type="text" name="publisher" value="{{ old('publisher', $book->publisher) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Tahun Terbit</label>
                                <input type="number" name="year" value="{{ old('year', $book->year) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">ISBN</label>
                                <input type="text" name="isbn" value="{{ old('isbn', $book->isbn) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Harga (Rp)</label>
                                <input type="number" name="price" value="{{ old('price', $book->price) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Stok</label>
                                <input type="number" name="stock" value="{{ old('stock', $book->stock) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                            <textarea name="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">{{ old('description', $book->description) }}</textarea>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Ganti Cover (Opsional)</label>
                            @if($book->cover_image)
                                <div class="mb-2">
                                    <img src="{{ asset($book->cover_image) }}" alt="Current Cover" class="w-20 h-28 object-cover rounded border">
                                    <p class="text-xs text-gray-500 mt-1">Cover saat ini</p>
                                </div>
                            @endif
                            <input type="file" name="cover_image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                        </div>

                        <div class="flex items-center justify-end gap-2 mt-6">
                            <a href="{{ route('admin.books.index') }}" 
                               class="text-white font-bold py-2 px-4 rounded"
                               style="background-color: #6b7280;"> Batal
                            </a>
                            
                            <button type="submit" 
                                    class="text-white font-bold py-2 px-4 rounded"
                                    style="background-color: #4F46E5;"> Update Buku
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>