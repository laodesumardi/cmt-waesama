<x-guest-public-layout>
    <x-slot name="title">Desa-Desa</x-slot>

    <!-- Header Section -->
    <section class="relative bg-gradient-to-br from-[#14213d] via-[#1a2a4a] to-[#0f1a2e] text-white py-20 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-300 rounded-full blur-3xl transform translate-x-1/2 translate-y-1/2"></div>
        </div>
        
        <!-- Animated Pattern -->
        <div class="absolute inset-0 opacity-5">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="villages-grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <circle cx="5" cy="5" r="1" fill="currentColor" class="animate-pulse"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#villages-grid)"/>
            </svg>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <!-- Icon -->
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white/10 backdrop-blur-sm rounded-2xl mb-8 group">
                    <svg class="w-10 h-10 text-white group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                
                <h1 class="text-4xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-white to-gray-200 bg-clip-text text-transparent">
                    Desa-Desa Kecamatan Waesama
                </h1>
                <p class="text-xl md:text-2xl text-gray-200 max-w-3xl mx-auto leading-relaxed">
                    Informasi lengkap mengenai 11 desa di Kecamatan Waesama dengan data kepala desa dan kontak yang dapat dihubungi
                </p>
                
                <!-- Decorative Line -->
                <div class="mt-8 flex items-center justify-center">
                    <div class="h-px bg-gradient-to-r from-transparent via-white/30 to-transparent w-64"></div>
                    <div class="mx-4 w-2 h-2 bg-white/50 rounded-full"></div>
                    <div class="h-px bg-gradient-to-r from-transparent via-white/30 to-transparent w-64"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="relative py-20 bg-gradient-to-br from-gray-50 to-white overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="stats-grid" width="20" height="20" patternUnits="userSpaceOnUse">
                        <circle cx="10" cy="10" r="1" fill="#14213d"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#stats-grid)"/>
            </svg>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 bg-gradient-to-r from-[#14213d] to-[#1a2a4a] bg-clip-text text-transparent">
                    Statistik Desa
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Data terkini mengenai desa-desa di Kecamatan Waesama</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Total Desa -->
                <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-blue-100/50">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-blue-600 mb-2">11</h3>
                        <p class="text-gray-600 font-medium">Total Desa</p>
                    </div>
                </div>
                
                <!-- Kepala Desa Aktif -->
                <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-green-100/50">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-green-600 mb-2">11</h3>
                        <p class="text-gray-600 font-medium">Kepala Desa Aktif</p>
                    </div>
                </div>
                
                <!-- Kontak Tersedia -->
                <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-yellow-100/50">
                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-yellow-600 mb-2">11</h3>
                        <p class="text-gray-600 font-medium">Kontak Tersedia</p>
                    </div>
                </div>
                
                <!-- Wilayah Kecamatan -->
                <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-purple-100/50">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-purple-600 mb-2">1</h3>
                        <p class="text-gray-600 font-medium">Wilayah Kecamatan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Camat Information -->
    <section class="relative py-20 bg-white overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="camat-grid" width="15" height="15" patternUnits="userSpaceOnUse">
                        <circle cx="7.5" cy="7.5" r="1" fill="#14213d"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#camat-grid)"/>
            </svg>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 bg-gradient-to-r from-[#14213d] to-[#1a2a4a] bg-clip-text text-transparent">
                    Pimpinan Kecamatan
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Informasi kontak pimpinan Kecamatan Waesama</p>
            </div>
            
            <div class="max-w-4xl mx-auto">
                <div class="group relative bg-gradient-to-br from-white to-gray-50/50 rounded-3xl shadow-2xl overflow-hidden border border-gray-100/50 hover:shadow-3xl transition-all duration-500">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50/30 to-indigo-50/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative p-8 md:p-12">
                        <div class="flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-8">
                            <!-- Avatar -->
                            <div class="relative">
                                <div class="w-32 h-32 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center shadow-xl group-hover:scale-105 transition-transform duration-300">
                                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-4 border-white flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Info -->
                            <div class="flex-1 text-center md:text-left">
                                <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Harun Soewakil</h3>
                                <p class="text-xl text-blue-600 font-semibold mb-4">Camat Kecamatan Waesama (Pj)</p>
                                
                                <div class="flex flex-col sm:flex-row items-center justify-center md:justify-start space-y-3 sm:space-y-0 sm:space-x-6">
                                    <div class="flex items-center space-x-3 bg-gray-50 rounded-full px-4 py-2">
                                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                        </div>
                                        <span class="text-gray-700 font-medium">0812 4444 1339</span>
                                    </div>
                                    
                                    <div class="flex items-center space-x-3 bg-blue-50 rounded-full px-4 py-2">
                                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m0 0h2M7 7h10M7 11h10M7 15h10"></path>
                                            </svg>
                                        </div>
                                        <span class="text-gray-700 font-medium">Kecamatan Waesama</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter and Search Section -->
     <section class="relative py-20 bg-white overflow-hidden">
         <!-- Background Pattern -->
         <div class="absolute inset-0 opacity-5">
             <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                 <defs>
                     <pattern id="filter-grid" width="20" height="20" patternUnits="userSpaceOnUse">
                         <circle cx="10" cy="10" r="1" fill="#14213d"/>
                     </pattern>
                 </defs>
                 <rect width="100" height="100" fill="url(#filter-grid)"/>
             </svg>
         </div>
         
         <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
             <div class="text-center mb-12">
                 <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 bg-gradient-to-r from-[#14213d] to-[#1a2a4a] bg-clip-text text-transparent">
                     Pencarian & Filter Desa
                 </h2>
                 <p class="text-gray-600 max-w-2xl mx-auto text-lg">Temukan desa yang Anda cari dengan mudah</p>
             </div>
             
             <!-- Filter Form -->
             <div class="bg-gradient-to-br from-white to-gray-50/50 rounded-3xl shadow-2xl border border-gray-100/50 overflow-hidden">
                 <div class="p-8">
                     <form class="space-y-6">
                         <!-- Search Input -->
                         <div class="relative">
                             <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                 <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                 </svg>
                             </div>
                             <input type="text" name="search" placeholder="Cari nama desa atau kepala desa..." class="block w-full pl-12 pr-4 py-4 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white/80 backdrop-blur-sm text-gray-900 placeholder-gray-500 text-lg transition-all duration-300">
                         </div>
                         
                         <!-- Filter Options -->
                         <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                             <!-- Status Filter -->
                             <div>
                                 <label class="block text-sm font-semibold text-gray-700 mb-3">Status Kepala Desa</label>
                                 <select name="status" class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white/80 backdrop-blur-sm text-gray-900 transition-all duration-300">
                                     <option value="">Semua Status</option>
                                     <option value="defenitif">Defenitif</option>
                                     <option value="pj">Penjabat (Pj)</option>
                                 </select>
                             </div>
                             
                             <!-- Area Filter -->
                             <div>
                                 <label class="block text-sm font-semibold text-gray-700 mb-3">Wilayah</label>
                                 <select name="area" class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white/80 backdrop-blur-sm text-gray-900 transition-all duration-300">
                                     <option value="">Semua Wilayah</option>
                                     <option value="utara">Wilayah Utara</option>
                                     <option value="selatan">Wilayah Selatan</option>
                                     <option value="timur">Wilayah Timur</option>
                                     <option value="barat">Wilayah Barat</option>
                                 </select>
                             </div>
                             
                             <!-- Sort Filter -->
                             <div>
                                 <label class="block text-sm font-semibold text-gray-700 mb-3">Urutkan</label>
                                 <select name="sort" class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white/80 backdrop-blur-sm text-gray-900 transition-all duration-300">
                                     <option value="name_asc">Nama A-Z</option>
                                     <option value="name_desc">Nama Z-A</option>
                                     <option value="newest">Terbaru</option>
                                     <option value="oldest">Terlama</option>
                                 </select>
                             </div>
                         </div>
                         
                         <!-- Action Buttons -->
                         <div class="flex flex-col sm:flex-row gap-4 pt-4">
                             <button type="submit" class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-4 rounded-2xl font-semibold hover:from-blue-700 hover:to-indigo-700 focus:ring-4 focus:ring-blue-200 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                 <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                 </svg>
                                 Cari Desa
                             </button>
                             <button type="reset" class="flex-1 sm:flex-none bg-gray-100 text-gray-700 px-8 py-4 rounded-2xl font-semibold hover:bg-gray-200 focus:ring-4 focus:ring-gray-200 transition-all duration-300 border border-gray-200">
                                 <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                 </svg>
                                 Reset
                             </button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </section>

     <!-- Villages Grid -->
     <section class="relative py-20 bg-gradient-to-br from-gray-50 to-white overflow-hidden">
         <!-- Background Pattern -->
         <div class="absolute inset-0 opacity-5">
             <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                 <defs>
                     <pattern id="villages-list-grid" width="25" height="25" patternUnits="userSpaceOnUse">
                         <circle cx="12.5" cy="12.5" r="1" fill="#14213d"/>
                     </pattern>
                 </defs>
                 <rect width="100" height="100" fill="url(#villages-list-grid)"/>
             </svg>
         </div>
         
         <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
             <div class="text-center mb-16">
                 <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 bg-gradient-to-r from-[#14213d] to-[#1a2a4a] bg-clip-text text-transparent">
                     Daftar Desa
                 </h2>
                 <p class="text-gray-600 max-w-2xl mx-auto text-lg">Klik pada setiap desa untuk melihat informasi detail lengkap</p>
             </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Desa 1: Waetawa -->
                <a href="{{ route('village.detail', 'waetawa') }}" class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-green-100/50">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative">
                        <div class="bg-gradient-to-r from-green-500 to-teal-500 px-6 py-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-xl font-bold text-white mb-1">Desa Waetawa</h3>
                                    <p class="text-green-100 text-sm">Desa No. 1</p>
                                </div>
                                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <div class="flex items-center space-x-3 mb-4">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900 text-lg">Firdaus Souwakil</h4>
                                    <p class="text-sm text-green-600 font-medium">Kepala Desa (Defenitif)</p>
                                </div>
                            </div>
                            
                            <div class="space-y-3">
                                <div class="flex items-center space-x-3 bg-gray-50 rounded-lg px-3 py-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <span class="text-gray-700 text-sm font-medium">0822 3840 4758</span>
                                </div>
                                
                                <div class="flex items-center justify-between pt-2">
                                    <div class="flex items-center text-green-600">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="text-sm font-medium">Detail Lengkap</span>
                                    </div>
                                    <svg class="w-5 h-5 text-green-500 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            <!-- Desa 2: Waesili -->
            <a href="{{ route('village.detail', 'waesili') }}" class="block bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="bg-gradient-to-r from-blue-500 to-cyan-500 px-6 py-4">
                    <h3 class="text-xl font-bold text-white">Desa Waesili</h3>
                    <p class="text-blue-100">Desa No. 2</p>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-blue-100 rounded-full p-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Iswan Jampolo, SST</h4>
                            <p class="text-sm text-blue-600 font-medium">Kepala Desa (Pj)</p>
                        </div>
                    </div>
                    <div class="flex items-center mb-3">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span class="text-gray-700">0822-9947-7810</span>
                    </div>
                    <div class="flex items-center text-blue-600 font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm">Klik untuk detail lengkap</span>
                    </div>
                </div>
            </a>

            <!-- Desa 3: Simi -->
            <a href="{{ route('village.detail', 'simi') }}" class="block bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="bg-gradient-to-r from-purple-500 to-pink-500 px-6 py-4">
                    <h3 class="text-xl font-bold text-white">Desa Simi</h3>
                    <p class="text-purple-100">Desa No. 3</p>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-purple-100 rounded-full p-2">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Muhamad Fakaubun</h4>
                            <p class="text-sm text-purple-600 font-medium">Kepala Desa (Pj)</p>
                        </div>
                    </div>
                    <div class="flex items-center mb-3">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span class="text-gray-700">0853-8417-8613</span>
                    </div>
                    <div class="flex items-center text-purple-600 font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm">Klik untuk detail lengkap</span>
                    </div>
                </div>
            </a>

            <!-- Desa 4: Lena -->
            <a href="{{ route('village.detail', 'lena') }}" class="block bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="bg-gradient-to-r from-yellow-500 to-orange-500 px-6 py-4">
                    <h3 class="text-xl font-bold text-white">Desa Lena</h3>
                    <p class="text-yellow-100">Desa No. 4</p>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-yellow-100 rounded-full p-2">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Anas Takimpo, S.IP</h4>
                            <p class="text-sm text-yellow-600 font-medium">Kepala Desa (Pj)</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span class="text-gray-700">0821-9892-1117</span>
                    </div>
                </div>
            </a>

            <!-- Desa 5: Wamsisi -->
            <a href="{{ route('village.detail', 'wamsisi') }}" class="block bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="bg-gradient-to-r from-red-500 to-pink-500 px-6 py-4">
                    <h3 class="text-xl font-bold text-white">Desa Wamsisi</h3>
                    <p class="text-red-100">Desa No. 5</p>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-red-100 rounded-full p-2">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Bachrudin Yusuf M, S.Tr.IP</h4>
                            <p class="text-sm text-red-600 font-medium">Kepala Desa (Pj)</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span class="text-gray-700">0823-1986-0372</span>
                    </div>
                </div>
            </a>

            <!-- Desa 6: Waelikut -->
            <a href="{{ route('village.detail', 'waelikut') }}" class="block bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="bg-gradient-to-r from-indigo-500 to-purple-500 px-6 py-4">
                    <h3 class="text-xl font-bold text-white">Desa Waelikut</h3>
                    <p class="text-indigo-100">Desa No. 6</p>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-indigo-100 rounded-full p-2">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Agil Bin Yahya</h4>
                            <p class="text-sm text-indigo-600 font-medium">Kepala Desa (Pj)</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span class="text-gray-700">0823-9151-4383</span>
                    </div>
                </div>
            </a>

            <!-- Desa 7: Waeteba -->
            <a href="{{ route('village.detail', 'waeteba') }}" class="block bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="bg-gradient-to-r from-teal-500 to-green-500 px-6 py-4">
                    <h3 class="text-xl font-bold text-white">Desa Waeteba</h3>
                    <p class="text-teal-100">Desa No. 7</p>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-teal-100 rounded-full p-2">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Faeda'Pelu</h4>
                            <p class="text-sm text-teal-600 font-medium">Kepala Desa (Pj)</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span class="text-gray-700">0812-1650-9502</span>
                    </div>
                </div>
            </a>

            <!-- Desa 8: Pohon Batu -->
            <a href="{{ route('village.detail', 'pohon-batu') }}" class="block bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="bg-gradient-to-r from-gray-600 to-gray-700 px-6 py-4">
                    <h3 class="text-xl font-bold text-white">Desa Pohon Batu</h3>
                    <p class="text-gray-200">Desa No. 8</p>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-gray-100 rounded-full p-2">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Suaib Umanailo</h4>
                            <p class="text-sm text-gray-600 font-medium">Kepala Desa (Pj)</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span class="text-gray-700">0812-4771-1397</span>
                    </div>
                    <div class="flex items-center text-gray-600 font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm">Klik untuk detail lengkap</span>
                    </div>
                </div>
            </a>

            <!-- Desa 9: Hotte -->
            <a href="{{ route('village.detail', 'hotte') }}" class="block bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="bg-gradient-to-r from-emerald-500 to-teal-500 px-6 py-4">
                    <h3 class="text-xl font-bold text-white">Desa Hotte</h3>
                    <p class="text-emerald-100">Desa No. 9</p>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-emerald-100 rounded-full p-2">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Abukasim Titawael, S.M</h4>
                            <p class="text-sm text-emerald-600 font-medium">Kepala Desa (Pj)</p>
                        </div>
                    </div>
                    <div class="flex items-center mb-3">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span class="text-gray-700">0852-1685-4491</span>
                    </div>
                    <div class="flex items-center text-emerald-600 font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm">Klik untuk detail lengkap</span>
                    </div>
                </div>
            </a>

            <!-- Desa 10: Waemasing -->
            <a href="{{ route('village.detail', 'waemasing') }}" class="block bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="bg-gradient-to-r from-rose-500 to-pink-500 px-6 py-4">
                    <h3 class="text-xl font-bold text-white">Desa Waemasing</h3>
                    <p class="text-rose-100">Desa No. 10</p>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-rose-100 rounded-full p-2">
                            <svg class="w-6 h-6 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Darusman Booy</h4>
                            <p class="text-sm text-rose-600 font-medium">Kepala Desa (Pj)</p>
                        </div>
                    </div>
                    <div class="flex items-center mb-3">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span class="text-gray-700">0821 9449 6199</span>
                    </div>
                    <div class="flex items-center text-rose-600 font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm">Klik untuk detail lengkap</span>
                    </div>
                </div>
            </a>

            <!-- Desa 11: Batu Kasa -->
            <a href="{{ route('village.detail', 'batu-kasa') }}" class="block bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="bg-gradient-to-r from-amber-500 to-yellow-500 px-6 py-4">
                    <h3 class="text-xl font-bold text-white">Desa Batu Kasa</h3>
                    <p class="text-amber-100">Desa No. 11</p>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-amber-100 rounded-full p-2">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Gani Namkatu</h4>
                            <p class="text-sm text-amber-600 font-medium">Kepala Desa (Pj)</p>
                        </div>
                    </div>
                    <div class="flex items-center mb-3">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span class="text-gray-700">0813-6204-6221</span>
                    </div>
                    <div class="flex items-center text-amber-600 font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm">Klik untuk detail lengkap</span>
                    </div>
                </div>
            </a>

            </div>
        </div>
    </section>

    <!-- Contact Information -->
    <section class="relative py-20 bg-white overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="contact-grid" width="30" height="30" patternUnits="userSpaceOnUse">
                        <circle cx="15" cy="15" r="1" fill="#14213d"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#contact-grid)"/>
            </svg>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 bg-gradient-to-r from-[#14213d] to-[#1a2a4a] bg-clip-text text-transparent">
                    Informasi Kontak
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Keterangan status dan jam pelayanan desa-desa di Kecamatan Waesama</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Keterangan Status -->
                <div class="group relative bg-gradient-to-br from-white to-gray-50/50 rounded-2xl shadow-xl p-8 border border-gray-100/50 hover:shadow-2xl transition-all duration-500">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-50/30 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Keterangan Status</h3>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center p-4 bg-green-50 rounded-xl">
                                <span class="w-4 h-4 bg-green-500 rounded-full mr-4 flex-shrink-0"></span>
                                <div>
                                    <span class="text-gray-900 font-semibold">Defenitif:</span>
                                    <span class="text-gray-700 ml-2">Kepala Desa Tetap</span>
                                </div>
                            </div>
                            <div class="flex items-center p-4 bg-blue-50 rounded-xl">
                                <span class="w-4 h-4 bg-blue-500 rounded-full mr-4 flex-shrink-0"></span>
                                <div>
                                    <span class="text-gray-900 font-semibold">Pj:</span>
                                    <span class="text-gray-700 ml-2">Penjabat Kepala Desa</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Jam Pelayanan -->
                <div class="group relative bg-gradient-to-br from-white to-gray-50/50 rounded-2xl shadow-xl p-8 border border-gray-100/50 hover:shadow-2xl transition-all duration-500">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50/30 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Jam Pelayanan</h3>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center p-4 bg-blue-50 rounded-xl">
                                <svg class="w-5 h-5 text-blue-500 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <span class="text-gray-900 font-semibold">Senin - Jumat:</span>
                                    <span class="text-gray-700 ml-2">08:00 - 16:00 WITA</span>
                                </div>
                            </div>
                            <div class="flex items-center p-4 bg-green-50 rounded-xl">
                                <svg class="w-5 h-5 text-green-500 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <span class="text-gray-900 font-semibold">Sabtu:</span>
                                    <span class="text-gray-700 ml-2">08:00 - 12:00 WITA</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

     <!-- Categories Section -->
     <section class="relative py-20 bg-gradient-to-br from-[#14213d] via-[#1a2a4a] to-[#0f1a2e] text-white overflow-hidden">
         <!-- Background Pattern -->
         <div class="absolute inset-0 opacity-10">
             <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
             <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-300 rounded-full blur-3xl transform translate-x-1/2 translate-y-1/2"></div>
         </div>
         
         <!-- Animated Pattern -->
         <div class="absolute inset-0 opacity-5">
             <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                 <defs>
                     <pattern id="categories-grid" width="15" height="15" patternUnits="userSpaceOnUse">
                         <circle cx="7.5" cy="7.5" r="1" fill="currentColor" class="animate-pulse"/>
                     </pattern>
                 </defs>
                 <rect width="100" height="100" fill="url(#categories-grid)"/>
             </svg>
         </div>
         
         <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
             <div class="text-center mb-16">
                 <h2 class="text-3xl md:text-4xl font-bold mb-4 bg-gradient-to-r from-white to-gray-200 bg-clip-text text-transparent">
                     Kategori Desa
                 </h2>
                 <p class="text-xl text-gray-200 max-w-3xl mx-auto leading-relaxed">
                     Klasifikasi desa berdasarkan karakteristik dan potensi wilayah
                 </p>
             </div>
             
             <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                 <!-- Desa Pesisir -->
                 <div class="group relative bg-white/10 backdrop-blur-sm rounded-2xl p-8 text-center hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 border border-white/20">
                     <div class="absolute inset-0 bg-gradient-to-br from-blue-400/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                     <div class="relative">
                         <div class="w-16 h-16 bg-gradient-to-r from-blue-400 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                             <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path>
                             </svg>
                         </div>
                         <h3 class="text-xl font-bold text-white mb-2">Desa Pesisir</h3>
                         <p class="text-blue-100 text-sm mb-4">Desa dengan akses ke laut</p>
                         <div class="text-2xl font-bold text-blue-300">4</div>
                         <p class="text-blue-200 text-sm">Desa</p>
                     </div>
                 </div>
                 
                 <!-- Desa Pegunungan -->
                 <div class="group relative bg-white/10 backdrop-blur-sm rounded-2xl p-8 text-center hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 border border-white/20">
                     <div class="absolute inset-0 bg-gradient-to-br from-green-400/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                     <div class="relative">
                         <div class="w-16 h-16 bg-gradient-to-r from-green-400 to-green-500 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                             <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                             </svg>
                         </div>
                         <h3 class="text-xl font-bold text-white mb-2">Desa Pegunungan</h3>
                         <p class="text-green-100 text-sm mb-4">Desa di dataran tinggi</p>
                         <div class="text-2xl font-bold text-green-300">3</div>
                         <p class="text-green-200 text-sm">Desa</p>
                     </div>
                 </div>
                 
                 <!-- Desa Pertanian -->
                 <div class="group relative bg-white/10 backdrop-blur-sm rounded-2xl p-8 text-center hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 border border-white/20">
                     <div class="absolute inset-0 bg-gradient-to-br from-yellow-400/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                     <div class="relative">
                         <div class="w-16 h-16 bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                             <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                             </svg>
                         </div>
                         <h3 class="text-xl font-bold text-white mb-2">Desa Pertanian</h3>
                         <p class="text-yellow-100 text-sm mb-4">Desa dengan sektor pertanian</p>
                         <div class="text-2xl font-bold text-yellow-300">7</div>
                         <p class="text-yellow-200 text-sm">Desa</p>
                     </div>
                 </div>
                 
                 <!-- Desa Wisata -->
                 <div class="group relative bg-white/10 backdrop-blur-sm rounded-2xl p-8 text-center hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 border border-white/20">
                     <div class="absolute inset-0 bg-gradient-to-br from-purple-400/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                     <div class="relative">
                         <div class="w-16 h-16 bg-gradient-to-r from-purple-400 to-purple-500 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                             <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                             </svg>
                         </div>
                         <h3 class="text-xl font-bold text-white mb-2">Desa Wisata</h3>
                         <p class="text-purple-100 text-sm mb-4">Desa dengan potensi wisata</p>
                         <div class="text-2xl font-bold text-purple-300">5</div>
                         <p class="text-purple-200 text-sm">Desa</p>
                     </div>
                 </div>
             </div>
             
             <!-- Call to Action -->
             <div class="text-center mt-16">
                 <div class="inline-flex items-center justify-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-8 py-4 border border-white/20">
                     <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                     </svg>
                     <span class="text-white font-medium">Klik pada setiap desa untuk informasi detail lengkap</span>
                 </div>
             </div>
         </div>
     </section>
 
 </x-guest-public-layout>