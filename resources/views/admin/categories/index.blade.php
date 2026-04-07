<x-app-layout>
    <div class="relative bg-gray-50 min-h-screen">
        
        <div class="bg-indigo-600 pt-12 pb-8 px-6 md:px-10">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-3xl font-bold text-white">Kelola Kategori</h2>
                    <p class="text-indigo-100 mt-1 text-sm md:text-base">Tambah, edit, atau hapus kategori buku</p>
                </div>
                <a href="{{ route('admin.categories.create') }}" class="bg-white text-indigo-600 px-6 py-2 rounded-lg font-bold hover:bg-gray-100 transition shadow flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i> Tambah Kategori
                </a>
            </div>
        </div>

        <div class="px-6 md:px-10 py-10">
            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error Message --}}
            @if (session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="font-bold text-gray-800 text-lg">Daftar Kategori ({{ $categories->count() }})</h3>
                </div>

                <div class="overflow-x-auto">
                    @if($categories->count() > 0)
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-100">
                                    <th class="px-6 py-4 font-medium">No</th>
                                    <th class="px-6 py-4 font-medium">Nama Kategori</th>
                                    <th class="px-6 py-4 font-medium">Deskripsi</th>
                                    <th class="px-6 py-4 font-medium">Jumlah Buku</th>
                                    <th class="px-6 py-4 font-medium text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($categories as $index => $category)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <span class="text-sm font-semibold text-gray-600">{{ $index + 1 }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm font-bold text-gray-900">{{ $category->name }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-xs text-gray-600">{{ $category->description ?? '-' }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-700">
                                            <i class="fa-solid fa-book"></i> {{ $category->books_count }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-3">
                                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-indigo-600 hover:text-indigo-800 transition text-sm font-semibold">
                                                <i class="fa-solid fa-pen"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 transition text-sm font-semibold" onclick="return confirm('Yakin hapus kategori ini?')">
                                                    <i class="fa-solid fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="px-6 py-12 text-center text-gray-500">
                            <i class="fa-solid fa-inbox text-3xl mb-3 text-gray-300"></i>
                            <p class="text-base font-medium">Belum ada kategori. Silakan tambahkan kategori baru.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
