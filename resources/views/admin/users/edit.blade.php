<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit User: {{ $user->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2">Password Baru</label>
                        <input type="password" name="password" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Kosongkan jika tidak ingin mengganti password">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2">Role / Hak Akses</label>
                        <select name="role" class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User (Pelanggan)</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2">No. HP</label>
                        <input type="text" name="phone" value="{{ $user->phone }}" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2">Alamat</label>
                        <textarea name="address" class="w-full border-gray-300 rounded-md shadow-sm">{{ $user->address }}</textarea>
                    </div>

                    <div class="flex justify-end gap-2 mt-6">
                        <a href="{{ route('admin.users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md font-bold">Batal</a>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md font-bold">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>