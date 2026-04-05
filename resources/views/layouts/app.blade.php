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
            
            <!-- Desktop Sidebar -->
            <aside class="hidden lg:flex lg:flex-shrink-0 w-64 bg-gray-900 border-r border-gray-800 flex-col">
                @include('layouts.sidebar')
            </aside>

            <!-- Mobile Sidebar Overlay -->
            <div id="mobile-sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 lg:hidden hidden z-40" onclick="toggleMobileSidebar()"></div>

            <!-- Mobile Sidebar -->
            <aside id="mobile-sidebar" class="fixed left-0 top-0 h-full w-64 bg-gray-900 border-r border-gray-800 z-50 lg:hidden transform -translate-x-full transition-transform duration-300 flex flex-col overflow-y-auto">
                @include('layouts.sidebar')
            </aside>

            <div class="flex flex-col flex-1 w-0 overflow-hidden">
                
                <!-- Mobile Header with Hamburger -->
                <div class="lg:hidden flex items-center justify-between bg-gray-900 text-white px-4 py-3 shadow">
                    <button onclick="toggleMobileSidebar()" class="p-2 rounded hover:bg-gray-800 transition" title="Toggle Sidebar">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                    <span class="font-bold text-lg">📚 AdminPanel</span>
                    <a href="{{ route('home') }}" class="p-2 rounded hover:bg-gray-800 transition" title="Kembali ke Website">
                        <i class="fa-solid fa-home text-xl"></i>
                    </a>
                </div>

                <header class="bg-white shadow-sm z-10 relative">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                        <div class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ $header ?? 'Dashboard' }}
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="hidden sm:inline text-sm text-gray-500">Halo, <b>{{ Auth::user()->name }}</b></span>
                            <a href="{{ route('home') }}" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-900 font-bold flex items-center gap-1 border px-3 py-1 rounded hover:bg-indigo-50 transition">
                                <i class="fa-solid fa-globe hidden sm:inline"></i> 
                                <span class="hidden sm:inline">Website</span>
                                <span class="sm:hidden"><i class="fa-solid fa-arrow-up-right-from-square"></i></span>
                            </a>
                        </div>
                    </div>
                </header>

                <main class="flex-1 overflow-y-auto bg-gray-50 focus:outline-none">
                    {{ $slot }}
                </main>

            </div>
        </div>

        <script>
            function toggleMobileSidebar() {
                const sidebar = document.getElementById('mobile-sidebar');
                const overlay = document.getElementById('mobile-sidebar-overlay');
                
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }

            // Close sidebar when clicking on overlay
            document.getElementById('mobile-sidebar-overlay')?.addEventListener('click', toggleMobileSidebar);

            // Close sidebar when clicking on a link
            const sidebarLinks = document.querySelectorAll('#mobile-sidebar a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 1024) { // lg breakpoint
                        toggleMobileSidebar();
                    }
                });
            });
        </script>
    </body>
</html>