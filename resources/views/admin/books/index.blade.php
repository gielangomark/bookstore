<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl sm:text-3xl text-gray-900">
                    {{ __('Kelola Data Buku') }}
                </h2>
                <p class="text-gray-600 text-sm mt-1">Manajemen katalog buku toko</p>
            </div>
            <a href="{{ route('admin.books.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white px-6 py-2.5 rounded-lg text-sm font-bold hover:from-indigo-700 hover:to-indigo-800 transition shadow-lg hover:shadow-xl hover:-translate-y-0.5 whitespace-nowrap flex-shrink-0">
                <i class="fa-solid fa-plus text-lg"></i>
                <span>Tambah Buku</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl">
                <div class="p-4 sm:p-8 text-gray-900">
                    
                    @if($books->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-600">
                                <thead class="text-xs uppercase font-bold bg-gradient-to-r from-gray-100 to-gray-50 text-gray-700 border-b border-gray-200">
                                    <tr>
                                        <th scope="col" class="px-4 sm:px-6 py-4">Cover</th>
                                        <th scope="col" class="px-4 sm:px-6 py-4">Judul Buku</th>
                                        <th scope="col" class="px-4 sm:px-6 py-4">Kategori</th>
                                        <th scope="col" class="px-4 sm:px-6 py-4">Harga</th>
                                        <th scope="col" class="px-4 sm:px-6 py-4 text-center">Stok</th>
                                        <th scope="col" class="px-4 sm:px-6 py-4 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($books as $book)
                                    <tr class="bg-white hover:bg-indigo-50 transition">
                                        <td class="px-4 sm:px-6 py-4">
                                            <img src="{{ str_starts_with($book->cover_image, 'http') ? $book->cover_image : asset($book->cover_image) }}" 
                                                 alt="{{ $book->title }}"
                                                 class="w-12 h-16 object-cover rounded-lg shadow-sm hover:shadow-md transition flex-shrink-0"
                                                 onerror="this.src='https://via.placeholder.com/50x80?text=No+Image'">
                                        </td>
                                        <td class="px-4 sm:px-6 py-4">
                                            <div class="font-semibold text-gray-900 truncate">{{ $book->title }}</div>
                                            <div class="text-xs text-gray-500 truncate">{{ $book->author }}</div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4">
                                            <span class="inline-flex items-center gap-2 bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1.5 rounded-full">
                                                <i class="fa-solid fa-bookmark text-sm"></i>
                                                {{ $book->category->name }}
                                            </span>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 font-semibold text-indigo-600">
                                            Rp {{ number_format($book->price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 text-center">
                                            <span class="inline-flex items-center gap-2 @if($book->stock > 10) bg-green-100 text-green-700 @elseif($book->stock > 0) bg-yellow-100 text-yellow-700 @else bg-red-100 text-red-700 @endif px-3 py-1.5 rounded-full text-xs font-bold">
                                                <i class="fa-solid fa-box text-sm"></i>
                                                {{ $book->stock }}
                                            </span>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4">
                                            <div class="flex justify-center gap-2">
                                                <a href="{{ route('admin.books.edit', $book->id) }}" class="inline-flex items-center gap-2 bg-blue-100 text-blue-700 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-blue-200 transition" title="Edit buku">
                                                    <i class="fa-solid fa-pencil text-sm"></i>
                                                    <span class="hidden sm:inline">Edit</span>
                                                </a>
                                                
                                                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus buku ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center gap-2 bg-red-100 text-red-700 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-red-200 transition" title="Hapus buku">
                                                        <i class="fa-solid fa-trash text-sm"></i>
                                                        <span class="hidden sm:inline">Hapus</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6 border-t border-gray-200 pt-6">
                            {{ $books->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fa-solid fa-book text-5xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 font-medium mb-2">Belum ada data buku</p>
                            <p class="text-gray-400 text-sm mb-6">Mulai tambahkan buku baru dengan klik tombol "Tambah Buku"</p>
                            <a href="{{ route('admin.books.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-6 py-2.5 rounded-lg font-bold hover:bg-indigo-700 transition">
                                <i class="fa-solid fa-plus"></i>
                                Tambah Buku Pertama
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>