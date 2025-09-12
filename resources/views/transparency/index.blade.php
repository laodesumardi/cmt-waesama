<x-guest-public-layout>
    <x-slot name="title">Portal Transparansi</x-slot>
<!-- Header Section -->
<section class="relative bg-gradient-to-br from-[#14213d] via-[#1a2a4a] to-[#0f1419] min-h-[60vh] flex items-center overflow-hidden">
    <!-- Animated Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="animate-float-slow absolute top-20 left-10 w-32 h-32 bg-white/5 rounded-full blur-xl"></div>
            <div class="animate-float-medium absolute top-40 right-20 w-24 h-24 bg-white/5 rounded-full blur-lg"></div>
            <div class="animate-float-fast absolute bottom-20 left-1/4 w-40 h-40 bg-white/5 rounded-full blur-2xl"></div>
            <div class="animate-float-slow absolute bottom-40 right-1/3 w-28 h-28 bg-white/5 rounded-full blur-lg"></div>
        </div>
    </div>
    
    <!-- Wave Separator -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden">
        <svg class="relative block w-full h-20" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="fill-white"></path>
        </svg>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="animate-fade-in-up">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                Portal
                <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">
                    Transparansi
                </span>
            </h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto mb-8">
                Akses informasi publik yang transparan dan akuntabel untuk mendukung tata kelola pemerintahan yang baik
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#documents" class="bg-gradient-to-r from-yellow-500 to-orange-600 text-white px-8 py-4 rounded-xl font-semibold hover:shadow-2xl hover:scale-105 transition-all duration-300">
                    <i class="fas fa-file-alt mr-2"></i>Lihat Dokumen
                </a>
                <a href="{{ route('transparency.budget') }}" class="bg-white/10 backdrop-blur-sm text-white px-8 py-4 rounded-xl font-semibold border border-white/20 hover:bg-white/20 transition-all duration-300">
                    <i class="fas fa-chart-pie mr-2"></i>Anggaran Daerah
                </a>
            </div>
        </div>
    </div>
</section>
    
    <!-- Statistics Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Total Budget -->
                <div class="bg-white rounded-2xl shadow-xl p-8 text-center transform hover:scale-105 transition-all duration-300">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-money-bill-wave text-2xl text-white"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['total_budget'] }}</h3>
                    <p class="text-gray-600 font-medium">Total Anggaran</p>
                    <p class="text-sm text-gray-500 mt-2">Anggaran tahun {{ date('Y') }}</p>
                </div>
                
                <!-- Budget Realization -->
                <div class="bg-white rounded-2xl shadow-xl p-8 text-center transform hover:scale-105 transition-all duration-300">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-chart-line text-2xl text-white"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['realized_budget'] }}</h3>
                    <p class="text-gray-600 font-medium">Realisasi</p>
                    <p class="text-sm text-gray-500 mt-2">Realisasi anggaran</p>
                </div>
                
                <!-- Remaining Budget -->
                <div class="bg-white rounded-2xl shadow-xl p-8 text-center transform hover:scale-105 transition-all duration-300">
                    <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-wallet text-2xl text-white"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['remaining_budget'] }}</h3>
                    <p class="text-gray-600 font-medium">Sisa Anggaran</p>
                    <p class="text-sm text-gray-500 mt-2">Sisa anggaran tersedia</p>
                </div>
                
                <!-- Total Documents -->
                <div class="bg-white rounded-2xl shadow-xl p-8 text-center transform hover:scale-105 transition-all duration-300">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-file-alt text-2xl text-white"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($stats['total_documents']) }}</h3>
                    <p class="text-gray-600 font-medium">Total Dokumen</p>
                    <p class="text-sm text-gray-500 mt-2">Dokumen transparansi</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Access Categories -->
    <div class="relative bg-gradient-to-br from-gray-50 to-blue-50 py-16">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-blue-600/20 to-purple-600/20"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Kategori Informasi</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Akses cepat ke berbagai kategori dokumen transparansi</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                <a href="{{ route('transparency.budget') }}" class="group bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-6 text-center hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-blue-100/50">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2 group-hover:text-blue-600 transition-colors">Anggaran</h3>
                    <p class="text-sm text-gray-600">APBD, Realisasi, dan Laporan Keuangan</p>
                </a>

                <a href="{{ route('transparency.procurement') }}" class="group bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-6 text-center hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-green-100/50">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M8 11v6a2 2 0 002 2h4a2 2 0 002-2v-6M8 11h8"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2 group-hover:text-green-600 transition-colors">Pengadaan</h3>
                    <p class="text-sm text-gray-600">Tender, Kontrak, dan Pemenang</p>
                </a>

                <a href="{{ route('transparency.projects') }}" class="group bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-6 text-center hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-purple-100/50">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2 group-hover:text-purple-600 transition-colors">Proyek</h3>
                    <p class="text-sm text-gray-600">Pembangunan dan Program</p>
                </a>

                <a href="{{ route('transparency.regulations') }}" class="group bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-6 text-center hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-orange-100/50">
                    <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2 group-hover:text-orange-600 transition-colors">Regulasi</h3>
                    <p class="text-sm text-gray-600">Peraturan dan Kebijakan</p>
                </a>

                <a href="{{ route('transparency.reports') }}" class="group bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-6 text-center hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-red-100/50">
                    <div class="w-16 h-16 bg-gradient-to-r from-red-500 to-red-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2 group-hover:text-red-600 transition-colors">Laporan</h3>
                    <p class="text-sm text-gray-600">Laporan Kinerja dan Evaluasi</p>
                </a>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <section id="documents" class="py-16 bg-gradient-to-br from-gray-50 via-white to-gray-50 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-0 left-0 w-96 h-96 bg-[#14213d] rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#14213d] rounded-full blur-3xl transform translate-x-1/2 translate-y-1/2"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Filter Dokumen</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Gunakan filter di bawah untuk mencari data transparansi yang spesifik sesuai kebutuhan Anda</p>
            </div>
            
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200/50 p-8">
                <form method="GET" action="{{ route('transparency.index') }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Search Input -->
                        <div class="space-y-2">
                            <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                <svg class="w-4 h-4 mr-2 text-[#14213d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Pencarian
                            </label>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="Cari dokumen transparansi..." 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#14213d]/20 focus:border-[#14213d] transition-all duration-200">
                        </div>
                        
                        <!-- Year Filter -->
                        <div class="space-y-2">
                            <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                <svg class="w-4 h-4 mr-2 text-[#14213d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Tahun
                            </label>
                            <select name="year" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#14213d]/20 focus:border-[#14213d] transition-all duration-200 bg-white">
                                <option value="">Semua Tahun</option>
                                @for($i = date('Y'); $i >= 2020; $i--)
                                    <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        
                        <!-- Category Filter -->
                        <div class="space-y-2">
                            <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                <svg class="w-4 h-4 mr-2 text-[#14213d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Kategori
                            </label>
                            <select name="category" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#14213d]/20 focus:border-[#14213d] transition-all duration-200 bg-white">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $key => $label)
                                    <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="space-y-2">
                            <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                <svg class="w-4 h-4 mr-2 text-[#14213d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                </svg>
                                Aksi
                            </label>
                            <div class="flex gap-2">
                                <button type="submit" class="flex-1 bg-gradient-to-r from-[#14213d] to-[#1a2a4a] text-white px-4 py-3 rounded-xl hover:shadow-lg transition-all duration-200 font-medium">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    Cari
                                </button>
                                <a href="{{ route('transparency.index') }}" class="px-4 py-3 border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Charts Section -->
    <section class="relative py-16 bg-gradient-to-br from-gray-50 to-white overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, #3b82f6 2px, transparent 2px), radial-gradient(circle at 75% 75%, #10b981 2px, transparent 2px); background-size: 50px 50px;"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Analisis Data Transparansi</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Visualisasi data untuk memudahkan pemahaman informasi transparansi</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Budget Breakdown Chart -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-gray-100/50">
                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Breakdown Anggaran
                    </h3>
                    <div class="h-64 flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl">
                        <div class="text-center">
                            <svg class="w-16 h-16 text-blue-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                            </svg>
                            <p class="text-gray-600">Chart akan ditampilkan di sini</p>
                        </div>
                    </div>
                </div>
                
                <!-- Progress Realisasi -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-gray-100/50">
                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        Progress Realisasi
                    </h3>
                    <div class="h-64 flex items-center justify-center bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl">
                        <div class="text-center">
                            <svg class="w-16 h-16 text-green-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <p class="text-gray-600">Chart akan ditampilkan di sini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Documents List -->
    <div class="relative bg-white py-16">
        <div class="container mx-auto px-4">
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden border border-gray-100/50">
                <div class="p-8 border-b border-gray-200/50 bg-gradient-to-r from-gray-50 to-blue-50">
                    <div class="text-center">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Daftar Dokumen Transparansi</h2>
                        <p class="text-gray-600">Semua dokumen transparansi yang tersedia untuk publik</p>
                    </div>
                </div>
            
            @if($transparencies->count() > 0)
                <div class="p-8">
                    <div class="text-sm text-gray-600 mb-8 text-center bg-gray-50 rounded-lg p-4">
                        Menampilkan {{ $transparencies->firstItem() }} - {{ $transparencies->lastItem() }} dari {{ $transparencies->total() }} dokumen
                    </div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        @foreach($transparencies as $item)
                        <div class="group bg-white/90 backdrop-blur-sm border border-gray-200/50 rounded-2xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:border-blue-300/50">
                            <div class="flex flex-col h-full">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center space-x-3">
                                            <span class="px-3 py-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-xs font-semibold rounded-full">
                                                {{ $item->category_display }}
                                            </span>
                                        </div>
                                        <div class="flex items-center space-x-3 text-xs text-gray-500">
                                            <span class="bg-gray-100 px-2 py-1 rounded-full flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                {{ number_format($item->views) }}
                                            </span>
                                            <span class="bg-gray-100 px-2 py-1 rounded-full flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                {{ number_format($item->downloads) }}
                                            </span>
                                        </div>
                                    </div>
                                    <h3 class="font-bold text-gray-800 mb-3 text-lg group-hover:text-blue-600 transition-colors line-clamp-2">{{ $item->title }}</h3>
                                    <p class="text-sm text-gray-600 mb-4 line-clamp-3 leading-relaxed">{{ $item->description }}</p>
                                    <div class="flex items-center justify-between text-xs text-gray-500 mb-6">
                                        <span class="bg-gray-100 px-3 py-1 rounded-full">{{ $item->period_display }}</span>
                                        @if($item->amount)
                                            <span class="font-semibold text-green-600 bg-green-50 px-3 py-1 rounded-full">{{ $item->formatted_amount }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex space-x-3 mt-auto">
                                    <a href="{{ route('transparency.show', $item) }}" 
                                       class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Detail
                                    </a>
                                    @if($item->files)
                                        <a href="{{ route('transparency.download', $item) }}" 
                                           class="inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-xl hover:from-green-700 hover:to-green-800 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-12 flex justify-center">
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg p-4 border border-gray-100/50">
                            {{ $transparencies->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            @else
                <div class="p-16 text-center">
                    <div class="max-w-md mx-auto">
                        <div class="bg-gradient-to-br from-gray-100 to-gray-200 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Tidak ada dokumen ditemukan</h3>
                        <p class="text-gray-600 mb-6">Silakan coba dengan filter yang berbeda atau kata kunci lain</p>
                        <a href="{{ route('transparency.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Reset Filter
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
</x-guest-public-layout>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

@keyframes float-slow {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(5deg); }
}

@keyframes float-medium {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(-3deg); }
}

@keyframes float-fast {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-10px) rotate(2deg); }
}

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-float-slow {
    animation: float-slow 6s ease-in-out infinite;
}

.animate-float-medium {
    animation: float-medium 4s ease-in-out infinite;
}

.animate-float-fast {
    animation: float-fast 3s ease-in-out infinite;
}

.animate-fade-in-up {
    animation: fade-in-up 1s ease-out;
}
</style>