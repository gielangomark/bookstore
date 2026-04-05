<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-900 transition">
                <i class="fa-solid fa-arrow-left text-lg"></i>
            </a>
            <div>
                <h2 class="font-bold text-2xl sm:text-3xl text-gray-900">
                    Tambah User Baru
                </h2>
                <p class="text-gray-600 text-sm mt-1">Buat akun pengguna baru sistem</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 px-4">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl p-6 sm:p-8">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Nama -->
                        <div class="group">
                            <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                                <i class="fa-solid fa-user text-blue-600"></i>
                                Nama Lengkap
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition @error('name') border-red-500 @enderror" placeholder="Masukkan nama lengkap" required>
                            @error('name')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-2">
                                    <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="group">
                            <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                                <i class="fa-solid fa-envelope text-blue-600"></i>
                                Email
                            </label>
                            <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition @error('email') border-red-500 @enderror" placeholder="contoh@email.com" required>
                            @error('email')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-2">
                                    <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="group">
                            <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                                <i class="fa-solid fa-lock text-blue-600"></i>
                                Password
                            </label>
                            <input type="password" name="password" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition @error('password') border-red-500 @enderror" placeholder="Masukkan password aman" required>
                            @error('password')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-2">
                                    <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                </p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-2 flex items-center gap-2">
                                <i class="fa-solid fa-circle-info"></i> Minimal 8 karakter untuk keamanan
                            </p>
                        </div>

                        <!-- Role -->
                        <div class="group">
                            <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                                <i class="fa-solid fa-shield text-blue-600"></i>
                                Role / Hak Akses
                            </label>
                            <select name="role" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition @error('role') border-red-500 @enderror" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>👤 User (Pelanggan)</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>👑 Admin</option>
                            </select>
                            @error('role')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-2">
                                    <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="group">
                            <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                                <i class="fa-solid fa-phone text-blue-600"></i>
                                No. HP
                                <span class="text-gray-400 font-normal text-xs">(Opsional)</span>
                            </label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" placeholder="Contoh: +62812345678">
                        </div>

                        <!-- Address -->
                        <div class="group">
                            <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                                <i class="fa-solid fa-map-pin text-blue-600"></i>
                                Alamat
                                <span class="text-gray-400 font-normal text-xs">(Opsional)</span>
                            </label>
                            <textarea name="address" rows="4" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition resize-none" placeholder="Masukkan alamat lengkap">{{ old('address') }}</textarea>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center gap-2 bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-bold hover:bg-gray-300 transition">
                            <i class="fa-solid fa-times"></i>
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-green-600 to-green-700 text-white px-6 py-3 rounded-lg font-bold hover:from-green-700 hover:to-green-800 transition shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                            <i class="fa-solid fa-check"></i>
                            Simpan User Baru
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>