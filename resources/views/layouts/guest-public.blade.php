<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Website Kecamatan' }} - {{ config('app.name', 'Website Camat') }}</title>
        
        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <!-- Navigation -->
        <nav x-data="{ open: false }" class="bg-[#14213d] shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('home') }}" class="flex items-center">
                                <x-application-logo class="block h-8 w-auto fill-current text-white" />
                                <span class="ml-2 text-xl font-semibold text-white">Website Kecamatan</span>
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden md:ml-10 md:flex md:space-x-8">
                            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-white border-b-2 border-[#14213d]' : 'text-gray-200 hover:text-white' }} px-3 py-2 text-sm font-medium transition-colors duration-150">
                                Beranda
                            </a>
                            <a href="{{ route('news.index') }}" class="{{ request()->routeIs('news.*') ? 'text-white border-b-2 border-[#14213d]' : 'text-gray-200 hover:text-white' }} px-3 py-2 text-sm font-medium transition-colors duration-150">
                                Berita
                            </a>
                            <a href="{{ route('gallery.index') }}" class="{{ request()->routeIs('gallery.*') ? 'text-white border-b-2 border-[#14213d]' : 'text-gray-200 hover:text-white' }} px-3 py-2 text-sm font-medium transition-colors duration-150">
                                Galeri
                            </a>
                            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-white border-b-2 border-[#14213d]' : 'text-gray-200 hover:text-white' }} px-3 py-2 text-sm font-medium transition-colors duration-150">
                                Tentang
                            </a>
                            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-white border-b-2 border-[#14213d]' : 'text-gray-200 hover:text-white' }} px-3 py-2 text-sm font-medium transition-colors duration-150">
                                Kontak
                            </a>
                        </div>
                    </div>

                    <!-- Auth Links -->
                    <div class="hidden md:flex md:items-center md:space-x-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="bg-[#14213d] hover:bg-[#0f1a2e] text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-150">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-200 hover:text-white px-3 py-2 text-sm font-medium transition-colors duration-150">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="bg-[#14213d] hover:bg-[#0f1a2e] text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-150">
                                Daftar
                            </a>
                        @endauth
                    </div>

                    <!-- Mobile menu button -->
                    <div class="md:hidden flex items-center">
                        <button @click="open = !open" class="text-gray-200 hover:text-white p-2">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div :class="{'block': open, 'hidden': !open}" class="hidden md:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 bg-[#0f1a2e]">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-[#14213d] text-white' : 'text-gray-200 hover:bg-[#14213d] hover:text-white' }} block px-3 py-2 text-base font-medium rounded-md">
                        Beranda
                    </a>
                    <a href="{{ route('news.index') }}" class="{{ request()->routeIs('news.*') ? 'bg-[#14213d] text-white' : 'text-gray-200 hover:bg-[#14213d] hover:text-white' }} block px-3 py-2 text-base font-medium rounded-md">
                        Berita
                    </a>
                    <a href="{{ route('gallery.index') }}" class="{{ request()->routeIs('gallery.*') ? 'bg-[#14213d] text-white' : 'text-gray-200 hover:bg-[#14213d] hover:text-white' }} block px-3 py-2 text-base font-medium rounded-md">
                        Galeri
                    </a>
                    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'bg-[#14213d] text-white' : 'text-gray-200 hover:bg-[#14213d] hover:text-white' }} block px-3 py-2 text-base font-medium rounded-md">
                        Tentang
                    </a>
                    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'bg-[#14213d] text-white' : 'text-gray-200 hover:bg-[#14213d] hover:text-white' }} block px-3 py-2 text-base font-medium rounded-md">
                        Kontak
                    </a>
                    
                    <div class="border-t border-[#14213d] pt-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="bg-[#14213d] hover:bg-[#0f1a2e] text-white block px-3 py-2 text-base font-medium rounded-md">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-200 hover:bg-[#14213d] hover:text-white block px-3 py-2 text-base font-medium rounded-md">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="bg-[#14213d] hover:bg-[#0f1a2e] text-white block px-3 py-2 text-base font-medium rounded-md">
                                Daftar
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-[#14213d] text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Logo & Description -->
                    <div class="md:col-span-2">
                        <div class="flex items-center mb-4">
                            <x-application-logo class="block h-8 w-auto fill-current text-white" />
                            <span class="ml-2 text-xl font-semibold">Website Kecamatan</span>
                        </div>
                        <p class="text-gray-200 mb-4">
                            Portal resmi Kecamatan untuk memberikan layanan terbaik kepada masyarakat dengan transparansi dan akuntabilitas.
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Tautan Cepat</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('home') }}" class="text-gray-200 hover:text-white transition-colors duration-150">Beranda</a></li>
                            <li><a href="{{ route('news.index') }}" class="text-gray-200 hover:text-white transition-colors duration-150">Berita</a></li>
                            <li><a href="{{ route('gallery.index') }}" class="text-gray-200 hover:text-white transition-colors duration-150">Galeri</a></li>
                            <li><a href="{{ route('about') }}" class="text-gray-200 hover:text-white transition-colors duration-150">Tentang</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                        <ul class="space-y-2 text-gray-200">
                            <li>📍 Alamat Kecamatan</li>
                            <li>📞 (021) 1234-5678</li>
                            <li>✉️ info@kecamatan.go.id</li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-[#14213d] mt-8 pt-8 text-center">
                    <p class="text-gray-200">
                        &copy; {{ date('Y') }} Website Kecamatan. Semua hak dilindungi.
                    </p>
                </div>
            </div>
        </footer>
    </body>
</html>