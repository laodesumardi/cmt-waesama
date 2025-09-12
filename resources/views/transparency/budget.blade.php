<x-guest-public-layout>
    <x-slot name="title">Transparansi Anggaran</x-slot>

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
                    <pattern id="budget-grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <circle cx="5" cy="5" r="1" fill="currentColor" class="animate-pulse"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#budget-grid)"/>
            </svg>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <!-- Icon -->
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white/10 backdrop-blur-sm rounded-2xl mb-8 group">
                    <svg class="w-10 h-10 text-white group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                
                <h1 class="text-4xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-white to-gray-200 bg-clip-text text-transparent">
                    Transparansi Anggaran
                </h1>
                <p class="text-xl md:text-2xl text-gray-200 max-w-3xl mx-auto leading-relaxed">
                    Informasi lengkap mengenai anggaran daerah, realisasi, dan laporan keuangan untuk transparansi pengelolaan keuangan publik
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
                Statistik Anggaran
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto text-lg">Data terkini mengenai anggaran daerah, realisasi, dan laporan keuangan</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Total Anggaran -->
            <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-blue-100/50">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-blue-600 mb-2">{{ $stats['total_budget'] }}</h3>
                    <p class="text-gray-600 font-medium">Total Anggaran</p>
                    <p class="text-sm text-gray-500 mt-1">Tahun {{ date('Y') }}</p>
                </div>
            </div>
            
            <!-- Realisasi -->
            <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-green-100/50">
                <div class="absolute inset-0 bg-gradient-to-br from-green-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-green-600 mb-2">{{ $stats['realized_budget'] }}</h3>
                    <p class="text-gray-600 font-medium">Realisasi</p>
                    <p class="text-sm text-gray-500 mt-1">{{ number_format($stats['realization_percentage'], 1) }}%</p>
                </div>
            </div>
            
            <!-- Sisa Anggaran -->
            <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-orange-100/50">
                <div class="absolute inset-0 bg-gradient-to-br from-orange-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-orange-600 mb-2">{{ $stats['remaining_budget'] }}</h3>
                    <p class="text-gray-600 font-medium">Sisa Anggaran</p>
                    <p class="text-sm text-gray-500 mt-1">{{ number_format(100 - $stats['realization_percentage'], 1) }}%</p>
                </div>
            </div>
            
            <!-- Total Dokumen -->
            <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-purple-100/50">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-purple-600 mb-2">{{ $stats['total_documents'] }}</h3>
                    <p class="text-gray-600 font-medium">Dokumen</p>
                    <p class="text-sm text-gray-500 mt-1">Laporan & APBD</p>
                </div>
            </div>
        </div>
    </div>
</section>

    <div class="container mx-auto px-4 py-8">

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
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Filter Anggaran</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Gunakan filter di bawah untuk mencari data anggaran yang spesifik sesuai kebutuhan Anda</p>
        </div>
        
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200/50 p-8">
            <form method="GET" action="{{ route('transparency.budget') }}">
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
                               placeholder="Cari dokumen anggaran..." 
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
                    
                    <!-- Type Filter -->
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                            <svg class="w-4 h-4 mr-2 text-[#14213d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Tipe Dokumen
                        </label>
                        <select name="type" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#14213d]/20 focus:border-[#14213d] transition-all duration-200 bg-white">
                            <option value="">Semua Tipe</option>
                            <option value="apbd" {{ request('type') == 'apbd' ? 'selected' : '' }}>APBD</option>
                            <option value="realisasi" {{ request('type') == 'realisasi' ? 'selected' : '' }}>Realisasi</option>
                            <option value="laporan" {{ request('type') == 'laporan' ? 'selected' : '' }}>Laporan Keuangan</option>
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
                            <a href="{{ route('transparency.budget') }}" class="px-4 py-3 border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 transition-all duration-200">
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

        <!-- Budget Chart Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Budget Breakdown Chart -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Breakdown Anggaran {{ date('Y') }}</h3>
                <div class="space-y-4">
                    @foreach($budget_breakdown as $item)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $item['color'] }}"></div>
                                <span class="text-sm font-medium text-gray-700">{{ $item['category'] }}</span>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-semibold text-gray-900">{{ $item['amount'] }}</div>
                                <div class="text-xs text-gray-500">{{ $item['percentage'] }}%</div>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="h-2 rounded-full" style="width: {{ $item['percentage'] }}%; background-color: {{ $item['color'] }}"></div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Realization Progress -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Progress Realisasi {{ date('Y') }}</h3>
                <div class="space-y-6">
                    @foreach($realization_progress as $item)
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-gray-700">{{ $item['month'] }}</span>
                                <span class="text-sm text-gray-500">{{ $item['percentage'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-green-600 h-3 rounded-full transition-all duration-300" style="width: {{ $item['percentage'] }}%"></div>
                            </div>
                            <div class="text-xs text-gray-500 mt-1">{{ $item['amount'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Documents List -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Dokumen Anggaran</h2>
                    <div class="text-sm text-gray-600">
                        Menampilkan {{ $budgets->firstItem() ?? 0 }} - {{ $budgets->lastItem() ?? 0 }} dari {{ $budgets->total() }} dokumen
                    </div>
                </div>
            </div>
            
            @if($budgets->count() > 0)
                <div class="divide-y divide-gray-200">
                    @foreach($budgets as $document)
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-2">
                                    <h3 class="font-semibold text-gray-800">{{ $document->title }}</h3>
                                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded">
                                        Anggaran
                                    </span>
                                    <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded">
                                        {{ $document->type_display }}
                                    </span>
                                    @if($document->is_featured)
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded">
                                            <i class="fas fa-star mr-1"></i>Unggulan
                                        </span>
                                    @endif
                                </div>
                                <p class="text-gray-600 mb-3 line-clamp-2">{{ $document->description }}</p>
                                <div class="flex items-center space-x-6 text-sm text-gray-500">
                                    <span><i class="fas fa-calendar mr-1"></i>{{ $document->period_display }}</span>
                                    @if($document->amount)
                                        <span class="font-semibold text-green-600">
                                            <i class="fas fa-money-bill mr-1"></i>{{ $document->formatted_amount }}
                                        </span>
                                    @endif
                                    <span><i class="fas fa-eye mr-1"></i>{{ number_format($document->views) }}</span>
                                    @if($document->files)
                                        <span><i class="fas fa-download mr-1"></i>{{ number_format($document->downloads) }}</span>
                                    @endif
                                    <span><i class="fas fa-clock mr-1"></i>{{ $document->published_at->format('d M Y') }}</span>
                                </div>
                            </div>
                            <div class="flex space-x-2 ml-4">
                                <a href="{{ route('transparency.show', $document) }}" 
                                   class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors text-sm">
                                    <i class="fas fa-eye mr-1"></i>Detail
                                </a>
                                @if($document->files)
                                    <a href="{{ route('transparency.download', $document) }}" 
                                       class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition-colors text-sm">
                                        <i class="fas fa-download mr-1"></i>Download
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="p-6 border-t border-gray-200">
                    {{ $budgets->appends(request()->query())->links() }}
                </div>
            @else
                <div class="p-12 text-center">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada dokumen anggaran ditemukan</h3>
                    <p class="text-gray-500">Coba ubah filter pencarian atau kembali lagi nanti.</p>
                </div>
            @endif
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
</style>