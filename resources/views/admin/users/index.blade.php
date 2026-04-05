<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl sm:text-3xl text-gray-900">
                    {{ __('Manajemen User') }}
                </h2>
                <p class="text-gray-600 text-sm mt-1">Kelola daftar pengguna sistem</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-2.5 rounded-lg text-sm font-bold hover:from-blue-700 hover:to-blue-800 transition shadow-lg hover:shadow-xl hover:-translate-y-0.5 whitespace-nowrap flex-shrink-0">
                <i class="fa-solid fa-plus text-lg"></i>
                <span>Tambah User</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">
            
            @if(session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-6 py-4 text-green-700 flex items-center gap-3 backdrop-blur-sm shadow-sm animate-in slide-in-from-top">
                    <i class="fa-solid fa-check-circle text-xl text-green-600"></i>
                    <div>
                        <p class="font-semibold">Berhasil!</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif
            
            @if(session('error'))
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-6 py-4 text-red-700 flex items-center gap-3 backdrop-blur-sm shadow-sm animate-in slide-in-from-top">
                    <i class="fa-solid fa-exclamation-circle text-xl text-red-600"></i>
                    <div>
                        <p class="font-semibold">Terjadi Kesalahan!</p>
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl">
                <div class="p-4 sm:p-8 text-gray-900">
                    @if($users->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-600">
                                <thead class="text-xs uppercase font-bold bg-gradient-to-r from-gray-100 to-gray-50 text-gray-700 border-b border-gray-200">
                                    <tr>
                                        <th class="px-4 sm:px-6 py-4">Nama</th>
                                        <th class="px-4 sm:px-6 py-4">Email</th>
                                        <th class="px-4 sm:px-6 py-4">Role</th>
                                        <th class="px-4 sm:px-6 py-4 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($users as $user)
                                    <tr class="bg-white hover:bg-blue-50 transition">
                                        <td class="px-4 sm:px-6 py-4 font-semibold text-gray-900">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                                    {{ substr($user->name, 0, 1) }}
                                                </div>
                                                <span class="truncate">{{ $user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 text-gray-600 text-xs sm:text-sm truncate">
                                            {{ $user->email }}
                                        </td>
                                        <td class="px-4 sm:px-6 py-4">
                                            @if($user->role == 'admin')
                                                <span class="inline-flex items-center gap-2 bg-purple-100 text-purple-700 text-xs font-bold px-3 py-1.5 rounded-full">
                                                    <i class="fa-solid fa-crown text-sm"></i>
                                                    Admin
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 text-xs font-bold px-3 py-1.5 rounded-full">
                                                    <i class="fa-solid fa-user text-sm"></i>
                                                    User
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 sm:px-6 py-4">
                                            <div class="flex justify-center gap-3">
                                                <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-flex items-center gap-2 bg-blue-100 text-blue-700 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-blue-200 transition" title="Edit user">
                                                    <i class="fa-solid fa-pencil text-sm"></i>
                                                    <span class="hidden sm:inline">Edit</span>
                                                </a>
                                                
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center gap-2 bg-red-100 text-red-700 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-red-200 transition" title="Hapus user">
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
                            {{ $users->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fa-solid fa-users text-5xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 font-medium mb-2">Tidak ada data user</p>
                            <p class="text-gray-400 text-sm mb-6">Mulai tambahkan user baru dengan klik tombol "Tambah User"</p>
                            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-2.5 rounded-lg font-bold hover:bg-blue-700 transition">
                                <i class="fa-solid fa-plus"></i>
                                Tambah User Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>