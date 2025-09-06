<x-guest-public-layout>
    <x-slot name="title">Transparansi Proyek</x-slot>

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
                    <pattern id="projects-grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <circle cx="5" cy="5" r="1" fill="currentColor" class="animate-pulse"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#projects-grid)"/>
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
                    Transparansi Proyek
                </h1>
                <p class="text-xl md:text-2xl text-gray-200 max-w-3xl mx-auto leading-relaxed">
                    Informasi lengkap mengenai proyek pembangunan infrastruktur dan fasilitas publik untuk mewujudkan transparansi dan akuntabilitas
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
                Statistik Proyek
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto text-lg">Data terkini mengenai proyek pembangunan infrastruktur dan fasilitas publik di wilayah kami</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Total Proyek -->
            <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-blue-100/50">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-blue-600 mb-2">{{ $stats['total_projects'] ?? 0 }}</h3>
                    <p class="text-gray-600 font-medium">Total Proyek</p>
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
                    <h3 class="text-3xl font-bold text-green-600 mb-2">{{ $stats['completed_projects'] ?? 0 }}</h3>
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
                    <h3 class="text-3xl font-bold text-yellow-600 mb-2">{{ $stats['ongoing_projects'] ?? 0 }}</h3>
                    <p class="text-gray-600 font-medium">Sedang Berjalan</p>
                </div>
            </div>
            
            <!-- Total Anggaran -->
            <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-purple-100/50">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-purple-600 mb-2">Rp {{ number_format($stats['total_budget'] ?? 0, 0, ',', '.') }}</h3>
                    <p class="text-gray-600 font-medium">Total Anggaran</p>
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
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Filter Proyek</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Gunakan filter di bawah untuk mencari data proyek yang spesifik sesuai kebutuhan Anda</p>
        </div>
        
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200/50 p-8">
            <form method="GET" action="{{ route('transparency.projects') }}">
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
                               placeholder="Cari nama proyek..." 
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
                            <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Sedang Berjalan</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Ditunda</option>
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
                            <option value="budget_high" {{ request('sort') == 'budget_high' ? 'selected' : '' }}>Anggaran Tertinggi</option>
                            <option value="budget_low" {{ request('sort') == 'budget_low' ? 'selected' : '' }}>Anggaran Terendah</option>
                            <option value="progress" {{ request('sort') == 'progress' ? 'selected' : '' }}>Progress</option>
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
                            <a href="{{ route('transparency.projects') }}" class="px-4 py-3 border border-gray-200 rounded-xl hover:bg-gray-50 transition-all duration-200 text-gray-600 hover:text-gray-800" title="Reset Filter">
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

<!-- Projects List -->
<section class="relative py-20 bg-gradient-to-br from-gray-50 to-white overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <defs>
                <pattern id="projects-list-grid" width="20" height="20" patternUnits="userSpaceOnUse">
                    <circle cx="10" cy="10" r="1" fill="#14213d"/>
                </pattern>
            </defs>
            <rect width="100" height="100" fill="url(#projects-list-grid)"/>
        </svg>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 bg-gradient-to-r from-[#14213d] to-[#1a2a4a] bg-clip-text text-transparent">
                Daftar Proyek
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto text-lg">Informasi lengkap mengenai proyek pembangunan infrastruktur dan fasilitas publik</p>
        </div>
        
        @if($projects->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @foreach($projects as $project)
                    <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200/50 overflow-hidden hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <div class="relative p-8">
                            <!-- Header -->
                            <div class="flex justify-between items-start mb-6">
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#14213d] transition-colors duration-300">
                                        <a href="{{ route('transparency.show', $project) }}" class="hover:underline">
                                            {{ $project->title }}
                                        </a>
                                    </h3>
                                    @if($project->data)
                                        @php
                                            $data = json_decode($project->data, true);
                                            $status = $data['status'] ?? 'planning';
                                            $statusColors = [
                                                'planning' => 'bg-gray-100 text-gray-700',
                                                'ongoing' => 'bg-blue-100 text-blue-700',
                                                'completed' => 'bg-green-100 text-green-700',
                                                'suspended' => 'bg-yellow-100 text-yellow-700'
                                            ];
                                            $statusLabels = [
                                                'planning' => 'Perencanaan',
                                                'ongoing' => 'Sedang Berjalan',
                                                'completed' => 'Selesai',
                                                'suspended' => 'Ditunda'
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusColors[$status] ?? 'bg-gray-100 text-gray-700' }}">
                                            {{ $statusLabels[$status] ?? ucfirst($status) }}
                                        </span>
                                    @endif
                                </div>
                                @if($project->is_featured)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        Unggulan
                                    </span>
                                @endif
                            </div>

                            @if($project->description)
                                <p class="text-gray-600 mb-6 leading-relaxed">{{ Str::limit($project->description, 120) }}</p>
                            @endif

                            <!-- Info Grid -->
                            <div class="grid grid-cols-2 gap-6 mb-6">
                                @if($project->amount)
                                    <div class="space-y-1">
                                        <p class="text-sm text-gray-500 font-medium">Anggaran</p>
                                        <p class="text-lg font-bold text-green-600">
                                            Rp {{ number_format($project->amount, 0, ',', '.') }}
                                        </p>
                                    </div>
                                @endif
                                @if($project->period_start)
                                    <div class="space-y-1">
                                        <p class="text-sm text-gray-500 font-medium">Periode</p>
                                        <p class="text-lg font-bold text-gray-900">
                                            {{ $project->period_start->format('M Y') }}
                                            @if($project->period_end && $project->period_end != $project->period_start)
                                                - {{ $project->period_end->format('M Y') }}
                                            @endif
                                        </p>
                                    </div>
                                @endif
                            </div>

                            @if($project->data)
                                @php
                                    $data = json_decode($project->data, true);
                                @endphp
                                @if(isset($data['location']))
                                    <div class="mb-4">
                                        <p class="text-sm text-gray-500 font-medium mb-1">Lokasi</p>
                                        <p class="text-gray-900 font-semibold flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $data['location'] }}
                                        </p>
                                    </div>
                                @endif
                                @if(isset($data['contractor']))
                                    <div class="mb-4">
                                        <p class="text-sm text-gray-500 font-medium mb-1">Kontraktor</p>
                                        <p class="text-gray-900 font-semibold">{{ $data['contractor'] }}</p>
                                    </div>
                                @endif
                                @if(isset($data['progress']))
                                    <div class="mb-4">
                                        <div class="flex justify-between items-center mb-2">
                                            <p class="text-sm text-gray-500 font-medium">Progress Fisik</p>
                                            <p class="text-sm font-bold text-gray-900">{{ $data['progress'] }}%</p>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-green-500 h-2 rounded-full transition-all duration-300" style="width: {{ $data['progress'] }}%"></div>
                                        </div>
                                    </div>
                                @endif
                                @if(isset($data['financial_progress']))
                                    <div class="mb-6">
                                        <div class="flex justify-between items-center mb-2">
                                            <p class="text-sm text-gray-500 font-medium">Progress Keuangan</p>
                                            <p class="text-sm font-bold text-gray-900">{{ $data['financial_progress'] }}%</p>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-blue-500 h-2 rounded-full transition-all duration-300" style="width: {{ $data['financial_progress'] }}%"></div>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            <!-- Actions -->
                            <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                <div class="flex gap-3">
                                    <a href="{{ route('transparency.show', $project) }}" 
                                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#14213d] to-[#1a2a4a] text-white text-sm font-medium rounded-lg hover:from-[#1a2a4a] hover:to-[#14213d] transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Detail
                                    </a>
                                    @if($project->files)
                                        @php
                                            $files = json_decode($project->files, true) ?? [];
                                        @endphp
                                        @if(count($files) > 0)
                                            <span class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 text-sm font-medium rounded-lg">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                {{ count($files) }} File
                                            </span>
                                        @endif
                                    @endif
                                </div>
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    {{ number_format($project->views) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($projects->hasPages())
                <div class="flex justify-center mt-12">
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-200/50 p-4">
                        {{ $projects->appends(request()->query())->links() }}
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
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Tidak ada data proyek</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">
                    @if(request()->hasAny(['search', 'year', 'status']))
                        Tidak ditemukan data proyek yang sesuai dengan kriteria pencarian.
                    @else
                        Belum ada data proyek yang dipublikasikan.
                    @endif
                </p>
                @if(request()->hasAny(['search', 'year', 'status']))
                    <a href="{{ route('transparency.projects') }}" 
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

<!-- Project Categories -->
<section class="relative py-20 bg-gradient-to-br from-[#14213d] to-[#1a2a4a] overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <defs>
                <pattern id="categories-grid" width="20" height="20" patternUnits="userSpaceOnUse">
                    <circle cx="10" cy="10" r="1" fill="white"/>
                </pattern>
            </defs>
            <rect width="100" height="100" fill="url(#categories-grid)"/>
        </svg>
    </div>
    
    <!-- Animated Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-10 left-10 w-20 h-20 bg-white rounded-full animate-pulse"></div>
        <div class="absolute top-40 right-20 w-16 h-16 bg-white rounded-full animate-pulse" style="animation-delay: 1s"></div>
        <div class="absolute bottom-20 left-1/4 w-12 h-12 bg-white rounded-full animate-pulse" style="animation-delay: 2s"></div>
        <div class="absolute bottom-40 right-1/3 w-8 h-8 bg-white rounded-full animate-pulse" style="animation-delay: 3s"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Kategori Proyek
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-blue-400 to-purple-400 mx-auto mb-6 rounded-full"></div>
            <p class="text-blue-100 max-w-2xl mx-auto text-lg">Jelajahi proyek berdasarkan kategori pembangunan infrastruktur dan fasilitas publik</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="group relative bg-white/10 backdrop-blur-sm rounded-2xl p-8 text-center hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 border border-white/20">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-400/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4">Infrastruktur Jalan</h3>
                    <p class="text-blue-100 mb-6 leading-relaxed">
                        Pembangunan dan perbaikan jalan, jembatan, dan akses transportasi untuk meningkatkan konektivitas.
                    </p>
                    <a href="{{ route('transparency.projects', ['category' => 'infrastruktur']) }}" 
                       class="inline-flex items-center px-6 py-3 bg-white/20 text-white font-semibold rounded-xl hover:bg-white/30 transition-all duration-300 transform hover:scale-105 border border-white/30">
                        Lihat Proyek
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            
            <div class="group relative bg-white/10 backdrop-blur-sm rounded-2xl p-8 text-center hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 border border-white/20">
                <div class="absolute inset-0 bg-gradient-to-br from-green-400/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-20 h-20 bg-gradient-to-r from-green-400 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4">Fasilitas Publik</h3>
                    <p class="text-blue-100 mb-6 leading-relaxed">
                        Pembangunan gedung pemerintahan, sekolah, puskesmas, dan fasilitas umum lainnya.
                    </p>
                    <a href="{{ route('transparency.projects', ['category' => 'fasilitas']) }}" 
                       class="inline-flex items-center px-6 py-3 bg-white/20 text-white font-semibold rounded-xl hover:bg-white/30 transition-all duration-300 transform hover:scale-105 border border-white/30">
                        Lihat Proyek
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            
            <div class="group relative bg-white/10 backdrop-blur-sm rounded-2xl p-8 text-center hover:bg-white/20 transition-all duration-500 transform hover:-translate-y-2 border border-white/20">
                <div class="absolute inset-0 bg-gradient-to-br from-cyan-400/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-20 h-20 bg-gradient-to-r from-cyan-400 to-cyan-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4">Air & Sanitasi</h3>
                    <p class="text-blue-100 mb-6 leading-relaxed">
                        Proyek air bersih, drainase, dan sistem sanitasi lingkungan untuk kesehatan masyarakat.
                    </p>
                    <a href="{{ route('transparency.projects', ['category' => 'sanitasi']) }}" 
                       class="inline-flex items-center px-6 py-3 bg-white/20 text-white font-semibold rounded-xl hover:bg-white/30 transition-all duration-300 transform hover:scale-105 border border-white/30">
                        Lihat Proyek
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
            <!-- Anggaran -->
            <div class="group relative">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-3xl blur-xl opacity-25 group-hover:opacity-40 transition-opacity duration-500"></div>
                <div class="relative bg-white/90 backdrop-blur-sm rounded-3xl p-8 border border-white/30 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-3">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-2xl shadow-lg mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-chart-pie text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Anggaran</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Lihat alokasi anggaran untuk setiap proyek pembangunan dan transparansi keuangan.
                        </p>
                        <a href="{{ route('transparency.budget') }}" 
                           class="inline-flex items-center justify-center w-full py-3 px-6 bg-gradient-to-r from-blue-500 to-indigo-500 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Lihat Anggaran
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Pengadaan -->
            <div class="group relative">
                <div class="absolute inset-0 bg-gradient-to-r from-amber-400 to-orange-400 rounded-3xl blur-xl opacity-25 group-hover:opacity-40 transition-opacity duration-500"></div>
                <div class="relative bg-white/90 backdrop-blur-sm rounded-3xl p-8 border border-white/30 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-3">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-amber-500 to-orange-500 rounded-2xl shadow-lg mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-shopping-cart text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Pengadaan</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Pantau proses pengadaan barang dan jasa untuk proyek pembangunan.
                        </p>
                        <a href="{{ route('transparency.procurement') }}" 
                           class="inline-flex items-center justify-center w-full py-3 px-6 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Lihat Pengadaan
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