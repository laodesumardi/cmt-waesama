<x-guest-public-layout>
    <x-slot name="title">Transparansi Laporan</x-slot>

    <!-- Header Section -->
    <section class="relative bg-gradient-to-br from-orange-600 via-orange-700 to-orange-800 text-white py-20 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="currentColor" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#grid)"/>
            </svg>
        </div>
        
        <!-- Animated Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="animate-pulse">
                <svg class="w-full h-full" viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="100" cy="100" r="50" fill="currentColor" opacity="0.3"/>
                    <circle cx="300" cy="150" r="30" fill="currentColor" opacity="0.2"/>
                    <circle cx="200" cy="300" r="40" fill="currentColor" opacity="0.4"/>
                    <circle cx="350" cy="300" r="25" fill="currentColor" opacity="0.3"/>
                </svg>
            </div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="flex items-center justify-center mb-6">
                <div class="bg-white/20 p-4 rounded-full">
                    <i class="fas fa-chart-line text-4xl"></i>
                </div>
            </div>
            <h1 class="text-5xl font-bold text-center mb-6">
                <span class="bg-gradient-to-r from-white to-orange-100 bg-clip-text text-transparent">
                    Laporan dan Evaluasi
                </span>
            </h1>
            <p class="text-xl text-center text-orange-100 max-w-3xl mx-auto leading-relaxed">
                Akses laporan kinerja, evaluasi program, dan pertanggungjawaban penyelenggaraan pemerintahan untuk transparansi dan akuntabilitas.
            </p>
            
            <!-- Decorative Line -->
            <div class="flex justify-center mt-8">
                <div class="w-24 h-1 bg-gradient-to-r from-transparent via-white to-transparent rounded-full"></div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-16 bg-gray-50 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse">
                        <circle cx="10" cy="10" r="1" fill="currentColor"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#dots)"/>
            </svg>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Statistik Laporan</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Ringkasan data laporan dan evaluasi yang telah dipublikasikan</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Laporan -->
                <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                    <div class="bg-gradient-to-br from-orange-500 to-orange-600 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-file-alt text-white text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ $stats['total_reports'] ?? 0 }}</h3>
                    <p class="text-gray-600">Total Laporan</p>
                </div>

                <!-- Laporan Tahun Ini -->
                <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                    <div class="bg-gradient-to-br from-green-500 to-green-600 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-calendar-check text-white text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ $stats['this_year_reports'] ?? 0 }}</h3>
                    <p class="text-gray-600">Laporan {{ date('Y') }}</p>
                </div>

                <!-- Laporan Terbaru -->
                <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-clock text-white text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ $stats['recent_reports'] ?? 0 }}</h3>
                    <p class="text-gray-600">Terbaru (30 hari)</p>
                </div>

                <!-- Total Unduhan -->
                <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-download text-white text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ number_format($stats['total_downloads'] ?? 0) }}</h3>
                    <p class="text-gray-600">Total Unduhan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter and Search Section -->
    <section class="py-8 bg-white border-b border-gray-200">
        <div class="container mx-auto px-4">
            <form method="GET" action="{{ route('transparency.reports') }}" class="bg-gray-50 rounded-xl p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}" 
                               placeholder="Cari laporan..." 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                        <select id="year" name="year" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="">Semua Tahun</option>
                            @for($i = date('Y'); $i >= 2015; $i--)
                                <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Jenis Laporan</label>
                        <select id="type" name="type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="">Semua Jenis</option>
                            <option value="kinerja" {{ request('type') == 'kinerja' ? 'selected' : '' }}>Laporan Kinerja</option>
                            <option value="keuangan" {{ request('type') == 'keuangan' ? 'selected' : '' }}>Laporan Keuangan</option>
                            <option value="tahunan" {{ request('type') == 'tahunan' ? 'selected' : '' }}>Laporan Tahunan</option>
                            <option value="evaluasi" {{ request('type') == 'evaluasi' ? 'selected' : '' }}>Evaluasi Program</option>
                            <option value="audit" {{ request('type') == 'audit' ? 'selected' : '' }}>Hasil Audit</option>
                            <option value="monitoring" {{ request('type') == 'monitoring' ? 'selected' : '' }}>Monitoring</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="period" class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                        <select id="period" name="period" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="">Semua Periode</option>
                            <option value="triwulan" {{ request('period') == 'triwulan' ? 'selected' : '' }}>Triwulan</option>
                            <option value="semester" {{ request('period') == 'semester' ? 'selected' : '' }}>Semester</option>
                            <option value="tahunan" {{ request('period') == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                        </select>
                    </div>
                    
                    <div class="flex items-end">
                        <div class="flex gap-2 w-full">
                            <button type="submit" class="flex-1 bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition-colors duration-200 flex items-center justify-center">
                                <i class="fas fa-search mr-2"></i> Cari
                            </button>
                            <a href="{{ route('transparency.reports') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-200 flex items-center justify-center">
                                <i class="fas fa-redo"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Reports List Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            @if($reports->count() > 0)
                <div class="space-y-6">
                    @foreach($reports as $report)
                        <div class="bg-white rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 overflow-hidden">
                            <div class="p-6">
                                <div class="flex flex-col lg:flex-row lg:items-center justify-between">
                                    <div class="flex-1 lg:pr-6">
                                        <div class="flex items-start justify-between mb-3">
                                            <h3 class="text-xl font-bold text-gray-800 hover:text-orange-600 transition-colors duration-200">
                                                <a href="{{ route('transparency.show', $report) }}" class="text-decoration-none">
                                                    {{ $report->title }}
                                                </a>
                                            </h3>
                                        </div>
                                        
                                        <div class="flex flex-wrap gap-2 mb-3">
                                            @if($report->data)
                                                @php
                                                    $data = json_decode($report->data, true);
                                                    $type = $data['report_type'] ?? 'laporan';
                                                    $period = $data['period'] ?? '';
                                                    $status = $data['status'] ?? 'published';
                                                    
                                                    $typeColors = [
                                                        'kinerja' => 'bg-blue-100 text-blue-800',
                                                        'keuangan' => 'bg-green-100 text-green-800',
                                                        'tahunan' => 'bg-yellow-100 text-yellow-800',
                                                        'evaluasi' => 'bg-purple-100 text-purple-800',
                                                        'audit' => 'bg-red-100 text-red-800',
                                                        'monitoring' => 'bg-gray-100 text-gray-800'
                                                    ];
                                                    
                                                    $statusColors = [
                                                        'published' => 'bg-green-100 text-green-800',
                                                        'draft' => 'bg-yellow-100 text-yellow-800',
                                                        'review' => 'bg-blue-100 text-blue-800'
                                                    ];
                                                @endphp
                                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $typeColors[$type] ?? 'bg-gray-100 text-gray-800' }}">
                                                    {{ ucfirst($type) }}
                                                </span>
                                                @if($period)
                                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        {{ ucfirst($period) }}
                                                    </span>
                                                @endif
                                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusColors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                                    {{ ucfirst($status) }}
                                                </span>
                                            @endif
                                            @if($report->is_featured)
                                                <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    <i class="fas fa-star mr-1"></i> Unggulan
                                                </span>
                                            @endif
                                        </div>
                                        
                                        @if($report->description)
                                            <p class="text-gray-600 mb-3">{{ Str::limit($report->description, 150) }}</p>
                                        @endif
                                        
                                        @if($report->data)
                                            @php $data = json_decode($report->data, true); @endphp
                                            @if(isset($data['summary']))
                                                <div class="mb-3">
                                                    <span class="font-medium text-gray-700">Ringkasan:</span>
                                                    <p class="text-gray-600">{{ Str::limit($data['summary'], 100) }}</p>
                                                </div>
                                            @endif
                                            @if(isset($data['department']))
                                                <p class="text-gray-600 mb-3"><span class="font-medium">Unit Kerja:</span> {{ $data['department'] }}</p>
                                            @endif
                                        @endif
                                    </div>
                                    
                                    <div class="lg:w-64 lg:text-right mt-4 lg:mt-0">
                                        @if($report->period_start && $report->period_end)
                                            <div class="mb-3">
                                                <span class="font-medium text-gray-700">Periode:</span><br>
                                                <span class="text-gray-600">{{ $report->period_start->format('M Y') }} - {{ $report->period_end->format('M Y') }}</span>
                                            </div>
                                        @elseif($report->period_start)
                                            <div class="mb-3">
                                                <span class="font-medium text-gray-700">Periode:</span><br>
                                                <span class="text-gray-600">{{ $report->period_start->format('F Y') }}</span>
                                            </div>
                                        @endif
                                        
                                        @if($report->amount)
                                            <div class="mb-3">
                                                <span class="font-medium text-gray-700">Nilai:</span><br>
                                                <span class="text-green-600 font-bold">Rp {{ number_format($report->amount, 0, ',', '.') }}</span>
                                            </div>
                                        @endif
                                        
                                        <div class="flex lg:flex-col gap-2">
                                            <a href="{{ route('transparency.show', $report) }}" 
                                               class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition-colors duration-200 text-center flex items-center justify-center">
                                                <i class="fas fa-eye mr-2"></i> Detail
                                            </a>
                                            @if($report->files)
                                                @php $files = json_decode($report->files, true) ?? []; @endphp
                                                @if(count($files) > 0)
                                                    <a href="{{ route('transparency.download', ['transparency' => $report, 'file' => basename($files[0]['path'])]) }}" 
                                                       class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-200 text-center flex items-center justify-center">
                                                        <i class="fas fa-download mr-2"></i> Download
                                                    </a>
                                                @endif
                                            @endif
                                        </div>
                                        
                                        <div class="text-sm text-gray-500 mt-3">
                                            <div class="flex items-center justify-center lg:justify-end gap-4">
                                                <span><i class="fas fa-eye mr-1"></i> {{ number_format($report->views) }}</span>
                                                <span><i class="fas fa-download mr-1"></i> {{ number_format($report->downloads) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($reports->hasPages())
                    <div class="flex justify-center mt-12">
                        {{ $reports->appends(request()->query())->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-16">
                    <div class="mb-6">
                        <i class="fas fa-search text-6xl text-gray-300"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-600 mb-4">Tidak ada laporan</h3>
                    <p class="text-gray-500 mb-6">
                        @if(request()->hasAny(['search', 'year', 'type', 'period']))
                            Tidak ditemukan laporan yang sesuai dengan kriteria pencarian.
                        @else
                            Belum ada laporan yang dipublikasikan.
                        @endif
                    </p>
                    @if(request()->hasAny(['search', 'year', 'type', 'period']))
                        <a href="{{ route('transparency.reports') }}" class="bg-orange-600 text-white px-6 py-3 rounded-lg hover:bg-orange-700 transition-colors duration-200 inline-flex items-center">
                            <i class="fas fa-redo mr-2"></i> Reset Filter
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </section>

    <!-- Quick Links Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Transparansi Lainnya</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Jelajahi informasi transparansi lainnya untuk mendapatkan gambaran lengkap</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-chart-pie text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Anggaran</h3>
                    <p class="text-gray-600 mb-6">Lihat transparansi anggaran dan realisasi keuangan daerah.</p>
                    <a href="{{ route('transparency.budget') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors duration-200 inline-flex items-center">
                        Lihat Anggaran
                    </a>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="bg-gradient-to-br from-green-500 to-green-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-shopping-cart text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Pengadaan</h3>
                    <p class="text-gray-600 mb-6">Pantau proses pengadaan barang dan jasa pemerintah.</p>
                    <a href="{{ route('transparency.procurement') }}" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors duration-200 inline-flex items-center">
                        Lihat Pengadaan
                    </a>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-balance-scale text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Regulasi</h3>
                    <p class="text-gray-600 mb-6">Akses peraturan dan kebijakan yang berlaku di daerah.</p>
                    <a href="{{ route('transparency.regulations') }}" class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition-colors duration-200 inline-flex items-center">
                        Lihat Regulasi
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-guest-public-layout>

@push('styles')
<style>
.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: .5;
    }
}

.bg-clip-text {
    -webkit-background-clip: text;
    background-clip: text;
}

.text-transparent {
    color: transparent;
}
</style>
@endpush