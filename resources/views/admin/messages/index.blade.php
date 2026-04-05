<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl sm:text-3xl text-gray-900">
                {{ __('Pesan Masuk') }}
            </h2>
            <p class="text-gray-600 text-sm mt-1">Kelola pesan dari pengunjung website</p>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl">
                <div class="p-4 sm:p-8 text-gray-900">
                    @if($messages->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-600">
                                <thead class="text-xs uppercase font-bold bg-gradient-to-r from-gray-100 to-gray-50 text-gray-700 border-b border-gray-200">
                                    <tr>
                                        <th class="px-4 sm:px-6 py-4">Nama</th>
                                        <th class="px-4 sm:px-6 py-4">Email</th>
                                        <th class="px-4 sm:px-6 py-4 hidden sm:table-cell">Pesan</th>
                                        <th class="px-4 sm:px-6 py-4 hidden md:table-cell">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($messages as $message)
                                        <tr class="bg-white hover:bg-blue-50 transition cursor-pointer group">
                                            <td class="px-4 sm:px-6 py-4 font-semibold text-gray-900">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                                        {{ substr($message->name, 0, 1) }}
                                                    </div>
                                                    <span class="truncate">{{ $message->name }}</span>
                                                </div>
                                            </td>
                                            <td class="px-4 sm:px-6 py-4">
                                                <a href="mailto:{{ $message->email }}" class="text-blue-600 hover:text-blue-800 font-medium text-xs sm:text-sm truncate">
                                                    {{ $message->email }}
                                                </a>
                                            </td>
                                            <td class="px-4 sm:px-6 py-4 hidden sm:table-cell">
                                                <p class="text-gray-600 line-clamp-2 text-xs sm:text-sm">{{ $message->message }}</p>
                                            </td>
                                            <td class="px-4 sm:px-6 py-4 hidden md:table-cell text-xs text-gray-500">
                                                {{ $message->created_at->format('d M Y H:i') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6 border-t border-gray-200 pt-6">
                            {{ $messages->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fa-solid fa-envelope text-5xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 font-medium mb-2">Belum ada pesan masuk</p>
                            <p class="text-gray-400 text-sm">Pesan dari pengunjung akan ditampilkan di sini</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
