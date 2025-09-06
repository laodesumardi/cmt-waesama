<x-guest-public-layout>
    <x-slot name="title">Transparansi Pengadaan</x-slot>

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
                    <pattern id="procurement-grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <circle cx="5" cy="5" r="1" fill="currentColor" class="animate-pulse"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#procurement-grid)"/>
            </svg>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <!-- Icon -->
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white/10 backdrop-blur-sm rounded-2xl mb-8 group">
                    <svg class="w-10 h-10 text-white group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                
                <h1 class="text-4xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-white to-gray-200 bg-clip-text text-transparent">
                    Transparansi Pengadaan
                </h1>
                <p class="text-xl md:text-2xl text-gray-200 max-w-3xl mx-auto leading-relaxed">
                    Informasi lengkap mengenai proses pengadaan barang dan jasa untuk mewujudkan transparansi dan akuntabilitas
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
                Statistik Pengadaan
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto text-lg">Data terkini mengenai proses pengadaan barang dan jasa di wilayah kami</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Total Pengadaan -->
            <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-blue-100/50">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-blue-600 mb-2">{{ $stats['total_procurements'] ?? 0 }}</h3>
                    <p class="text-gray-600 font-medium">Total Pengadaan</p>
                </div>
            </div>
            
            <!-- Selesai -->
            <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-green-100/50">
                <div class="absolute inset-0 bg-gradient-to-br from-green-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-green-600 mb-2">{{ $stats['completed_procurements'] ?? 0 }}</h3>
                    <p class="text-gray-600 font-medium">Selesai</p>
                </div>
            </div>
            
            <!-- Sedang Berjalan -->
            <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-yellow-100/50">
                <div class="absolute inset-0 bg-gradient-to-br from-yellow-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-yellow-600 mb-2">{{ $stats['ongoing_procurements'] ?? 0 }}</h3>
                    <p class="text-gray-600 font-medium">Sedang Berjalan</p>
                </div>
            </div>
            
            <!-- Total Nilai -->
            <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-purple-100/50">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-purple-600 mb-2">Rp {{ number_format($stats['total_value'] ?? 0, 0, ',', '.') }}</h3>
                    <p class="text-gray-600 font-medium">Total Nilai</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filter and Search -->
<section class="relative py-16 bg-gradient-to-br from-gray-50 to-white overflow-hidden">
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
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Filter Pengadaan</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Gunakan filter di bawah untuk mencari data pengadaan yang spesifik sesuai kebutuhan Anda</p>
        </div>
        
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200/50 p-8">
            <form method="GET" action="{{ route('transparency.procurement') }}">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                    <!-- Search Input -->
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                            <svg class="w-4 h-4 mr-2 text-[#14213d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Pencarian
                        </label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Cari nama pengadaan..." 
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
                    
                    <!-- Status Filter -->
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                            <svg class="w-4 h-4 mr-2 text-[#14213d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Status
                        </label>
                        <select name="status" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#14213d]/20 focus:border-[#14213d] transition-all duration-200 bg-white">
                            <option value="">Semua Status</option>
                            <option value="planning" {{ request('status') == 'planning' ? 'selected' : '' }}>Perencanaan</option>
                            <option value="tender" {{ request('status') == 'tender' ? 'selected' : '' }}>Tender</option>
                            <option value="contract" {{ request('status') == 'contract' ? 'selected' : '' }}>Kontrak</option>
                            <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Pelaksanaan</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    
                    <!-- Sort Filter -->
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                            <svg class="w-4 h-4 mr-2 text-[#14213d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                            </svg>
                            Urutkan
                        </label>
                        <select name="sort" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#14213d]/20 focus:border-[#14213d] transition-all duration-200 bg-white">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="value_high" {{ request('sort') == 'value_high' ? 'selected' : '' }}>Nilai Tertinggi</option>
                            <option value="value_low" {{ request('sort') == 'value_low' ? 'selected' : '' }}>Nilai Terendah</option>
                        </select>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-transparent mb-2">Action</label>
                        <div class="flex gap-2">
                            <button type="submit" class="flex-1 bg-gradient-to-r from-[#14213d] to-[#1a2a4a] text-white px-6 py-3 rounded-xl hover:from-[#1a2a4a] hover:to-[#14213d] transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Cari
                            </button>
                            <a href="{{ route('transparency.procurement') }}" class="px-4 py-3 border border-gray-200 rounded-xl hover:bg-gray-50 transition-all duration-200 text-gray-600 hover:text-gray-800" title="Reset Filter">
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

<!-- Procurement Grid -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Daftar Pengadaan</h2>
                <p class="text-gray-600">Menampilkan {{ $procurements->count() }} dari {{ $procurements->total() }} data pengadaan</p>
            </div>
            <div class="flex gap-2 mt-4 sm:mt-0">
                <button class="filter-btn active bg-gradient-to-r from-[#14213d] to-[#1a2a4a] text-white px-4 py-2 rounded-lg transition-all duration-300" data-filter="all">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    Semua
                </button>
                <button class="filter-btn bg-white/70 text-[#14213d] border border-gray-200/50 px-4 py-2 rounded-lg transition-all duration-300" data-filter="planning">
                    Perencanaan
                </button>
                <button class="filter-btn bg-white/70 text-[#14213d] border border-gray-200/50 px-4 py-2 rounded-lg transition-all duration-300" data-filter="tender">
                    Tender
                </button>
                <button class="filter-btn bg-white/70 text-[#14213d] border border-gray-200/50 px-4 py-2 rounded-lg transition-all duration-300" data-filter="completed">
                    Selesai
                </button>
            </div>
        </div>
        
        @if($procurements->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($procurements as $procurement)
                    <div class="procurement-item group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100 overflow-hidden" data-category="{{ $procurement->status }}">
                        <!-- Status Badge -->
                        <div class="absolute top-4 right-4 z-10">
                            @if($procurement->data)
                                @php
                                    $data = json_decode($procurement->data, true);
                                    $status = $data['status'] ?? 'planning';
                                    $statusLabels = [
                                        'planning' => 'Perencanaan',
                                        'tender' => 'Tender',
                                        'contract' => 'Kontrak',
                                        'ongoing' => 'Pelaksanaan',
                                        'completed' => 'Selesai'
                                    ];
                                @endphp
                                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                    @if($status == 'completed') bg-green-100 text-green-800
                                    @elseif($status == 'planning') bg-blue-100 text-blue-800
                                    @elseif($status == 'tender') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $statusLabels[$status] ?? ucfirst($status) }}
                                </span>
                            @endif
                        </div>
                        
                        <!-- Card Content -->
                        <div class="p-6">
                            <!-- Header -->
                            <div class="mb-4">
                                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#14213d] transition-colors duration-300">
                                    {{ $procurement->title }}
                                </h3>
                                <p class="text-gray-600 text-sm flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    Kecamatan
                                </p>
                            </div>
                            
                            <!-- Info Grid -->
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                @if($procurement->period_start)
                                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                                        <div class="text-2xl font-bold text-[#14213d]">{{ $procurement->period_start->format('Y') }}</div>
                                        <div class="text-xs text-gray-600 mt-1">Tahun</div>
                                    </div>
                                @endif
                                @if($procurement->amount)
                                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                                        <div class="text-lg font-bold text-green-600">{{ number_format($procurement->amount / 1000000, 1) }}M</div>
                                        <div class="text-xs text-gray-600 mt-1">Budget (Rp)</div>
                                    </div>
                                @endif
                            </div>
                            
                            @if($procurement->description)
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ Str::limit($procurement->description, 100) }}</p>
                            @endif
                            
                            <!-- Progress Bar -->
                            @if($procurement->data)
                                @php
                                    $data = json_decode($procurement->data, true);
                                @endphp
                                @if(isset($data['progress']))
                                    <div class="mb-4">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-sm font-medium text-gray-700">Progress</span>
                                            <span class="text-sm font-bold text-[#14213d]">{{ $data['progress'] }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-gradient-to-r from-[#14213d] to-[#1a2a4a] h-2 rounded-full transition-all duration-500" 
                                                 style="width: {{ $data['progress'] }}%"></div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                            
                            <!-- Footer -->
                            <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                <span class="text-sm text-gray-500 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $procurement->created_at->format('d M Y') }}
                                </span>
                                <a href="{{ route('transparency.show', $procurement) }}" class="bg-gradient-to-r from-[#14213d] to-[#1a2a4a] text-white px-4 py-2 rounded-lg hover:from-[#1a2a4a] hover:to-[#14213d] transition-all duration-300 transform hover:scale-105 text-sm font-medium">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Detail
                                </a>
                            </div>
                        </div>
                        
                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-[#14213d]/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($procurements->hasPages())
                <div class="flex justify-center mt-12">
                    {{ $procurements->appends(request()->query())->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-16">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Tidak Ada Data Pengadaan</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">
                    @if(request()->hasAny(['search', 'year', 'status']))
                        Tidak ditemukan data pengadaan yang sesuai dengan kriteria pencarian.
                    @else
                        Belum ada data pengadaan yang dipublikasikan.
                    @endif
                </p>
                @if(request()->hasAny(['search', 'year', 'status']))
                    <a href="{{ route('transparency.procurement') }}" class="inline-flex items-center bg-gradient-to-r from-[#14213d] to-[#1a2a4a] text-white px-6 py-3 rounded-lg hover:from-[#1a2a4a] hover:to-[#14213d] transition-all duration-300 transform hover:scale-105">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Reset Filter
                    </a>
                @endif
            </div>
        @endif
    </div>
</section>

<!-- Quick Links -->
<section class="relative py-20 bg-gradient-to-br from-[#14213d] to-[#1a2a4a] overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <defs>
                <pattern id="quick-links-grid" width="20" height="20" patternUnits="userSpaceOnUse">
                    <circle cx="10" cy="10" r="1" fill="white"/>
                </pattern>
            </defs>
            <rect width="100" height="100" fill="url(#quick-links-grid)"/>
        </svg>
    </div>
    
    <!-- Animated Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-10 left-10 w-32 h-32 bg-white/10 rounded-full animate-pulse"></div>
        <div class="absolute top-32 right-20 w-24 h-24 bg-white/5 rounded-full animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-20 left-1/4 w-40 h-40 bg-white/5 rounded-full animate-pulse" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-32 right-1/3 w-28 h-28 bg-white/10 rounded-full animate-pulse" style="animation-delay: 0.5s;"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white/10 rounded-full mb-6">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                </svg>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Akses Cepat
            </h2>
            <p class="text-gray-300 max-w-2xl mx-auto text-lg">Jelajahi informasi transparansi lainnya dengan mudah</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Anggaran -->
            <a href="{{ route('transparency.budget') }}" class="group relative bg-white/10 backdrop-blur-sm rounded-2xl shadow-xl p-8 text-center hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 border border-white/20">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-400 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4 group-hover:text-blue-200 transition-colors">Anggaran</h3>
                    <p class="text-gray-300 mb-6 leading-relaxed">Lihat informasi anggaran dan realisasi keuangan daerah secara transparan</p>
                    <div class="inline-flex items-center text-blue-200 font-medium group-hover:text-white transition-colors">
                        <span>Lihat Anggaran</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </a>
            
            <!-- Proyek -->
            <a href="{{ route('transparency.projects') }}" class="group relative bg-white/10 backdrop-blur-sm rounded-2xl shadow-xl p-8 text-center hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 border border-white/20">
                <div class="absolute inset-0 bg-gradient-to-br from-green-500/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-400 to-green-500 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4 group-hover:text-green-200 transition-colors">Proyek</h3>
                    <p class="text-gray-300 mb-6 leading-relaxed">Pantau progress proyek pembangunan dan infrastruktur di wilayah kami</p>
                    <div class="inline-flex items-center text-green-200 font-medium group-hover:text-white transition-colors">
                        <span>Lihat Proyek</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </a>
            
            <!-- Regulasi -->
            <a href="{{ route('transparency.regulations') }}" class="group relative bg-white/10 backdrop-blur-sm rounded-2xl shadow-xl p-8 text-center hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 border border-white/20">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-500/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-400 to-purple-500 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4 group-hover:text-purple-200 transition-colors">Regulasi</h3>
                    <p class="text-gray-300 mb-6 leading-relaxed">Akses peraturan dan kebijakan yang berlaku di daerah</p>
                    <div class="inline-flex items-center text-purple-200 font-medium group-hover:text-white transition-colors">
                        <span>Lihat Regulasi</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>
</x-guest-public-layout>

@push('styles')
<style>
/* Card Animations */
.card {
    transition: all 0.3s ease-in-out;
    border-radius: 12px;
    overflow: hidden;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
}

/* Progress Bar Styling */
.progress {
    background-color: #e9ecef;
    border-radius: 10px;
    height: 8px;
}

.progress-bar {
    border-radius: 10px;
    background: linear-gradient(45deg, #007bff, #0056b3);
}

/* Badge Improvements */
.badge {
    font-size: 0.75rem;
    padding: 0.5em 0.75em;
    border-radius: 8px;
    font-weight: 600;
}

/* Button Styling */
.btn-sm {
    font-size: 0.8rem;
    border-radius: 8px;
    padding: 0.375rem 0.75rem;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-1px);
}

/* Form Controls */
.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #dee2e6;
    transition: all 0.2s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

/* Statistics Cards */
.stats-card {
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    border-radius: 15px;
    padding: 1.5rem;
    text-align: center;
    transition: all 0.3s ease;
}

.stats-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.stats-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 1.5rem;
}

.stats-icon.primary {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
}

.stats-icon.success {
    background: linear-gradient(135deg, #28a745, #1e7e34);
    color: white;
}

.stats-icon.warning {
    background: linear-gradient(135deg, #ffc107, #e0a800);
    color: white;
}

.stats-icon.info {
    background: linear-gradient(135deg, #17a2b8, #138496);
    color: white;
}

/* Procurement Card Styling */
.procurement-card {
    border-radius: 15px;
    border: none;
    background: white;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.procurement-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #007bff, #28a745);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.procurement-card:hover::before {
    opacity: 1;
}

.procurement-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

/* Filter Section */
.filter-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
}

/* Empty State */
.empty-state {
    padding: 4rem 2rem;
    text-align: center;
}

.empty-state i {
    opacity: 0.3;
    margin-bottom: 1.5rem;
}

/* Quick Links */
.quick-link-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.quick-link-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    border-color: #14213d;
}

.quick-link-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    font-size: 24px;
    color: white;
}

.quick-link-icon.budget {
    background: linear-gradient(45deg, #667eea, #764ba2);
}

.quick-link-icon.projects {
    background: linear-gradient(45deg, #f093fb, #f5576c);
}

.quick-link-icon.regulations {
    background: linear-gradient(45deg, #4facfe, #00f2fe);
}

.quick-link-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #14213d;
    margin-bottom: 10px;
}

.quick-link-description {
    color: #6c757d;
    margin-bottom: 20px;
    font-size: 0.9rem;
}

.quick-link-btn {
    display: inline-flex;
    align-items: center;
    background: linear-gradient(45deg, #14213d, #1a2a4a);
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.quick-link-btn:hover {
    background: linear-gradient(45deg, #1a2a4a, #14213d);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(20, 33, 61, 0.4);
    color: white;
    text-decoration: none;
}

.quick-link-btn i {
    margin-left: 8px;
    transition: transform 0.3s ease;
}

.quick-link-btn:hover i {
    transform: translateX(3px);
}

/* Responsive Improvements */
@media (max-width: 768px) {
    .card {
        margin-bottom: 1rem;
    }
    
    .filter-section {
        padding: 1rem;
    }
    
    .stats-card {
        padding: 1rem;
    }
    
    .quick-link-card {
        padding: 20px;
    }
}

/* Animation for page load */
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

.fade-in-up {
    animation: fadeInUp 0.6s ease-out;
}

/* Staggered animation for cards */
.procurement-card:nth-child(1) { animation-delay: 0.1s; }
.procurement-card:nth-child(2) { animation-delay: 0.2s; }
.procurement-card:nth-child(3) { animation-delay: 0.3s; }
.procurement-card:nth-child(4) { animation-delay: 0.4s; }
</style>
@endpush

@push('scripts')
<script>
// Filter functionality with animations
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const procurementItems = document.querySelectorAll('.procurement-item');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button with modern styling
            filterBtns.forEach(b => {
                b.classList.remove('active');
                b.classList.remove('bg-gradient-to-r', 'from-[#14213d]', 'to-[#1a2a4a]', 'text-white');
                b.classList.add('bg-white/70', 'text-[#14213d]', 'border', 'border-gray-200/50');
            });
            
            this.classList.add('active');
            this.classList.add('bg-gradient-to-r', 'from-[#14213d]', 'to-[#1a2a4a]', 'text-white');
            this.classList.remove('bg-white/70', 'text-[#14213d]', 'border', 'border-gray-200/50');
            
            // Filter items with fade animation
            procurementItems.forEach(item => {
                if (filter === 'all' || item.getAttribute('data-category') === filter) {
                    item.style.display = 'block';
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(20px)';
                    
                    setTimeout(() => {
                        item.style.transition = 'all 0.5s ease';
                        item.style.opacity = '1';
                        item.style.transform = 'translateY(0)';
                    }, 100);
                } else {
                    item.style.transition = 'all 0.3s ease';
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(-20px)';
                    
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 300);
                }
            });
        });
    });
    
    // Add stagger animation on page load
    procurementItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            item.style.transition = 'all 0.6s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>
@endpush