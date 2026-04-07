<x-app-layout>
    <div class="relative bg-gray-50 min-h-screen">
        
        <div class="bg-indigo-600 pt-12 pb-8 px-6 md:px-10">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.categories.index') }}" class="text-indigo-200 hover:text-white transition">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <div>
                    <h2 class="text-3xl font-bold text-white">Tambah Kategori Baru</h2>
                    <p class="text-indigo-100 mt-1 text-sm md:text-base">Buat kategori buku baru untuk toko Anda</p>
                </div>
            </div>
        </div>

        <div class="px-6 md:px-10 py-10">
            <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                
                {{-- Form Errors --}}
                @if ($errors->any())
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                        <h4 class="font-bold mb-2">⚠️ Ada error:</h4>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Nama Kategori --}}
                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700 mb-2">
                            Nama Kategori <span class="text-red-600">*</span>
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}"
                               placeholder="Contoh: Fiksi, Non-Fiksi, Teknologi, dll"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('name') border-red-500 @enderror"
                               required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label for="description" class="block text-sm font-bold text-gray-700 mb-2">
                            Deskripsi (Opsional)
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="4"
                                  placeholder="Jelaskan kategori ini..."
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="flex gap-3 pt-4">
                        <button type="submit" class="flex-1 bg-indigo-600 text-white font-bold py-2 rounded-lg hover:bg-indigo-700 transition">
                            <i class="fa-solid fa-check mr-2"></i> Simpan Kategori
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="flex-1 bg-gray-200 text-gray-800 font-bold py-2 rounded-lg hover:bg-gray-300 transition text-center">
                            <i class="fa-solid fa-times mr-2"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
