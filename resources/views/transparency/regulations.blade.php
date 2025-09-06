<x-guest-public-layout>
    <x-slot name="title">Regulasi dan Peraturan</x-slot>

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
                    <pattern id="regulations-grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <circle cx="5" cy="5" r="1" fill="currentColor" class="animate-pulse"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#regulations-grid)"/>
            </svg>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <!-- Icon -->
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white/10 backdrop-blur-sm rounded-2xl mb-8 group">
                    <svg class="w-10 h-10 text-white group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16l3-1m-3 1l-3-1"></path>
                    </svg>
                </div>
                
                <h1 class="text-4xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-white to-gray-200 bg-clip-text text-transparent">
                    Regulasi dan Peraturan
                </h1>
                <p class="text-xl md:text-2xl text-gray-200 max-w-3xl mx-auto leading-relaxed">
                    Akses lengkap terhadap peraturan, kebijakan, dan regulasi yang berlaku di wilayah Kecamatan untuk transparansi hukum dan tata kelola
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
                Statistik Regulasi
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto text-lg">Data terkini mengenai peraturan dan regulasi yang berlaku di wilayah kami</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Total Regulasi -->
            <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-blue-100/50">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-blue-600 mb-2">{{ $stats['total_regulations'] ?? 0 }}</h3>
                    <p class="text-gray-600 font-medium">Total Regulasi</p>
                </div>
            </div>
            
            <!-- Berlaku -->
            <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-green-100/50">
                <div class="absolute inset-0 bg-gradient-to-br from-green-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-green-600 mb-2">{{ $stats['active_regulations'] ?? 0 }}</h3>
                    <p class="text-gray-600 font-medium">Berlaku</p>
                </div>
            </div>
            
            <!-- Terbaru -->
            <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-amber-100/50">
                <div class="absolute inset-0 bg-gradient-to-br from-amber-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-r from-amber-500 to-amber-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-amber-600 mb-2">{{ $stats['recent_regulations'] ?? 0 }}</h3>
                    <p class="text-gray-600 font-medium">Terbaru (30 hari)</p>
                </div>
            </div>
            
            <!-- Total Unduhan -->
            <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-purple-100/50">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-purple-600 mb-2">{{ number_format($stats['total_downloads'] ?? 0) }}</h3>
                    <p class="text-gray-600 font-medium">Total Unduhan</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filter and Search -->
<section class="relative py-16 bg-gradient-to-br from-white to-gray-50 overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="filter-grid" width="20" height="20" patternUnits="userSpaceOnUse">
                    <circle cx="10" cy="10" r="1" fill="currentColor"/>
                </pattern>
            </defs>
            <rect width="100" height="100" fill="url(#filter-grid)" />
        </svg>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl border border-gray-200/50 p-8">
            <form method="GET" action="{{ route('transparency.regulations') }}">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6">
                    <!-- Search Input -->
                    <div class="lg:col-span-2">
                        <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">Pencarian</label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}" 
                               placeholder="Cari regulasi..." 
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#14213d] focus:border-transparent transition-all duration-300 bg-white/50 backdrop-blur-sm">
                    </div>
                    
                    <!-- Year Filter -->
                    <div>
                        <label for="year" class="block text-sm font-semibold text-gray-700 mb-2">Tahun</label>
                        <select id="year" name="year" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#14213d] focus:border-transparent transition-all duration-300 bg-white/50 backdrop-blur-sm">
                            <option value="">Semua Tahun</option>
                            @for($i = date('Y'); $i >= 2015; $i--)
                                <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    
                    <!-- Type Filter -->
                    <div>
                        <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">Jenis</label>
                        <select id="type" name="type" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#14213d] focus:border-transparent transition-all duration-300 bg-white/50 backdrop-blur-sm">
                            <option value="">Semua Jenis</option>
                            <option value="perda" {{ request('type') == 'perda' ? 'selected' : '' }}>Peraturan Daerah</option>
                            <option value="perbup" {{ request('type') == 'perbup' ? 'selected' : '' }}>Peraturan Bupati</option>
                            <option value="sk" {{ request('type') == 'sk' ? 'selected' : '' }}>Surat Keputusan</option>
                            <option value="se" {{ request('type') == 'se' ? 'selected' : '' }}>Surat Edaran</option>
                            <option value="juklak" {{ request('type') == 'juklak' ? 'selected' : '' }}>Petunjuk Pelaksanaan</option>
                            <option value="juknis" {{ request('type') == 'juknis' ? 'selected' : '' }}>Petunjuk Teknis</option>
                        </select>
                    </div>
                    
                    <!-- Status Filter -->
                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <select id="status" name="status" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#14213d] focus:border-transparent transition-all duration-300 bg-white/50 backdrop-blur-sm">
                            <option value="">Semua Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Berlaku</option>
                            <option value="revoked" {{ request('status') == 'revoked' ? 'selected' : '' }}>Dicabut</option>
                            <option value="amended" {{ request('status') == 'amended' ? 'selected' : '' }}>Diubah</option>
                        </select>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-col justify-end">
                        <div class="flex gap-3">
                            <button type="submit" class="flex-1 bg-gradient-to-r from-[#14213d] to-[#1a2a4a] text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Cari
                            </button>
                            <a href="{{ route('transparency.regulations') }}" class="px-4 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-all duration-300 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

<!-- Regulations List -->
<section class="relative py-20 bg-gradient-to-br from-gray-50 to-white overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="list-grid" width="20" height="20" patternUnits="userSpaceOnUse">
                    <circle cx="10" cy="10" r="1" fill="currentColor"/>
                </pattern>
            </defs>
            <rect width="100" height="100" fill="url(#list-grid)" />
        </svg>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 bg-gradient-to-r from-[#14213d] to-[#1a2a4a] bg-clip-text text-transparent">
                Daftar Regulasi
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto text-lg">Koleksi lengkap peraturan dan regulasi yang berlaku</p>
        </div>
        
        @if($regulations->count() > 0)
            <div class="space-y-6">
                @foreach($regulations as $regulation)
                    @php
                        $data = $regulation->data ? json_decode($regulation->data, true) : [];
                        $type = $data['regulation_type'] ?? 'regulasi';
                        $status = $data['status'] ?? 'active';
                        $number = $data['number'] ?? '';
                        
                        $typeColors = [
                            'perda' => 'blue',
                            'perbup' => 'green',
                            'sk' => 'amber',
                            'se' => 'cyan',
                            'juklak' => 'gray',
                            'juknis' => 'purple'
                        ];
                        
                        $statusColors = [
                            'active' => 'green',
                            'revoked' => 'red',
                            'amended' => 'amber'
                        ];
                        
                        $statusLabels = [
                            'active' => 'Berlaku',
                            'revoked' => 'Dicabut',
                            'amended' => 'Diubah'
                        ];
                    @endphp
                    
                    <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg hover:shadow-xl transition-all duration-500 border border-gray-200/50 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative p-8">
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                                <div class="flex-1">
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        @if($regulation->is_featured)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-yellow-400 to-orange-400 text-white">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                Unggulan
                                            </span>
                                        @endif
                                        
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-{{ $typeColors[$type] ?? 'gray' }}-100 text-{{ $typeColors[$type] ?? 'gray' }}-800">
                                            {{ strtoupper($type) }}
                                            @if($number)
                                                No. {{ $number }}
                                            @endif
                                        </span>
                                        
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-{{ $statusColors[$status] ?? 'gray' }}-100 text-{{ $statusColors[$status] ?? 'gray' }}-800">
                                            {{ $statusLabels[$status] ?? ucfirst($status) }}
                                        </span>
                                    </div>
                                    
                                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#14213d] transition-colors duration-300">
                                        <a href="{{ route('transparency.show', $regulation) }}" class="hover:underline">
                                            {{ $regulation->title }}
                                        </a>
                                    </h3>
                                    
                                    @if($regulation->description)
                                        <p class="text-gray-600 mb-4 leading-relaxed">
                                            {{ Str::limit($regulation->description, 200) }}
                                        </p>
                                    @endif
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        @if($regulation->data)
                                            @if(isset($data['subject']))
                                                <div class="flex items-center text-gray-600">
                                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                    </svg>
                                                    <span class="font-medium">Subjek:</span>
                                                    <span class="ml-1">{{ $data['subject'] }}</span>
                                                </div>
                                            @endif
                                            @if(isset($data['authority']))
                                                <div class="flex items-center text-gray-600">
                                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                    </svg>
                                                    <span class="font-medium">Otoritas:</span>
                                                    <span class="ml-1">{{ $data['authority'] }}</span>
                                                </div>
                                            @endif
                                        @endif
                                        
                                        @if($regulation->period_start)
                                            <div class="flex items-center text-gray-600">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <span class="font-medium">Tanggal:</span>
                                                <span class="ml-1">{{ \Carbon\Carbon::parse($regulation->period_start)->format('d M Y') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="flex flex-col items-end gap-4">
                                    <!-- Files -->
                                    @if($regulation->files)
                                        @php
                                            $files = json_decode($regulation->files, true) ?? [];
                                        @endphp
                                        @if(count($files) > 0)
                                            <div class="flex items-center text-blue-600">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                <span class="font-semibold">{{ count($files) }} File</span>
                                            </div>
                                        @endif
                                    @endif
                                    
                                    <!-- Actions -->
                                    <div class="flex items-center gap-4">
                                        <a href="{{ route('transparency.show', $regulation) }}" 
                                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#14213d] to-[#1a2a4a] text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Detail
                                        </a>
                                        
                                        <!-- Views -->
                                        <div class="flex items-center text-gray-500">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            {{ number_format($regulation->views) }}
                                        </div>
                                    </div>
                                </div>
            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($regulations->hasPages())
                <div class="flex justify-center mt-12">
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-200/50 p-4">
                        {{ $regulations->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif
        @else
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-8">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Tidak ada data regulasi</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">
                    @if(request()->hasAny(['search', 'year', 'type', 'status']))
                        Tidak ditemukan data regulasi yang sesuai dengan kriteria pencarian.
                    @else
                        Belum ada data regulasi yang dipublikasikan.
                    @endif
                </p>
                @if(request()->hasAny(['search', 'year', 'type', 'status']))
                    <a href="{{ route('transparency.regulations') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#14213d] to-[#1a2a4a] text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Reset Filter
                    </a>
                @endif
            </div>
        @endif
    </div>
</section>

<!-- Regulation Categories -->
<section class="relative py-20 bg-gradient-to-br from-[#14213d] to-[#1a2a4a] overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="categories-grid" width="20" height="20" patternUnits="userSpaceOnUse">
                    <circle cx="10" cy="10" r="1" fill="currentColor"/>
                </pattern>
            </defs>
            <rect width="100" height="100" fill="url(#categories-grid)" />
        </svg>
    </div>
    
    <!-- Animated Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-20 left-20 w-40 h-40 bg-gradient-to-r from-blue-300 to-purple-300 rounded-full animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-60 h-60 bg-gradient-to-r from-green-300 to-blue-300 rounded-full animate-bounce"></div>
        <div class="absolute top-1/2 left-1/3 w-32 h-32 bg-gradient-to-r from-purple-300 to-pink-300 rounded-full animate-ping"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                Kategori Regulasi
            </h2>
            <!-- Decorative Line -->
            <div class="flex items-center justify-center mb-6">
                <div class="h-px bg-gradient-to-r from-transparent via-white/30 to-transparent w-64"></div>
                <div class="mx-4 w-2 h-2 bg-white/50 rounded-full"></div>
                <div class="h-px bg-gradient-to-r from-transparent via-white/30 to-transparent w-64"></div>
            </div>
            <p class="text-blue-100 max-w-2xl mx-auto text-lg">Jelajahi berbagai jenis peraturan dan regulasi berdasarkan kategori</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Peraturan Daerah -->
            <div class="group relative bg-white/10 backdrop-blur-sm rounded-2xl p-8 text-center hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 border border-white/20">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-400/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4">Peraturan Daerah</h3>
                    <p class="text-blue-100 mb-6 leading-relaxed">
                        Peraturan yang ditetapkan oleh pemerintah daerah untuk mengatur kehidupan masyarakat.
                    </p>
                    <a href="{{ route('transparency.regulations', ['type' => 'perda']) }}" 
                       class="inline-flex items-center px-6 py-3 bg-white/20 text-white font-semibold rounded-xl hover:bg-white/30 transition-all duration-300 transform hover:scale-105 border border-white/30">
                        Lihat Peraturan
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Surat Keputusan -->
            <div class="group relative bg-white/10 backdrop-blur-sm rounded-2xl p-8 text-center hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 border border-white/20">
                <div class="absolute inset-0 bg-gradient-to-br from-green-400/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-20 h-20 bg-gradient-to-r from-green-400 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4">Surat Keputusan</h3>
                    <p class="text-blue-100 mb-6 leading-relaxed">
                        Keputusan resmi yang ditetapkan oleh pejabat berwenang untuk berbagai keperluan administrasi.
                    </p>
                    <a href="{{ route('transparency.regulations', ['type' => 'sk']) }}" 
                       class="inline-flex items-center px-6 py-3 bg-white/20 text-white font-semibold rounded-xl hover:bg-white/30 transition-all duration-300 transform hover:scale-105 border border-white/30">
                        Lihat Keputusan
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Petunjuk Teknis -->
            <div class="group relative bg-white/10 backdrop-blur-sm rounded-2xl p-8 text-center hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 border border-white/20">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-400/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-20 h-20 bg-gradient-to-r from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4">Petunjuk Teknis</h3>
                    <p class="text-blue-100 mb-6 leading-relaxed">
                        Panduan teknis pelaksanaan berbagai program dan kegiatan pemerintahan.
                    </p>
                    <a href="{{ route('transparency.regulations', ['type' => 'juknis']) }}" 
                       class="inline-flex items-center px-6 py-3 bg-white/20 text-white font-semibold rounded-xl hover:bg-white/30 transition-all duration-300 transform hover:scale-105 border border-white/30">
                        Lihat Petunjuk
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick Links -->
<section class="relative py-20 bg-gradient-to-br from-slate-50 via-gray-50 to-zinc-50 overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="quicklinks-grid" width="20" height="20" patternUnits="userSpaceOnUse">
                    <circle cx="10" cy="10" r="1" fill="currentColor"/>
                </pattern>
            </defs>
            <rect width="100" height="100" fill="url(#quicklinks-grid)" />
        </svg>
    </div>
    
    <!-- Animated Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-20 w-40 h-40 bg-gradient-to-r from-blue-300 to-purple-300 rounded-full animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-60 h-60 bg-gradient-to-r from-green-300 to-blue-300 rounded-full animate-bounce"></div>
        <div class="absolute top-1/2 left-1/3 w-32 h-32 bg-gradient-to-r from-purple-300 to-pink-300 rounded-full animate-ping"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-6">
                Akses Cepat
            </h2>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                Jelajahi berbagai informasi transparansi pemerintahan dengan mudah dan cepat
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Proyek -->
            <div class="group relative">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-3xl blur-xl opacity-25 group-hover:opacity-40 transition-opacity duration-500"></div>
                <div class="relative bg-white/90 backdrop-blur-sm rounded-3xl p-8 border border-white/30 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-3">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-2xl shadow-lg mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-building text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Proyek</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Lihat informasi lengkap mengenai proyek pembangunan infrastruktur dan fasilitas publik.
                        </p>
                        <a href="{{ route('transparency.projects') }}" 
                           class="inline-flex items-center justify-center w-full py-3 px-6 bg-gradient-to-r from-blue-500 to-indigo-500 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Lihat Proyek
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Anggaran -->
            <div class="group relative">
                <div class="absolute inset-0 bg-gradient-to-r from-amber-400 to-orange-400 rounded-3xl blur-xl opacity-25 group-hover:opacity-40 transition-opacity duration-500"></div>
                <div class="relative bg-white/90 backdrop-blur-sm rounded-3xl p-8 border border-white/30 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-3">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-amber-500 to-orange-500 rounded-2xl shadow-lg mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-chart-pie text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Anggaran</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Pantau alokasi anggaran untuk setiap proyek pembangunan dan transparansi keuangan.
                        </p>
                        <a href="{{ route('transparency.budget') }}" 
                           class="inline-flex items-center justify-center w-full py-3 px-6 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Lihat Anggaran
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Laporan -->
            <div class="group relative">
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-3xl blur-xl opacity-25 group-hover:opacity-40 transition-opacity duration-500"></div>
                <div class="relative bg-white/90 backdrop-blur-sm rounded-3xl p-8 border border-white/30 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-3">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl shadow-lg mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-file-alt text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Laporan</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Akses laporan progress dan evaluasi proyek pembangunan terkini.
                        </p>
                        <a href="{{ route('transparency.reports') }}" 
                           class="inline-flex items-center justify-center w-full py-3 px-6 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Lihat Laporan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</x-guest-public-layout>

@push('styles')
<style>
.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
}

.progress {
    background-color: #e9ecef;
    border-radius: 10px;
}

.progress-bar {
    border-radius: 10px;
}

.badge {
    font-size: 0.75rem;
}

.btn-sm {
    font-size: 0.8rem;
}

.timeline-item {
    position: relative;
    padding-left: 30px;
    margin-bottom: 20px;
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: 8px;
    top: 8px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: #28a745;
}
</style>
@endpush