<x-guest-public-layout>
    <x-slot name="title">Tentang Kecamatan</x-slot>

    <!-- Header Section -->
    <section class="relative min-h-[60vh] bg-gradient-to-br from-[#14213d] via-[#1a2a4a] to-[#0f1a2e] text-white overflow-hidden flex items-center">
        <!-- Animated Background Pattern -->
        <div class="absolute inset-0 opacity-20">
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent animate-pulse"></div>
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="80" height="80" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="40" cy="40" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        
        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-white/10 rounded-full blur-xl animate-bounce" style="animation-delay: 0s; animation-duration: 3s;"></div>
        <div class="absolute top-40 right-20 w-16 h-16 bg-white/5 rounded-full blur-lg animate-bounce" style="animation-delay: 1s; animation-duration: 4s;"></div>
        <div class="absolute bottom-32 left-1/4 w-12 h-12 bg-white/10 rounded-full blur-md animate-bounce" style="animation-delay: 2s; animation-duration: 5s;"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <div class="mb-8">
                    <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold mb-6 leading-tight tracking-tight">
                        <span class="block bg-gradient-to-r from-white via-gray-100 to-white bg-clip-text text-transparent">
                            Tentang
                        </span>
                        <span class="block text-yellow-400 mt-4 drop-shadow-lg">
                            Kecamatan
                        </span>
                    </h1>
                    
                    <!-- Decorative Line -->
                    <div class="flex justify-center mt-6 mb-8">
                        <div class="w-24 h-1 bg-gradient-to-r from-transparent via-yellow-400 to-transparent rounded-full"></div>
                    </div>
                </div>
                
                <p class="text-xl sm:text-2xl text-gray-200 max-w-3xl mx-auto leading-relaxed px-4 font-light">
                    Mengenal lebih dekat wilayah dan pelayanan kecamatan kami
                    <span class="block mt-2 text-lg sm:text-xl text-gray-300">
                        Transparansi, profesionalitas, dan pelayanan terbaik untuk masyarakat.
                    </span>
                </p>
            </div>
        </div>
    </section>

    <!-- Village Profile Section -->
    @if($villageInfo)
    <section class="relative py-20 bg-gradient-to-br from-gray-50 via-white to-blue-50 overflow-hidden">
        <!-- Enhanced Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-20 left-10 w-32 h-32 bg-[#14213d]/5 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-40 h-40 bg-blue-400/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-1/4 w-24 h-24 bg-yellow-400/5 rounded-full blur-2xl animate-bounce" style="animation-delay: 2s; animation-duration: 4s;"></div>
            <div class="absolute bottom-1/3 right-1/3 w-20 h-20 bg-[#14213d]/3 rounded-full blur-xl animate-bounce" style="animation-delay: 3s; animation-duration: 5s;"></div>
        </div>
        
        <!-- Floating Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%2314213d" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="1.5"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-8">
                    <div class="bg-white/60 backdrop-blur-sm p-8 rounded-2xl shadow-xl border border-white/50 hover:shadow-2xl hover:bg-white/70 transition-all duration-500">
                        <h2 class="text-3xl font-bold text-[#14213d] mb-6 flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-[#14213d] to-[#1a2a4a] rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            {{ $villageInfo->name }}
                        </h2>
                        <div class="prose prose-lg text-gray-700">
                            <p class="leading-relaxed mb-6 text-gray-600">
                                {{ $villageInfo->description }}
                            </p>
                        
                            @if($villageInfo->vision)
                            <div class="mb-6 p-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border-l-4 border-[#14213d]">
                                <h3 class="text-xl font-semibold text-[#14213d] mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Visi
                                </h3>
                                <p class="text-gray-700 italic font-medium">{{ $villageInfo->vision }}</p>
                            </div>
                            @endif
                            
                            @if($villageInfo->mission)
                            <div class="mb-6 p-6 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border-l-4 border-green-500">
                                <h3 class="text-xl font-semibold text-[#14213d] mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h2m0 0h2m0 0h2a2 2 0 002-2V7a2 2 0 00-2-2h-2m0 0V3a2 2 0 00-2-2H9a2 2 0 00-2 2v2z"></path>
                                    </svg>
                                    Misi
                                </h3>
                                <div class="text-gray-700">
                                    {!! nl2br(e($villageInfo->mission)) !!}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="space-y-8">
                    <!-- Statistics Cards -->
                    <div class="grid grid-cols-2 gap-6">
                        <div class="stat-card group bg-white/70 backdrop-blur-md p-8 rounded-2xl text-center shadow-2xl border border-white/60 hover:shadow-3xl hover:bg-white/85 transition-all duration-500 transform hover:-translate-y-3 hover:scale-110 hover:rotate-1">
                            <div class="w-16 h-16 bg-gradient-to-br from-[#14213d] to-[#1a2a4a] rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                </svg>
                            </div>
                            <h4 class="text-2xl font-bold text-[#14213d] mb-2 group-hover:text-[#0f1a2e] transition-colors duration-300">{{ $villageInfo->area ?? '0' }}</h4>
                            <p class="text-gray-600 group-hover:text-gray-700 transition-colors duration-300">Luas Wilayah (km²)</p>
                        </div>
                        <div class="stat-card group bg-white/70 backdrop-blur-md p-8 rounded-2xl text-center shadow-2xl border border-white/60 hover:shadow-3xl hover:bg-white/85 transition-all duration-500 transform hover:-translate-y-3 hover:scale-110 hover:-rotate-1">
                            <div class="w-16 h-16 bg-gradient-to-br from-[#14213d] to-[#1a2a4a] rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                            <h4 class="text-2xl font-bold text-[#14213d] mb-2 group-hover:text-[#0f1a2e] transition-colors duration-300">{{ number_format($villageInfo->population ?? 0) }}</h4>
                            <p class="text-gray-600 group-hover:text-gray-700 transition-colors duration-300">Jumlah Penduduk</p>
                        </div>
                    </div>
                    
                    <!-- Contact Information -->
                    <div class="bg-white/70 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-white/60 hover:shadow-3xl hover:bg-white/85 transition-all duration-500 transform hover:scale-105">
                        <h4 class="text-xl font-bold text-[#14213d] mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-[#14213d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            Informasi Kontak
                        </h4>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-[#14213d] mt-1 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <p class="font-semibold text-gray-900">Alamat</p>
                                    <p class="text-gray-600">{{ $villageInfo->address }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-[#14213d] mt-1 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <div>
                                    <p class="font-semibold text-gray-900">Telepon</p>
                                    <p class="text-gray-600">{{ $villageInfo->phone }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-[#14213d] mt-1 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <p class="font-semibold text-gray-900">Email</p>
                                    <p class="text-gray-600">{{ $villageInfo->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Organizational Structure -->
    <section class="relative py-20 bg-gradient-to-br from-[#14213d] via-[#1a2a4a] to-[#0f1a2e] overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-full h-full opacity-10">
                <div class="absolute top-20 left-20 w-64 h-64 bg-white rounded-full blur-3xl"></div>
                <div class="absolute bottom-20 right-20 w-80 h-80 bg-blue-300 rounded-full blur-3xl"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
            </div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-white mb-6">
                    <span class="bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent">Struktur Organisasi</span>
                </h2>
                <p class="text-xl text-blue-100">Pejabat dan staff yang melayani masyarakat</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Camat -->
                <div class="org-card group bg-white/10 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-white/20 hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-3 hover:scale-105 text-center">
                    <div class="w-24 h-24 bg-gradient-to-br from-white/20 to-white/10 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 border border-white/30">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 group-hover:text-blue-100 transition-colors duration-300">Camat</h3>
                    <p class="text-blue-200 mb-2 group-hover:text-blue-100 transition-colors duration-300">Drs. Ahmad Suryadi, M.Si</p>
                    <p class="text-sm text-blue-300 group-hover:text-blue-200 transition-colors duration-300">Kepala Kecamatan</p>
                </div>
                
                <!-- Sekretaris Camat -->
                <div class="group bg-white/10 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-white/20 hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-3 hover:scale-105 text-center">
                    <div class="w-24 h-24 bg-gradient-to-br from-white/20 to-white/10 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 border border-white/30">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 group-hover:text-blue-100 transition-colors duration-300">Sekretaris Camat</h3>
                    <p class="text-blue-200 mb-2 group-hover:text-blue-100 transition-colors duration-300">Siti Nurhaliza, S.Sos</p>
                    <p class="text-sm text-blue-300 group-hover:text-blue-200 transition-colors duration-300">Sekretaris Kecamatan</p>
                </div>
                
                <!-- Kepala Seksi Pemerintahan -->
                <div class="group bg-white/10 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-white/20 hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-3 hover:scale-105 text-center">
                    <div class="w-24 h-24 bg-gradient-to-br from-white/20 to-white/10 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 border border-white/30">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 group-hover:text-blue-100 transition-colors duration-300">Kasi Pemerintahan</h3>
                    <p class="text-blue-200 mb-2 group-hover:text-blue-100 transition-colors duration-300">Budi Santoso, S.AP</p>
                    <p class="text-sm text-blue-300 group-hover:text-blue-200 transition-colors duration-300">Kepala Seksi Pemerintahan</p>
                </div>
                
                <!-- Kepala Seksi Pelayanan -->
                <div class="group bg-white/10 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-white/20 hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-3 hover:scale-105 text-center">
                    <div class="w-24 h-24 bg-gradient-to-br from-white/20 to-white/10 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 border border-white/30">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 group-hover:text-blue-100 transition-colors duration-300">Kasi Pelayanan</h3>
                    <p class="text-blue-200 mb-2 group-hover:text-blue-100 transition-colors duration-300">Rina Marlina, S.Kom</p>
                    <p class="text-sm text-blue-300 group-hover:text-blue-200 transition-colors duration-300">Kepala Seksi Pelayanan</p>
                </div>
                
                <!-- Kepala Seksi Pemberdayaan -->
                <div class="group bg-white/10 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-white/20 hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-3 hover:scale-105 text-center">
                    <div class="w-24 h-24 bg-gradient-to-br from-white/20 to-white/10 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 border border-white/30">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 group-hover:text-blue-100 transition-colors duration-300">Kasi Pemberdayaan</h3>
                    <p class="text-blue-200 mb-2 group-hover:text-blue-100 transition-colors duration-300">Agus Priyanto, S.Sos</p>
                    <p class="text-sm text-blue-300 group-hover:text-blue-200 transition-colors duration-300">Kepala Seksi Pemberdayaan</p>
                </div>
                
                <!-- Staff Administrasi -->
                <div class="group bg-white/10 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-white/20 hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-3 hover:scale-105 text-center">
                    <div class="w-24 h-24 bg-gradient-to-br from-white/20 to-white/10 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 border border-white/30">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 group-hover:text-blue-100 transition-colors duration-300">Staff Administrasi</h3>
                    <p class="text-blue-200 mb-2 group-hover:text-blue-100 transition-colors duration-300">Maya Sari, A.Md</p>
                    <p class="text-sm text-blue-300 group-hover:text-blue-200 transition-colors duration-300">Staff Administrasi Umum</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="relative py-20 bg-gradient-to-br from-gray-50 via-white to-blue-50 overflow-hidden">
        <!-- Enhanced Background Elements -->
        <div class="absolute inset-0">
            <div class="parallax-element absolute top-10 right-10 w-40 h-40 bg-[#14213d]/5 rounded-full blur-3xl animate-pulse"></div>
            <div class="parallax-element absolute bottom-10 left-10 w-32 h-32 bg-blue-400/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1.5s;"></div>
            <div class="parallax-element absolute top-1/3 left-1/2 w-28 h-28 bg-yellow-400/5 rounded-full blur-2xl animate-bounce" style="animation-delay: 2s; animation-duration: 6s;"></div>
            <div class="parallax-element absolute bottom-1/4 right-1/4 w-36 h-36 bg-green-400/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 3s;"></div>
        </div>
        
        <!-- Floating Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="80" height="80" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%2314213d" fill-opacity="0.1"%3E%3Cpath d="M40 40l20-20v40z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="bg-white/60 backdrop-blur-sm p-8 rounded-2xl shadow-xl border border-white/50 inline-block">
                    <h2 class="text-4xl font-bold text-[#14213d] mb-4">
                        <span class="bg-gradient-to-r from-[#14213d] to-[#1a2a4a] bg-clip-text text-transparent">Layanan Kecamatan</span>
                    </h2>
                    <p class="text-xl text-gray-600">Berbagai layanan yang tersedia untuk masyarakat</p>
                    
                    <!-- Decorative Line -->
                    <div class="flex justify-center mt-4">
                        <div class="w-24 h-1 bg-gradient-to-r from-transparent via-[#14213d] to-transparent rounded-full"></div>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="service-card group bg-white/70 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-white/60 hover:shadow-3xl hover:bg-white/85 transition-all duration-500 transform hover:-translate-y-3 hover:scale-110 hover:rotate-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#14213d] to-[#1a2a4a] rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#14213d] mb-3 group-hover:text-[#0f1a2e] transition-colors duration-300">Surat Keterangan Domisili</h3>
                    <p class="text-gray-600 group-hover:text-gray-700 transition-colors duration-300">Penerbitan surat keterangan domisili untuk keperluan administrasi</p>
                </div>
                
                <div class="group bg-white/70 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-white/60 hover:shadow-3xl hover:bg-white/85 transition-all duration-500 transform hover:-translate-y-3 hover:scale-110 hover:-rotate-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#14213d] to-[#1a2a4a] rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#14213d] mb-3 group-hover:text-[#0f1a2e] transition-colors duration-300">Surat Keterangan Usaha</h3>
                    <p class="text-gray-600 group-hover:text-gray-700 transition-colors duration-300">Penerbitan surat keterangan usaha untuk pelaku UMKM</p>
                </div>
                
                <div class="group bg-white/70 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-white/60 hover:shadow-3xl hover:bg-white/85 transition-all duration-500 transform hover:-translate-y-3 hover:scale-110 hover:rotate-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#14213d] to-[#1a2a4a] rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#14213d] mb-3 group-hover:text-[#0f1a2e] transition-colors duration-300">Surat Keterangan Tidak Mampu</h3>
                    <p class="text-gray-600 group-hover:text-gray-700 transition-colors duration-300">Penerbitan SKTM untuk keperluan bantuan sosial</p>
                </div>
                
                <div class="group bg-white/70 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-white/60 hover:shadow-3xl hover:bg-white/85 transition-all duration-500 transform hover:-translate-y-3 hover:scale-110 hover:-rotate-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#14213d] mb-3 group-hover:text-[#0f1a2e] transition-colors duration-300">Pelayanan Kependudukan</h3>
                    <p class="text-gray-600 group-hover:text-gray-700 transition-colors duration-300">Bantuan pengurusan dokumen kependudukan</p>
                </div>
                
                <div class="group bg-white/70 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-white/60 hover:shadow-3xl hover:bg-white/85 transition-all duration-500 transform hover:-translate-y-3 hover:scale-110 hover:rotate-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#14213d] mb-3 group-hover:text-[#0f1a2e] transition-colors duration-300">Pengaduan Masyarakat</h3>
                    <p class="text-gray-600 group-hover:text-gray-700 transition-colors duration-300">Penerimaan dan penanganan pengaduan dari masyarakat</p>
                </div>
                
                <div class="group bg-white/70 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-white/60 hover:shadow-3xl hover:bg-white/85 transition-all duration-500 transform hover:-translate-y-3 hover:scale-110 hover:-rotate-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#14213d] mb-3 group-hover:text-[#0f1a2e] transition-colors duration-300">Informasi Publik</h3>
                    <p class="text-gray-600 group-hover:text-gray-700 transition-colors duration-300">Penyediaan informasi publik dan transparansi</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Office Hours -->
    <section class="relative py-20 bg-gradient-to-br from-[#14213d] via-[#1a2a4a] to-[#0f1a2e] overflow-hidden">
        <!-- Enhanced Background Pattern -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-full h-full opacity-10">
                <div class="absolute top-10 right-20 w-48 h-48 bg-white rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute bottom-10 left-20 w-64 h-64 bg-blue-300 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
                <div class="absolute top-1/2 left-1/3 w-32 h-32 bg-yellow-400/20 rounded-full blur-2xl animate-bounce" style="animation-delay: 2s; animation-duration: 8s;"></div>
                <div class="absolute bottom-1/3 left-2/3 w-40 h-40 bg-green-400/15 rounded-full blur-3xl animate-pulse" style="animation-delay: 2.5s;"></div>
            </div>
        </div>
        
        <!-- Floating Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.05\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"4\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-white/20 inline-block">
                    <h2 class="text-4xl font-bold text-white mb-4">
                        <span class="bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent">Jam Pelayanan</span>
                    </h2>
                    <p class="text-xl text-blue-100">Waktu operasional kantor kecamatan</p>
                    
                    <!-- Decorative Line -->
                    <div class="flex justify-center mt-4">
                        <div class="w-24 h-1 bg-gradient-to-r from-transparent via-white to-transparent rounded-full opacity-60"></div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white/10 backdrop-blur-md rounded-2xl shadow-2xl border border-white/30 p-8 hover:bg-white/15 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Hari Kerja
                        </h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-3 border-b border-white/20">
                                <span class="text-blue-200">Senin - Kamis</span>
                                <span class="font-semibold text-white">08:00 - 16:00 WIB</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-white/20">
                                <span class="text-blue-200">Jumat</span>
                                <span class="font-semibold text-white">08:00 - 11:30 WIB</span>
                            </div>
                            <div class="flex justify-between items-center py-3">
                                <span class="text-blue-200">Sabtu - Minggu</span>
                                <span class="font-semibold text-red-400">Tutup</span>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                            </svg>
                            Jam Istirahat
                        </h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-3 border-b border-white/20">
                                <span class="text-blue-200">Senin - Kamis</span>
                                <span class="font-semibold text-white">12:00 - 13:00 WIB</span>
                            </div>
                            <div class="flex justify-between items-center py-3">
                                <span class="text-blue-200">Jumat</span>
                                <span class="font-semibold text-white">11:30 - 13:00 WIB</span>
                            </div>
                        </div>
                        
                        <div class="mt-6 p-4 bg-white/10 backdrop-blur-sm rounded-xl border border-white/20">
                            <p class="text-sm text-blue-100">
                                <strong class="text-white">Catatan:</strong> Untuk pelayanan darurat atau mendesak, silakan hubungi nomor telepon yang tersedia.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // Stagger animation for cards on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Animate statistics cards
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease-out';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 150);
            });
            
            // Animate organizational structure cards
            const orgCards = document.querySelectorAll('.org-card');
            orgCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease-out';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 800 + (index * 100));
            });
            
            // Animate service cards
            const serviceCards = document.querySelectorAll('.service-card');
            serviceCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease-out';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 1400 + (index * 120));
            });
            
            // Parallax effect for floating elements
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const parallaxElements = document.querySelectorAll('.parallax-element');
                
                parallaxElements.forEach((element, index) => {
                    const speed = 0.5 + (index * 0.1);
                    const yPos = -(scrolled * speed);
                    element.style.transform = `translateY(${yPos}px)`;
                });
            });
        });
    </script>
</x-guest-public-layout>