<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        
        <div class="flex h-screen overflow-hidden">
            
            <aside class="hidden md:flex md:flex-shrink-0 w-64 bg-gray-900 border-r border-gray-800">
                @include('layouts.sidebar')
            </aside>

            <div class="flex flex-col flex-1 w-0 overflow-hidden">
                
                <div class="md:hidden flex items-center justify-between bg-gray-900 text-white p-4 shadow">
                    <span class="font-bold text-lg">📚 AdminPanel</span>
                    <a href="{{ route('home') }}" class="text-sm hover:text-gray-300">Ke Website</a>
                </div>

                <header class="bg-white shadow-sm z-10 relative">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                        <div class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ $header ?? 'Dashboard' }}
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-500">Halo, <b>{{ Auth::user()->name }}</b></span>
                            <a href="{{ route('home') }}" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-900 font-bold flex items-center gap-1 border px-3 py-1 rounded hover:bg-indigo-50 transition">
                                <i class="fa-solid fa-globe"></i> Website
                            </a>
                        </div>
                    </div>
                </header>

                <main class="flex-1 overflow-y-auto bg-gray-50 focus:outline-none">
                    {{ $slot }}
                </main>

            </div>
        </div>

    </body>
</html>