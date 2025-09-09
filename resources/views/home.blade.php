<x-guest-public-layout>
    <x-slot name="title">Beranda</x-slot>

    <!-- Hero Section -->
    <section class="relative min-h-screen bg-gradient-to-br from-[#14213d] via-[#1a2a4a] to-[#0f1a2e] text-white overflow-hidden flex items-center">
        <!-- Enhanced Background Elements -->
        <div class="absolute inset-0 opacity-30">
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent animate-pulse"></div>
            <div class="absolute inset-0 bg-gradient-to-l from-transparent via-blue-400/5 to-transparent animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="80" height="80" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.15"%3E%3Ccircle cx="40" cy="40" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <!-- Enhanced Floating Pattern -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-10 w-24 h-24 bg-white/15 rounded-full blur-2xl animate-bounce" style="animation-delay: 0s; animation-duration: 4s;"></div>
            <div class="absolute top-40 right-20 w-20 h-20 bg-yellow-400/20 rounded-full blur-xl animate-bounce" style="animation-delay: 1s; animation-duration: 5s;"></div>
            <div class="absolute bottom-32 left-1/4 w-16 h-16 bg-blue-400/15 rounded-full blur-lg animate-bounce" style="animation-delay: 2s; animation-duration: 6s;"></div>
            <div class="absolute top-1/3 right-1/3 w-12 h-12 bg-white/10 rounded-full blur-md animate-bounce" style="animation-delay: 3s; animation-duration: 7s;"></div>
            <div class="absolute bottom-1/4 right-10 w-18 h-18 bg-yellow-400/10 rounded-full blur-lg animate-bounce" style="animation-delay: 4s; animation-duration: 8s;"></div>
        </div>

        <!-- Floating SVG Pattern -->
        <div class="absolute inset-0 opacity-20">
            <svg class="absolute top-10 left-1/4 w-8 h-8 text-white animate-pulse" style="animation-delay: 1s;" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <svg class="absolute bottom-20 right-1/4 w-6 h-6 text-yellow-400 animate-pulse" style="animation-delay: 2s;" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>
            <svg class="absolute top-1/2 left-10 w-5 h-5 text-blue-400 animate-pulse" style="animation-delay: 3s;" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            </svg>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-24 lg:py-32">
            <div class="text-center">
                <!-- Main Heading with Enhanced Typography -->
                <div class="mb-8 sm:mb-12">
                    <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold mb-6 leading-tight tracking-tight">
                        <span class="block bg-gradient-to-r from-white via-gray-100 to-white bg-clip-text text-transparent">
                            Selamat Datang di
                        </span>
                        <span class="block text-yellow-400 mt-4 drop-shadow-lg">
                            Website Kecamatan Waesama
                        </span>
                    </h1>

                    <!-- Decorative Line -->
                    <div class="flex justify-center mt-6 mb-8">
                        <div class="w-24 h-1 bg-gradient-to-r from-transparent via-yellow-400 to-transparent rounded-full"></div>
                    </div>
                </div>

                <p class="text-xl sm:text-2xl md:text-3xl text-gray-200 mb-12 sm:mb-16 max-w-4xl mx-auto leading-relaxed px-4 font-light">
                    Portal informasi dan layanan digital untuk masyarakat Kecamatan Waesama.
                    <span class="block mt-2 text-lg sm:text-xl text-gray-300">
                        Melayani 11 desa dengan akses berbagai layanan administrasi yang mudah dan cepat.
                    </span>
                </p>

                <!-- Enhanced Buttons with Advanced Glassmorphism -->
                <div class="flex flex-col sm:flex-row gap-6 sm:gap-8 justify-center items-center">
                    <a href="{{ route('news.index') }}" class="group relative inline-flex items-center px-10 sm:px-12 py-5 sm:py-6 bg-white/15 backdrop-blur-xl border border-white/30 text-white rounded-3xl font-bold text-base sm:text-lg hover:bg-white/25 focus:bg-white/25 focus:outline-none focus:ring-4 focus:ring-white/40 focus:ring-offset-2 focus:ring-offset-transparent transition-all duration-700 shadow-2xl hover:shadow-white/30 transform hover:-translate-y-3 hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/20 via-blue-400/10 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                        <div class="absolute inset-0 bg-gradient-to-br from-transparent to-white/5 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <svg class="relative w-7 h-7 sm:w-8 sm:h-8 mr-4 group-hover:rotate-12 group-hover:scale-110 transition-all duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                        <span class="relative group-hover:scale-105 transition-transform duration-300">Lihat Berita Terbaru</span>
                        <div class="absolute -inset-1 bg-gradient-to-r from-white/20 to-blue-400/20 rounded-3xl blur opacity-0 group-hover:opacity-100 transition-opacity duration-700 -z-10"></div>
                    </a>

                    <a href="{{ route('about') }}" class="group relative inline-flex items-center px-10 sm:px-12 py-5 sm:py-6 bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-400 text-[#14213d] rounded-3xl font-bold text-base sm:text-lg hover:from-yellow-300 hover:via-yellow-400 hover:to-yellow-300 focus:from-yellow-300 focus:via-yellow-400 focus:to-yellow-300 focus:outline-none focus:ring-4 focus:ring-yellow-400/60 focus:ring-offset-2 focus:ring-offset-transparent transition-all duration-700 shadow-2xl hover:shadow-yellow-400/40 transform hover:-translate-y-3 hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/30 via-transparent to-white/20 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                        <div class="absolute inset-0 bg-gradient-to-br from-transparent to-yellow-300/20 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <svg class="relative w-7 h-7 sm:w-8 sm:h-8 mr-4 group-hover:rotate-12 group-hover:scale-110 transition-all duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="relative group-hover:scale-105 transition-transform duration-300">Tentang Kecamatan</span>
                        <div class="absolute -inset-1 bg-gradient-to-r from-yellow-400/30 to-yellow-500/30 rounded-3xl blur opacity-0 group-hover:opacity-100 transition-opacity duration-700 -z-10"></div>
                    </a>
                </div>

                <!-- Scroll Indicator -->
                <div class="mt-16 sm:mt-20 animate-bounce">
                    <svg class="w-6 h-6 mx-auto text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Wave Separator -->
        <div class="absolute bottom-0 left-0 w-full">
            <svg viewBox="0 0 1440 120" class="w-full h-8 sm:h-12 lg:h-16 fill-white">
                <path d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,48C672,43,768,53,864,64C960,75,1056,85,1152,80C1248,75,1344,53,1392,42.7L1440,32L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"></path>
            </svg>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-16 sm:py-20 lg:py-24 bg-gradient-to-br from-gray-50 via-white to-blue-50 relative overflow-hidden">
        <!-- Enhanced Background Elements -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-32 h-32 bg-[#14213d]/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 0s; animation-duration: 4s;"></div>
            <div class="absolute bottom-20 right-20 w-40 h-40 bg-blue-400/15 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s; animation-duration: 6s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-r from-[#14213d]/5 to-blue-400/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s; animation-duration: 8s;"></div>
        </div>

        <!-- Floating Pattern -->
        <div class="absolute inset-0 opacity-15">
            <svg class="absolute top-20 right-1/4 w-6 h-6 text-[#14213d] animate-bounce" style="animation-delay: 1s; animation-duration: 3s;" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <svg class="absolute bottom-32 left-1/3 w-5 h-5 text-blue-400 animate-bounce" style="animation-delay: 2s; animation-duration: 4s;" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>
        </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16 lg:mb-20">
                <span class="inline-block px-4 py-2 bg-[#14213d] bg-opacity-10 text-[#14213d] rounded-full text-sm font-semibold mb-4">DATA TERKINI</span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-[#14213d] mb-6">Statistik Kecamatan</h2>
                <p class="text-xl sm:text-2xl text-gray-600 max-w-3xl mx-auto">Data pelayanan dan aktivitas Kecamatan Waesama dalam angka</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-10">
                <div class="stat-card group relative bg-white/90 backdrop-blur-xl p-10 sm:p-12 rounded-3xl shadow-2xl border border-white/60 hover:shadow-3xl hover:bg-white/95 transition-all duration-700 transform hover:-translate-y-4 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-br from-[#14213d]/10 via-blue-400/5 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                    <div class="absolute -inset-1 bg-gradient-to-r from-[#14213d]/20 to-blue-400/20 rounded-3xl blur opacity-0 group-hover:opacity-100 transition-opacity duration-700 -z-10"></div>
                    <div class="relative">
                        <div class="bg-gradient-to-br from-[#14213d] via-[#1a2a4a] to-[#14213d] rounded-3xl w-24 h-24 sm:w-28 sm:h-28 flex items-center justify-center mx-auto mb-8 sm:mb-10 shadow-2xl group-hover:scale-125 group-hover:rotate-6 transition-all duration-500">
                            <svg class="w-12 h-12 sm:w-14 sm:h-14 text-white group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-5xl sm:text-6xl font-bold text-[#14213d] mb-4 sm:mb-5 group-hover:scale-110 group-hover:text-[#0f1a2e] transition-all duration-500">{{ number_format($statistics['total_users']) }}</h3>
                        <p class="text-gray-700 font-bold text-xl group-hover:text-gray-800 transition-colors duration-300">Warga Terdaftar</p>
                        <div class="mt-6 h-2 bg-gradient-to-r from-[#14213d] via-blue-400 to-[#14213d] rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                    </div>
                </div>

                <div class="stat-card group relative bg-white/90 backdrop-blur-xl p-10 sm:p-12 rounded-3xl shadow-2xl border border-white/60 hover:shadow-3xl hover:bg-white/95 transition-all duration-700 transform hover:-translate-y-4 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-500/10 via-green-400/5 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                    <div class="absolute -inset-1 bg-gradient-to-r from-green-500/20 to-green-400/20 rounded-3xl blur opacity-0 group-hover:opacity-100 transition-opacity duration-700 -z-10"></div>
                    <div class="relative">
                        <div class="bg-gradient-to-br from-green-500 via-green-600 to-green-500 rounded-3xl w-24 h-24 sm:w-28 sm:h-28 flex items-center justify-center mx-auto mb-8 sm:mb-10 shadow-2xl group-hover:scale-125 group-hover:rotate-6 transition-all duration-500">
                            <svg class="w-12 h-12 sm:w-14 sm:h-14 text-white group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-5xl sm:text-6xl font-bold text-[#14213d] mb-4 sm:mb-5 group-hover:scale-110 group-hover:text-[#0f1a2e] transition-all duration-500">{{ number_format($statistics['total_news']) }}</h3>
                        <p class="text-gray-700 font-bold text-xl group-hover:text-gray-800 transition-colors duration-300">Berita Terpublikasi</p>
                        <div class="mt-6 h-2 bg-gradient-to-r from-green-500 via-green-400 to-green-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                    </div>
                </div>

                <div class="stat-card group relative bg-white/90 backdrop-blur-xl p-10 sm:p-12 rounded-3xl shadow-2xl border border-white/60 hover:shadow-3xl hover:bg-white/95 transition-all duration-700 transform hover:-translate-y-4 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-br from-[#14213d]/10 via-blue-400/5 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                    <div class="absolute -inset-1 bg-gradient-to-r from-[#14213d]/20 to-blue-400/20 rounded-3xl blur opacity-0 group-hover:opacity-100 transition-opacity duration-700 -z-10"></div>
                    <div class="relative">
                        <div class="bg-gradient-to-br from-[#14213d] via-[#1a2a4a] to-[#14213d] rounded-3xl w-24 h-24 sm:w-28 sm:h-28 flex items-center justify-center mx-auto mb-8 sm:mb-10 shadow-2xl group-hover:scale-125 group-hover:rotate-6 transition-all duration-500">
                            <svg class="w-12 h-12 sm:w-14 sm:h-14 text-white group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-5xl sm:text-6xl font-bold text-[#14213d] mb-4 sm:mb-5 group-hover:scale-110 group-hover:text-[#0f1a2e] transition-all duration-500">{{ number_format($statistics['total_gallery']) }}</h3>
                        <p class="text-gray-700 font-bold text-xl group-hover:text-gray-800 transition-colors duration-300">Foto Galeri</p>
                        <div class="mt-6 h-2 bg-gradient-to-r from-[#14213d] via-blue-400 to-[#14213d] rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                    </div>
                </div>

                <div class="stat-card group relative bg-white/90 backdrop-blur-xl p-10 sm:p-12 rounded-3xl shadow-2xl border border-white/60 hover:shadow-3xl hover:bg-white/95 transition-all duration-700 transform hover:-translate-y-4 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-br from-[#14213d]/10 via-blue-400/5 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                    <div class="absolute -inset-1 bg-gradient-to-r from-[#14213d]/20 to-blue-400/20 rounded-3xl blur opacity-0 group-hover:opacity-100 transition-opacity duration-700 -z-10"></div>
                    <div class="relative">
                        <div class="bg-gradient-to-br from-[#14213d] via-[#1a2a4a] to-[#14213d] rounded-3xl w-24 h-24 sm:w-28 sm:h-28 flex items-center justify-center mx-auto mb-8 sm:mb-10 shadow-2xl group-hover:scale-125 group-hover:rotate-6 transition-all duration-500">
                            <svg class="w-12 h-12 sm:w-14 sm:h-14 text-white group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-5xl sm:text-6xl font-bold text-[#14213d] mb-4 sm:mb-5 group-hover:scale-110 group-hover:text-[#0f1a2e] transition-all duration-500">{{ number_format($statistics['total_complaints']) }}</h3>
                        <p class="text-gray-700 font-bold text-xl group-hover:text-gray-800 transition-colors duration-300">Pengaduan Masuk</p>
                        <div class="mt-6 h-2 bg-gradient-to-r from-[#14213d] via-blue-400 to-[#14213d] rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Villages Section -->
    <section class="py-16 sm:py-20 lg:py-24 bg-gradient-to-br from-[#14213d] via-[#1a2a4a] to-[#0f1a2e] text-white relative overflow-hidden">
        <!-- Enhanced Background Elements -->
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-10 left-10 w-32 h-32 bg-white/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 0s; animation-duration: 4s;"></div>
            <div class="absolute bottom-20 right-20 w-40 h-40 bg-yellow-400/15 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s; animation-duration: 6s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-r from-white/5 to-yellow-400/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s; animation-duration: 8s;"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16 lg:mb-20">
                <span class="inline-block px-4 py-2 bg-white/20 backdrop-blur-sm text-white rounded-full text-sm font-semibold mb-4">WILAYAH ADMINISTRATIF</span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-6">
                    <span class="bg-gradient-to-r from-white via-yellow-400 to-white bg-clip-text text-transparent">
                        11 Desa di Kecamatan Waesama
                    </span>
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-white via-yellow-400 to-white mx-auto rounded-full mb-6"></div>
                <p class="text-xl sm:text-2xl text-gray-200 max-w-3xl mx-auto leading-relaxed">
                    Mengenal lebih dekat desa-desa yang menjadi bagian dari Kecamatan Waesama dengan berbagai potensi dan keunikannya
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 sm:gap-8 mb-12">
                <!-- Desa Cards -->
                <div class="group relative bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative">
                        <div class="w-12 h-12 bg-yellow-400/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2 group-hover:text-yellow-400 transition-colors duration-300">Desa Waesama</h3>
                        <p class="text-gray-300 text-sm mb-3">Desa pusat kecamatan dengan fasilitas lengkap</p>
                        <div class="text-xs text-gray-400">
                            <div class="flex items-center mb-1">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Camat: Harun Soewakil (Pj)
                            </div>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                0812-4444-1339
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Repeat similar structure for other villages -->
                <div class="group relative bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative">
                        <div class="w-12 h-12 bg-yellow-400/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2 group-hover:text-yellow-400 transition-colors duration-300">Desa Waetawa</h3>
                        <p class="text-gray-300 text-sm mb-3">Desa dengan potensi pertanian dan perikanan</p>
                        <div class="text-xs text-gray-400">
                            <div class="flex items-center mb-1">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Kepala Desa: Firdaus Souwakil (Definitif)
                            </div>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                0822-3840-4758
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add more village cards with similar structure -->
                <div class="group relative bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative">
                        <div class="w-12 h-12 bg-yellow-400/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2 group-hover:text-yellow-400 transition-colors duration-300">Desa Waesili</h3>
                        <p class="text-gray-300 text-sm mb-3">Desa dengan sumber mata air jernih</p>
                        <div class="text-xs text-gray-400">
                            <div class="flex items-center mb-1">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Kepala Desa: Iswan Jampolo, SST (Pj)
                            </div>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                0822-9947-7810
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Continue with remaining villages -->
                <div class="group relative bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative">
                        <div class="w-12 h-12 bg-yellow-400/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2 group-hover:text-yellow-400 transition-colors duration-300">Desa Simi</h3>
                        <p class="text-gray-300 text-sm mb-3">Desa dengan potensi wisata alam</p>
                        <div class="text-xs text-gray-400">
                            <div class="flex items-center mb-1">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Kepala Desa: Muhamad Fakaubun (Pj)
                            </div>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                0853-8417-8613
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Desa 5 -->
                <div class="group relative bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative">
                        <div class="w-12 h-12 bg-yellow-400/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2 group-hover:text-yellow-400 transition-colors duration-300">Desa Lena</h3>
                        <p class="text-gray-300 text-sm mb-3">Desa dengan potensi pertanian dan perkebunan</p>
                        <div class="text-xs text-gray-400">
                            <div class="flex items-center mb-1">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Kepala Desa: Anas Takimpo, S.IP (Pj)
                            </div>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                0821-9892-1117
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Desa 6 -->
                <div class="group relative bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative">
                        <div class="w-12 h-12 bg-yellow-400/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2 group-hover:text-yellow-400 transition-colors duration-300">Desa Wamsisi</h3>
                        <p class="text-gray-300 text-sm mb-3">Desa dengan potensi wisata alam dan budaya</p>
                        <div class="text-xs text-gray-400">
                            <div class="flex items-center mb-1">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Kepala Desa: Bachrudin Yusuf M, S.Tr.IP (Pj)
                            </div>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                0823-1986-0372
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Desa 7 -->
                <div class="group relative bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative">
                        <div class="w-12 h-12 bg-yellow-400/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2 group-hover:text-yellow-400 transition-colors duration-300">Desa Waelikut</h3>
                        <p class="text-gray-300 text-sm mb-3">Desa dengan potensi pertanian dan peternakan</p>
                        <div class="text-xs text-gray-400">
                            <div class="flex items-center mb-1">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Kepala Desa: Agil Bin Yahya (Pj)
                            </div>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                0823-9151-4383
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Desa 8 -->
                <div class="group relative bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative">
                        <div class="w-12 h-12 bg-yellow-400/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2 group-hover:text-yellow-400 transition-colors duration-300">Desa Waeteba</h3>
                        <p class="text-gray-300 text-sm mb-3">Desa dengan potensi wisata alam dan budaya</p>
                        <div class="text-xs text-gray-400">
                            <div class="flex items-center mb-1">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Kepala Desa: Faeda'Pelu (Pj)
                            </div>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                0812-1650-9502
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Desa 9 -->
                <div class="group relative bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative">
                        <div class="w-12 h-12 bg-yellow-400/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2 group-hover:text-yellow-400 transition-colors duration-300">Desa Pohon Batu</h3>
                        <p class="text-gray-300 text-sm mb-3">Desa dengan formasi batu unik dan wisata alam</p>
                        <div class="text-xs text-gray-400">
                            <div class="flex items-center mb-1">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Kepala Desa: Suaib Umanailo (Pj)
                            </div>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                0812-4771-1397
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Desa 10 -->
                <div class="group relative bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative">
                        <div class="w-12 h-12 bg-yellow-400/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2 group-hover:text-yellow-400 transition-colors duration-300">Desa Hotte</h3>
                        <p class="text-gray-300 text-sm mb-3">Desa dengan potensi pertanian dan peternakan</p>
                        <div class="text-xs text-gray-400">
                            <div class="flex items-center mb-1">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Kepala Desa: Abukasim Titawael, S.M (Pj)
                            </div>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                0852-1685-4491
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Desa 11 -->
                <div class="group relative bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative">
                        <div class="w-12 h-12 bg-yellow-400/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2 group-hover:text-yellow-400 transition-colors duration-300">Desa Waemasing</h3>
                        <p class="text-gray-300 text-sm mb-3">Desa dengan potensi wisata dan budaya lokal</p>
                        <div class="text-xs text-gray-400">
                            <div class="flex items-center mb-1">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Kepala Desa: Darusman Booy (Pj)
                            </div>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                0821-9449-6199
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Desa 11 -->
                <div class="group relative bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative">
                        <div class="w-12 h-12 bg-yellow-400/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2 group-hover:text-yellow-400 transition-colors duration-300">Desa Batu Kasa</h3>
                        <p class="text-gray-300 text-sm mb-3">Desa dengan formasi batu karang dan wisata alam</p>
                        <div class="text-xs text-gray-400">
                            <div class="flex items-center mb-1">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Kepala Desa: Gani Namkatu (Pj)
                            </div>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                0813-6204-6221
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View All Villages Button -->
            <div class="text-center">
                <a href="{{ route('villages') }}" class="group inline-flex items-center px-8 sm:px-10 py-4 sm:py-5 bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-400 text-[#14213d] font-bold rounded-2xl shadow-xl hover:shadow-2xl hover:from-yellow-300 hover:via-yellow-400 hover:to-yellow-300 transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 text-base sm:text-lg">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <span>Lihat Semua Desa</span>
                    <svg class="ml-3 w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Village Profile Section -->
    @if($villageInfo)
    <section class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-[#14213d] bg-opacity-10 text-[#14213d] rounded-full text-sm font-semibold mb-4">PROFIL WILAYAH</span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-[#14213d] mb-6">Profil Kecamatan</h2>
                <p class="text-xl sm:text-2xl text-gray-600 max-w-3xl mx-auto">Mengenal lebih dekat wilayah dan pelayanan kecamatan kami</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-8">
                    <div>
                        <h3 class="text-3xl font-bold text-[#14213d] mb-6">{{ $villageInfo->name }}</h3>
                        <p class="text-gray-700 text-lg leading-relaxed">
                            {{ $villageInfo->description }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-[#14213d] bg-opacity-10 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-[#14213d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-[#14213d] text-lg">Luas Wilayah</h4>
                            </div>
                            <p class="text-2xl font-bold text-gray-800">{{ $villageInfo->area }} km²</p>
                        </div>

                        <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-[#14213d] bg-opacity-10 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-[#14213d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-[#14213d] text-lg">Jumlah Penduduk</h4>
                            </div>
                            <p class="text-2xl font-bold text-gray-800">{{ number_format($villageInfo->population) }} jiwa</p>
                        </div>
                    </div>

                    <div>
                        <a href="{{ route('about') }}" class="inline-flex items-center px-8 py-4 bg-[#14213d] border border-transparent rounded-xl font-bold text-base text-white hover:bg-[#0f1a2e] focus:bg-[#0f1a2e] active:bg-[#0a1423] focus:outline-none focus:ring-4 focus:ring-[#14213d] focus:ring-opacity-30 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                            Selengkapnya
                            <svg class="ml-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="bg-white p-10 rounded-2xl shadow-2xl border border-gray-100">
                    <div class="flex items-center mb-8">
                        <div class="w-16 h-16 bg-[#14213d] bg-opacity-10 rounded-2xl flex items-center justify-center mr-6">
                            <svg class="w-8 h-8 text-[#14213d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-bold text-[#14213d]">Informasi Kontak</h4>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-start p-4 bg-gray-50 rounded-xl">
                            <svg class="w-6 h-6 text-[#14213d] mt-1 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div>
                                <p class="font-bold text-gray-900 mb-1">Alamat</p>
                                <p class="text-gray-700">{{ $villageInfo->address }}</p>
                            </div>
                        </div>

                        <div class="flex items-start p-4 bg-gray-50 rounded-xl">
                            <svg class="w-6 h-6 text-[#14213d] mt-1 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <div>
                                <p class="font-bold text-gray-900 mb-1">Telepon</p>
                                <p class="text-gray-700">{{ $villageInfo->phone }}</p>
                            </div>
                        </div>

                        <div class="flex items-start p-4 bg-gray-50 rounded-xl">
                            <svg class="w-6 h-6 text-[#14213d] mt-1 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <div>
                                <p class="font-bold text-gray-900 mb-1">Email</p>
                                <p class="text-gray-700">{{ $villageInfo->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Latest News Section -->
    @if($latestNews->count() > 0)
    <section class="py-16 sm:py-20 lg:py-24 bg-white relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-bl from-[#14213d]/5 to-transparent rounded-full -translate-y-48 translate-x-48"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-gradient-to-tr from-yellow-400/10 to-transparent rounded-full translate-y-40 -translate-x-40"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16 lg:mb-20">
                <div class="inline-flex items-center px-4 py-2 bg-[#14213d]/10 text-[#14213d] rounded-full text-sm font-semibold mb-6">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    BERITA TERKINI
                </div>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-[#14213d] mb-6">
                    Informasi Terbaru
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-[#14213d] to-yellow-400 mx-auto rounded-full mb-6"></div>
                <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Dapatkan informasi terkini dan terpercaya dari kecamatan untuk tetap update dengan berbagai kegiatan dan pengumuman penting
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
                @foreach($latestNews as $news)
                <article class="group relative bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl border border-white/50 overflow-hidden hover:shadow-2xl hover:bg-white/90 transition-all duration-500 transform hover:-translate-y-4 hover:scale-105">
                    <!-- Image Container with Overlay -->
                    <div class="relative overflow-hidden">
                        @if($news->featured_image)
                                <img src="{{ asset('storage/' . $news->featured_image) }}" alt="{{ $news->title }}" class="w-full h-48 sm:h-56 object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                        <div class="w-full h-48 sm:h-56 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <svg class="w-12 h-12 sm:w-16 sm:h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                        @endif

                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        <!-- Date Badge -->
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full">
                            <div class="flex items-center text-xs font-semibold text-[#14213d]">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $news->created_at->format('d M Y') }}
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="relative p-6 sm:p-8">
                        <!-- Background Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-br from-[#14213d]/5 to-transparent rounded-b-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        <div class="relative">
                            <h3 class="text-xl sm:text-2xl font-bold text-[#14213d] mb-4 line-clamp-2 group-hover:text-[#0f1a2e] transition-colors duration-300">
                                <a href="{{ route('news.show', $news->id) }}" class="hover:text-[#0f1a2e] transition-colors duration-300">
                                    {{ $news->title }}
                                </a>
                            </h3>

                            <p class="text-gray-600 mb-6 line-clamp-3 text-base leading-relaxed group-hover:text-gray-700 transition-colors duration-300">
                                {{ Str::limit(strip_tags($news->content), 140) }}
                            </p>

                            <!-- Read More Button -->
                            <a href="{{ route('news.show', $news->id) }}" class="inline-flex items-center px-6 py-3 bg-[#14213d]/10 hover:bg-[#14213d] text-[#14213d] hover:text-white rounded-2xl font-semibold transition-all duration-300 group-hover:scale-105 transform">
                                <span>Baca Selengkapnya</span>
                                <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- View All News Button -->
            <div class="text-center mt-12 sm:mt-16">
                <a href="{{ route('news.index') }}" class="group inline-flex items-center px-8 sm:px-10 py-4 sm:py-5 bg-gradient-to-r from-[#14213d] to-[#1a2a4a] hover:from-[#0f1a2e] hover:to-[#14213d] text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 text-base sm:text-lg">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    <span>Lihat Semua Berita</span>
                    <svg class="ml-3 w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- Services Section -->
    <section class="relative py-16 sm:py-20 lg:py-24 bg-gradient-to-br from-gray-50 via-white to-blue-50 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-20 left-10 w-32 h-32 bg-[#14213d]/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-40 h-40 bg-blue-400/10 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-r from-[#14213d]/5 to-transparent rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12 sm:mb-16">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-[#14213d]/10 rounded-2xl mb-6">
                    <svg class="w-8 h-8 text-[#14213d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>

                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-[#14213d] mb-4 sm:mb-6">
                    <span class="bg-gradient-to-r from-[#14213d] to-[#1a2a4a] bg-clip-text text-transparent">Layanan</span> Kami
                </h2>

                <div class="w-24 h-1 bg-gradient-to-r from-[#14213d] to-[#1a2a4a] mx-auto mb-6"></div>

                <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Akses berbagai layanan kecamatan dengan mudah dan cepat untuk memenuhi kebutuhan administrasi Anda
                </p>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
                <!-- Service 1: Layanan Surat -->
                <div class="group relative bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl border border-white/50 overflow-hidden hover:shadow-2xl hover:bg-white/90 transition-all duration-500 transform hover:-translate-y-4 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-[#14213d]/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <div class="relative p-8 sm:p-10">
                        <div class="bg-gradient-to-br from-[#14213d] to-[#1a2a4a] rounded-2xl w-20 h-20 flex items-center justify-center mx-auto mb-6 shadow-2xl group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>

                        <h3 class="text-2xl font-bold text-[#14213d] mb-4 text-center group-hover:text-[#0f1a2e] transition-colors duration-300">
                            Layanan Surat
                        </h3>

                        <p class="text-gray-600 text-center mb-6 leading-relaxed">
                            Pengurusan berbagai jenis surat keterangan dan dokumen administrasi kependudukan
                        </p>

                        <div class="text-center">
                            <a href="#" class="inline-flex items-center px-6 py-3 bg-[#14213d]/10 hover:bg-[#14213d] text-[#14213d] hover:text-white rounded-2xl font-semibold transition-all duration-300 group-hover:scale-105 transform">
                                <span>Akses Layanan</span>
                                <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Service 2: Pengaduan -->
                <div class="group relative bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl border border-white/50 overflow-hidden hover:shadow-2xl hover:bg-white/90 transition-all duration-500 transform hover:-translate-y-4 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-[#14213d]/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <div class="relative p-8 sm:p-10">
                        <div class="bg-gradient-to-br from-[#14213d] to-[#1a2a4a] rounded-2xl w-20 h-20 flex items-center justify-center mx-auto mb-6 shadow-2xl group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>

                        <h3 class="text-2xl font-bold text-[#14213d] mb-4 text-center group-hover:text-[#0f1a2e] transition-colors duration-300">
                            Pengaduan
                        </h3>

                        <p class="text-gray-600 text-center mb-6 leading-relaxed">
                            Sampaikan keluhan, saran, atau laporan terkait pelayanan dan fasilitas kecamatan
                        </p>

                        <div class="text-center">
                            <a href="#" class="inline-flex items-center px-6 py-3 bg-[#14213d]/10 hover:bg-[#14213d] text-[#14213d] hover:text-white rounded-2xl font-semibold transition-all duration-300 group-hover:scale-105 transform">
                                <span>Buat Pengaduan</span>
                                <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Service 3: Informasi -->
                <div class="group relative bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl border border-white/50 overflow-hidden hover:shadow-2xl hover:bg-white/90 transition-all duration-500 transform hover:-translate-y-4 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-[#14213d]/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <div class="relative p-8 sm:p-10">
                        <div class="bg-gradient-to-br from-[#14213d] to-[#1a2a4a] rounded-2xl w-20 h-20 flex items-center justify-center mx-auto mb-6 shadow-2xl group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>

                        <h3 class="text-2xl font-bold text-[#14213d] mb-4 text-center group-hover:text-[#0f1a2e] transition-colors duration-300">
                            Informasi
                        </h3>

                        <p class="text-gray-600 text-center mb-6 leading-relaxed">
                            Dapatkan informasi terkini tentang program, kegiatan, dan pengumuman kecamatan
                        </p>

                        <div class="text-center">
                            <a href="#" class="inline-flex items-center px-6 py-3 bg-[#14213d]/10 hover:bg-[#14213d] text-[#14213d] hover:text-white rounded-2xl font-semibold transition-all duration-300 group-hover:scale-105 transform">
                                <span>Cari Informasi</span>
                                <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Access Section -->
            <div class="mt-16 sm:mt-20 text-center">
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl border border-white/50 p-8 sm:p-12 max-w-4xl mx-auto">
                    <h3 class="text-2xl sm:text-3xl font-bold text-[#14213d] mb-4">
                        Akses Cepat
                    </h3>
                    <p class="text-gray-600 mb-8 text-lg leading-relaxed">
                        Lacak status pengajuan atau akses layanan online dengan mudah
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="#" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-[#14213d] to-[#1a2a4a] hover:from-[#0f1a2e] hover:to-[#14213d] text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                            <span>Lacak Status Pengajuan</span>
                        </a>

                        <a href="#" class="inline-flex items-center px-8 py-4 bg-white hover:bg-gray-50 text-[#14213d] border-2 border-[#14213d] font-bold rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                            </svg>
                            <span>Layanan Online</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-guest-public-layout>
