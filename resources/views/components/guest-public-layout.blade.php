<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Website Kecamatan' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional Styles -->
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #001d3d 0%, #003566 50%, #0077b6 100%);
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #001d3d, #0077b6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .navbar-blur {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.95);
        }
        
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Mobile Menu Animations */
        .mobile-menu {
            transition: max-height 0.3s ease-in-out;
            overflow: hidden;
        }
        
        .mobile-dropdown-content {
            transition: all 0.3s ease;
        }
        
        .mobile-dropdown-arrow {
            transition: transform 0.3s ease;
        }
        
        /* Smooth scrolling for mobile menu */
        .mobile-menu::-webkit-scrollbar {
            width: 4px;
        }
        
        .mobile-menu::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        .mobile-menu::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 2px;
        }
        
        .mobile-menu::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }
        
        /* Active state styling */
        .mobile-menu a.active {
            background: linear-gradient(135deg, #14213d 0%, #1a2a4a 100%);
            color: white;
            border-left: 4px solid #fbbf24;
        }
        
        /* Touch-friendly sizing */
        @media (max-width: 768px) {
            .mobile-menu a, .mobile-menu button {
                min-height: 48px;
                display: flex;
                align-items: center;
            }
        }
        
        /* Prevent body scroll when menu is open */
        body.mobile-menu-open {
            overflow: hidden;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="fixed w-full z-50 navbar-blur border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-[#14213d] to-[#1a2a4a] rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="text-lg font-bold text-gray-900">Kecamatan</div>
                            <div class="text-xs text-gray-600">Website Resmi</div>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-[#14213d] px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('home') ? 'text-[#14213d] border-b-2 border-[#14213d]' : '' }}">Beranda</a>
                    <a href="{{ route('news.index') }}" class="text-gray-700 hover:text-[#14213d] px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('news*') ? 'text-[#14213d] border-b-2 border-[#14213d]' : '' }}">Berita</a>
                    <a href="{{ route('gallery') }}" class="text-gray-700 hover:text-[#14213d] px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('gallery*') ? 'text-[#14213d] border-b-2 border-[#14213d]' : '' }}">Galeri</a>
                    <div class="relative group">
                        <button class="text-gray-700 hover:text-[#14213d] px-3 py-2 text-sm font-medium transition-colors flex items-center {{ request()->routeIs('transparency*') ? 'text-[#14213d] border-b-2 border-[#14213d]' : '' }}">
                            Transparansi
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <div class="py-1">
                                <a href="{{ route('transparency.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#14213d]">Portal Transparansi</a>
                                <a href="{{ route('transparency.budget') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#14213d]">Anggaran</a>
                                <a href="{{ route('transparency.procurement') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#14213d]">Pengadaan</a>
                                <a href="{{ route('transparency.projects') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#14213d]">Proyek</a>
                                <a href="{{ route('transparency.regulations') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#14213d]">Regulasi</a>
                                <a href="{{ route('transparency.reports') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#14213d]">Laporan</a>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-[#14213d] px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('about') ? 'text-[#14213d] border-b-2 border-[#14213d]' : '' }}">Tentang</a>
                    <div class="relative group">
                        <button class="text-gray-700 hover:text-[#14213d] px-3 py-2 text-sm font-medium transition-colors flex items-center">
                            Layanan
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <div class="py-1">
                                <a href="{{ route('services.documents') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#14213d]">Pengajuan Dokumen</a>
                                <a href="{{ route('services.track') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#14213d]">Lacak Status Dokumen</a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <a href="{{ route('services.complaints') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#14213d]">Pengaduan Masyarakat</a>
                                <a href="{{ route('complaints.track') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#14213d]">Lacak Pengaduan</a>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-[#14213d] px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('contact*') ? 'text-[#14213d] border-b-2 border-[#14213d]' : '' }}">Kontak</a>
                </div>

                <!-- Auth Buttons -->
                <div class="hidden md:flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-[#14213d] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#1a2a4a] transition-colors">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-[#14213d] px-3 py-2 text-sm font-medium transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-[#14213d] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#1a2a4a] transition-colors">Daftar</a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="mobile-menu-button text-gray-700 hover:text-[#14213d] focus:outline-none focus:text-[#14213d] transition-colors duration-200" aria-label="Toggle menu">
                        <svg class="h-6 w-6 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path class="hamburger-line-1" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path class="hamburger-line-2 hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div class="mobile-menu hidden md:hidden bg-white border-t border-gray-200 shadow-lg">
            <div class="px-2 pt-2 pb-3 space-y-1 max-h-screen overflow-y-auto">
                <a href="{{ route('home') }}" class="flex items-center px-3 py-3 text-base font-medium text-gray-700 hover:text-[#14213d] hover:bg-gray-50 rounded-lg transition-all duration-200 {{ request()->routeIs('home') ? 'text-[#14213d] bg-gray-50 border-l-4 border-[#14213d]' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Beranda
                </a>
                
                <a href="{{ route('news.index') }}" class="flex items-center px-3 py-3 text-base font-medium text-gray-700 hover:text-[#14213d] hover:bg-gray-50 rounded-lg transition-all duration-200 {{ request()->routeIs('news*') ? 'text-[#14213d] bg-gray-50 border-l-4 border-[#14213d]' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    Berita
                </a>
                
                <a href="{{ route('gallery') }}" class="flex items-center px-3 py-3 text-base font-medium text-gray-700 hover:text-[#14213d] hover:bg-gray-50 rounded-lg transition-all duration-200 {{ request()->routeIs('gallery*') ? 'text-[#14213d] bg-gray-50 border-l-4 border-[#14213d]' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Galeri
                </a>
                
                <!-- Transparansi Dropdown -->
                <div class="mobile-dropdown">
                    <button class="mobile-dropdown-toggle flex items-center justify-between w-full px-3 py-3 text-base font-medium text-gray-700 hover:text-[#14213d] hover:bg-gray-50 rounded-lg transition-all duration-200 {{ request()->routeIs('transparency*') ? 'text-[#14213d] bg-gray-50 border-l-4 border-[#14213d]' : '' }}">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            Transparansi
                        </div>
                        <svg class="mobile-dropdown-arrow w-4 h-4 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="mobile-dropdown-content hidden ml-8 mt-1 space-y-1 border-l-2 border-gray-100 pl-4">
                        <a href="{{ route('transparency.index') }}" class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-[#14213d] hover:bg-gray-50 rounded-md transition-colors">Portal Transparansi</a>
                        <a href="{{ route('transparency.budget') }}" class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-[#14213d] hover:bg-gray-50 rounded-md transition-colors">Anggaran</a>
                        <a href="{{ route('transparency.procurement') }}" class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-[#14213d] hover:bg-gray-50 rounded-md transition-colors">Pengadaan</a>
                        <a href="{{ route('transparency.projects') }}" class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-[#14213d] hover:bg-gray-50 rounded-md transition-colors">Proyek</a>
                        <a href="{{ route('transparency.regulations') }}" class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-[#14213d] hover:bg-gray-50 rounded-md transition-colors">Regulasi</a>
                        <a href="{{ route('transparency.reports') }}" class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-[#14213d] hover:bg-gray-50 rounded-md transition-colors">Laporan</a>
                    </div>
                </div>
                
                <a href="{{ route('about') }}" class="flex items-center px-3 py-3 text-base font-medium text-gray-700 hover:text-[#14213d] hover:bg-gray-50 rounded-lg transition-all duration-200 {{ request()->routeIs('about') ? 'text-[#14213d] bg-gray-50 border-l-4 border-[#14213d]' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Tentang
                </a>
                
                <!-- Layanan Dropdown -->
                <div class="mobile-dropdown">
                    <button class="mobile-dropdown-toggle flex items-center justify-between w-full px-3 py-3 text-base font-medium text-gray-700 hover:text-[#14213d] hover:bg-gray-50 rounded-lg transition-all duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                            </svg>
                            Layanan
                        </div>
                        <svg class="mobile-dropdown-arrow w-4 h-4 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="mobile-dropdown-content hidden ml-8 mt-1 space-y-1 border-l-2 border-gray-100 pl-4">
                        <a href="{{ route('services.documents') }}" class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-[#14213d] hover:bg-gray-50 rounded-md transition-colors">Pengajuan Dokumen</a>
                        <a href="{{ route('services.track') }}" class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-[#14213d] hover:bg-gray-50 rounded-md transition-colors">Lacak Status Dokumen</a>
                        <a href="{{ route('services.complaints') }}" class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-[#14213d] hover:bg-gray-50 rounded-md transition-colors">Pengaduan Masyarakat</a>
                        <a href="{{ route('complaints.track') }}" class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-[#14213d] hover:bg-gray-50 rounded-md transition-colors">Lacak Pengaduan</a>
                    </div>
                </div>
                
                <a href="{{ route('contact') }}" class="flex items-center px-3 py-3 text-base font-medium text-gray-700 hover:text-[#14213d] hover:bg-gray-50 rounded-lg transition-all duration-200 {{ request()->routeIs('contact*') ? 'text-[#14213d] bg-gray-50 border-l-4 border-[#14213d]' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Kontak
                </a>
                
                <div class="border-t border-gray-200 pt-4 pb-3 mt-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-3 text-base font-medium bg-[#14213d] text-white rounded-lg hover:bg-[#1a2a4a] transition-colors">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            Dashboard
                        </a>
                    @else
                        <div class="space-y-2">
                            <a href="{{ route('login') }}" class="flex items-center px-3 py-3 text-base font-medium text-gray-700 hover:text-[#14213d] hover:bg-gray-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="flex items-center px-3 py-3 text-base font-medium bg-[#14213d] text-white rounded-lg hover:bg-[#1a2a4a] transition-colors">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                Daftar
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-16">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Logo & Description -->
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-800 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="text-lg font-bold">Kecamatan</div>
                            <div class="text-sm text-gray-400">Website Resmi</div>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-4 max-w-md">
                        Website resmi Kecamatan yang menyediakan informasi dan layanan administrasi untuk masyarakat.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-[#14213d] transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-[#14213d] transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-[#14213d] transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-[#14213d] transition-colors">Beranda</a></li>
                        <li><a href="{{ route('news.index') }}" class="text-gray-400 hover:text-[#14213d] transition-colors">Berita</a></li>
                        <li><a href="{{ route('gallery') }}" class="text-gray-400 hover:text-[#14213d] transition-colors">Galeri</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-[#14213d] transition-colors">Tentang</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-[#14213d] transition-colors">Kontak</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Jl. Raya Kecamatan No. 123</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span>(021) 123-4567</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>info@kecamatan.go.id</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Kecamatan. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.querySelector('.mobile-menu-button');
            const mobileMenu = document.querySelector('.mobile-menu');
            const hamburgerLine1 = document.querySelector('.hamburger-line-1');
            const hamburgerLine2 = document.querySelector('.hamburger-line-2');

            // Toggle mobile menu
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    const isHidden = mobileMenu.classList.contains('hidden');
                    
                    if (isHidden) {
                        // Show menu
                        mobileMenu.classList.remove('hidden');
                        mobileMenu.style.maxHeight = mobileMenu.scrollHeight + 'px';
                        document.body.classList.add('mobile-menu-open');
                        
                        // Animate hamburger to X
                        hamburgerLine1.classList.add('hidden');
                        hamburgerLine2.classList.remove('hidden');
                    } else {
                        // Hide menu
                        mobileMenu.style.maxHeight = '0';
                        document.body.classList.remove('mobile-menu-open');
                        setTimeout(() => {
                            mobileMenu.classList.add('hidden');
                        }, 300);
                        
                        // Animate X to hamburger
                        hamburgerLine1.classList.remove('hidden');
                        hamburgerLine2.classList.add('hidden');
                    }
                });
            }

            // Handle mobile dropdown toggles
            const dropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');
            
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const dropdown = this.closest('.mobile-dropdown');
                    const content = dropdown.querySelector('.mobile-dropdown-content');
                    const arrow = dropdown.querySelector('.mobile-dropdown-arrow');
                    
                    // Close other dropdowns
                    dropdownToggles.forEach(otherToggle => {
                        if (otherToggle !== this) {
                            const otherDropdown = otherToggle.closest('.mobile-dropdown');
                            const otherContent = otherDropdown.querySelector('.mobile-dropdown-content');
                            const otherArrow = otherDropdown.querySelector('.mobile-dropdown-arrow');
                            
                            otherContent.classList.add('hidden');
                            otherArrow.style.transform = 'rotate(0deg)';
                        }
                    });
                    
                    // Toggle current dropdown
                    const isHidden = content.classList.contains('hidden');
                    
                    if (isHidden) {
                        content.classList.remove('hidden');
                        arrow.style.transform = 'rotate(180deg)';
                        
                        // Animate content appearance
                        content.style.opacity = '0';
                        content.style.transform = 'translateY(-10px)';
                        
                        setTimeout(() => {
                            content.style.transition = 'all 0.3s ease';
                            content.style.opacity = '1';
                            content.style.transform = 'translateY(0)';
                        }, 10);
                    } else {
                        content.style.transition = 'all 0.3s ease';
                        content.style.opacity = '0';
                        content.style.transform = 'translateY(-10px)';
                        arrow.style.transform = 'rotate(0deg)';
                        
                        setTimeout(() => {
                            content.classList.add('hidden');
                        }, 300);
                    }
                });
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!mobileMenuButton.contains(e.target) && !mobileMenu.contains(e.target)) {
                     if (!mobileMenu.classList.contains('hidden')) {
                         mobileMenu.style.maxHeight = '0';
                         document.body.classList.remove('mobile-menu-open');
                         setTimeout(() => {
                             mobileMenu.classList.add('hidden');
                         }, 300);
                         
                         // Reset hamburger
                         hamburgerLine1.classList.remove('hidden');
                         hamburgerLine2.classList.add('hidden');
                     }
                 }
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) { // md breakpoint
                     mobileMenu.classList.add('hidden');
                     mobileMenu.style.maxHeight = '';
                     document.body.classList.remove('mobile-menu-open');
                     
                     // Reset hamburger
                     hamburgerLine1.classList.remove('hidden');
                     hamburgerLine2.classList.add('hidden');
                     
                     // Close all dropdowns
                     dropdownToggles.forEach(toggle => {
                         const dropdown = toggle.closest('.mobile-dropdown');
                         const content = dropdown.querySelector('.mobile-dropdown-content');
                         const arrow = dropdown.querySelector('.mobile-dropdown-arrow');
                         
                         content.classList.add('hidden');
                         arrow.style.transform = 'rotate(0deg)';
                     });
                 }
            });
        });
    </script>
</body>
</html>