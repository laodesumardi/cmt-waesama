@extends('layouts.app')

@section('title', 'Manajemen Pengajuan Dokumen')

@section('content')
    <x-slot name="header">
        <div class="relative bg-gradient-to-r from-[#14213d] via-[#1a2b4a] to-[#14213d] overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]">
                </div>
            </div>

            <!-- Animated Background Elements -->
            <div class="absolute top-0 left-0 w-32 h-32 bg-white opacity-5 rounded-full animate-pulse"></div>
            <div class="absolute bottom-0 right-0 w-24 h-24 bg-white opacity-5 rounded-full animate-bounce" style="animation-delay: 1s;"></div>

            <div class="relative flex justify-between items-center px-6 py-8">
                <div class="flex items-center space-x-4">
                    <div class="bg-white bg-opacity-20 p-3 rounded-xl backdrop-blur-sm">
                        <i class="fas fa-file-alt text-2xl text-white"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-2xl text-white leading-tight mb-1 animate-fade-in">
                            {{ __('Manajemen Pengajuan Dokumen') }}
                        </h2>
                        <p class="text-blue-100 text-sm opacity-90">Kelola dan pantau semua pengajuan dokumen masyarakat</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.documents.export', request()->query()) }}"
                       class="group bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-xl text-sm font-semibold transition-all duration-300 backdrop-blur-sm border border-white border-opacity-20 hover:border-opacity-40 transform hover:scale-105 hover:shadow-lg">
                        <i class="fas fa-download mr-2 group-hover:animate-bounce"></i>Export CSV
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="stat-card overflow-hidden shadow-lg rounded-xl border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="icon-container w-12 h-12 rounded-xl flex items-center justify-center" style="--icon-from: #3b82f6; --icon-to: #1d4ed8;">
                                    <i class="fas fa-file-alt text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Pengajuan</p>
                                <p class="text-3xl font-bold stat-number mt-1" data-target="{{ $stats['total'] ?? 0 }}">0</p>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-3">
                                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-1.5 rounded-full" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stat-card overflow-hidden shadow-lg rounded-xl border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="icon-container w-12 h-12 rounded-xl flex items-center justify-center" style="--icon-from: #f59e0b; --icon-to: #d97706;">
                                    <i class="fas fa-clock text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Menunggu</p>
                                <p class="text-3xl font-bold stat-number mt-1" data-target="{{ $stats['pending'] ?? 0 }}">0</p>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-3">
                                    <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 h-1.5 rounded-full" style="width: {{ $stats['total'] > 0 ? (($stats['pending'] ?? 0) / $stats['total']) * 100 : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stat-card overflow-hidden shadow-lg rounded-xl border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="icon-container w-12 h-12 rounded-xl flex items-center justify-center" style="--icon-from: #3b82f6; --icon-to: #1e40af;">
                                    <i class="fas fa-cog text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Diproses</p>
                                <p class="text-3xl font-bold stat-number mt-1" data-target="{{ $stats['processing'] ?? 0 }}">0</p>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-3">
                                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-1.5 rounded-full" style="width: {{ $stats['total'] > 0 ? (($stats['processing'] ?? 0) / $stats['total']) * 100 : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stat-card overflow-hidden shadow-lg rounded-xl border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="icon-container w-12 h-12 rounded-xl flex items-center justify-center" style="--icon-from: #10b981; --icon-to: #059669;">
                                    <i class="fas fa-check text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Selesai</p>
                                <p class="text-3xl font-bold stat-number mt-1" data-target="{{ $stats['completed'] ?? 0 }}">0</p>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-3">
                                    <div class="bg-gradient-to-r from-green-500 to-green-600 h-1.5 rounded-full" style="width: {{ $stats['total'] > 0 ? (($stats['completed'] ?? 0) / $stats['total']) * 100 : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100 mb-8">
                <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-4 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div class="bg-[#14213d] p-2 rounded-lg">
                            <i class="fas fa-filter text-white text-sm"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Filter & Pencarian</h3>
                        <div class="flex-1"></div>
                        <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">{{ $documents->total() ?? 0 }} hasil</span>
                    </div>
                </div>
                <div class="p-6">
                    <form method="GET" action="{{ route('admin.documents.index') }}" class="space-y-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-6">
                            <div class="space-y-2">
                                <label for="search" class="block text-sm font-semibold text-gray-700 flex items-center space-x-2">
                                    <i class="fas fa-search text-gray-400 text-xs"></i>
                                    <span>Pencarian</span>
                                </label>
                                <div class="relative">
                                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                                           placeholder="Nama, NIK, atau nomor pengajuan..."
                                           class="w-full pl-10 pr-4 py-3 rounded-xl border-2 border-gray-200 shadow-sm focus:border-[#14213d] focus:ring-4 focus:ring-[#14213d] focus:ring-opacity-20 transition-all duration-300 text-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400 text-sm"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="status" class="block text-sm font-semibold text-gray-700 flex items-center space-x-2">
                                    <i class="fas fa-flag text-gray-400 text-xs"></i>
                                    <span>Status</span>
                                </label>
                                <div class="relative">
                                    <select name="status" id="status" class="w-full pl-10 pr-8 py-3 rounded-xl border-2 border-gray-200 shadow-sm focus:border-[#14213d] focus:ring-4 focus:ring-[#14213d] focus:ring-opacity-20 transition-all duration-300 text-sm appearance-none bg-white">
                                        <option value="">Semua Status</option>
                                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>🟡 Menunggu</option>
                                        <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>🔵 Diproses</option>
                                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>🟢 Selesai</option>
                                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>🔴 Ditolak</option>
                                    </select>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-flag text-gray-400 text-sm"></i>
                                    </div>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="document_type" class="block text-sm font-semibold text-gray-700 flex items-center space-x-2">
                                    <i class="fas fa-file-alt text-gray-400 text-xs"></i>
                                    <span>Jenis Dokumen</span>
                                </label>
                                <div class="relative">
                                    <select name="document_type" id="document_type" class="w-full pl-10 pr-8 py-3 rounded-xl border-2 border-gray-200 shadow-sm focus:border-[#14213d] focus:ring-4 focus:ring-[#14213d] focus:ring-opacity-20 transition-all duration-300 text-sm appearance-none bg-white">
                                        <option value="">Semua Jenis</option>
                                        @foreach(\App\Models\DocumentRequest::getDocumentTypes() as $key => $label)
                                            <option value="{{ $key }}" {{ request('document_type') === $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-file-alt text-gray-400 text-sm"></i>
                                    </div>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="date_range" class="block text-sm font-semibold text-gray-700 flex items-center space-x-2">
                                    <i class="fas fa-calendar text-gray-400 text-xs"></i>
                                    <span>Tanggal</span>
                                </label>
                                <div class="relative">
                                    <select name="date_range" id="date_range" class="w-full pl-10 pr-8 py-3 rounded-xl border-2 border-gray-200 shadow-sm focus:border-[#14213d] focus:ring-4 focus:ring-[#14213d] focus:ring-opacity-20 transition-all duration-300 text-sm appearance-none bg-white">
                                        <option value="">Semua Tanggal</option>
                                        <option value="today" {{ request('date_range') === 'today' ? 'selected' : '' }}>📅 Hari Ini</option>
                                        <option value="week" {{ request('date_range') === 'week' ? 'selected' : '' }}>📅 Minggu Ini</option>
                                        <option value="month" {{ request('date_range') === 'month' ? 'selected' : '' }}>📅 Bulan Ini</option>
                                    </select>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-calendar text-gray-400 text-sm"></i>
                                    </div>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <div class="flex flex-wrap gap-3">
                                <button type="submit" class="group inline-flex items-center px-8 py-3 bg-gradient-to-r from-[#14213d] to-[#1a2b4a] border border-transparent rounded-xl font-semibold text-sm text-white hover:from-[#0f1a2e] hover:to-[#162238] focus:outline-none focus:ring-4 focus:ring-[#14213d] focus:ring-opacity-30 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                    <svg class="w-5 h-5 mr-2 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    Terapkan Filter
                                </button>
                                <a href="{{ route('admin.documents.index') }}" class="group inline-flex items-center px-6 py-3 bg-white border-2 border-gray-300 rounded-xl font-semibold text-sm text-gray-700 hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-200 transition-all duration-300 shadow-md hover:shadow-lg">
                                    <svg class="w-5 h-5 mr-2 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    Reset Filter
                                </a>
                                <button type="button" onclick="toggleAdvancedFilters()" class="inline-flex items-center px-4 py-3 bg-blue-50 border border-blue-200 rounded-xl font-medium text-sm text-blue-700 hover:bg-blue-100 transition-all duration-300">
                                    <i class="fas fa-sliders-h mr-2"></i>
                                    Filter Lanjutan
                                </button>
                            </div>

                            <div class="flex items-center space-x-4">
                                <div class="text-sm text-gray-600 bg-gray-50 px-4 py-2 rounded-lg border">
                                    <i class="fas fa-list mr-2 text-gray-400"></i>
                                    Menampilkan {{ $documents->firstItem() ?? 0 }} - {{ $documents->lastItem() ?? 0 }} dari {{ $documents->total() ?? 0 }} pengajuan
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Documents Table -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="select-all" class="rounded-lg border-2 border-gray-300 text-[#14213d] shadow-sm focus:border-[#14213d] focus:ring focus:ring-[#14213d] focus:ring-opacity-30 transition-all duration-200">
                                        <span class="ml-2 text-gray-500">Pilih</span>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-file-alt text-gray-400"></i>
                                        <span>Pengajuan</span>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-user text-gray-400"></i>
                                        <span>Pemohon</span>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-tags text-gray-400"></i>
                                        <span>Jenis Dokumen</span>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-info-circle text-gray-400"></i>
                                        <span>Status</span>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-calendar text-gray-400"></i>
                                        <span>Tanggal</span>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-cogs text-gray-400"></i>
                                        <span>Aksi</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($documents as $document)
                                <tr data-id="{{ $document->id }}" class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-300 {{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <input type="checkbox" name="selected_documents[]" value="{{ $document->id }}"
                                               class="document-checkbox rounded-lg border-2 border-gray-300 text-[#14213d] shadow-sm focus:border-[#14213d] focus:ring focus:ring-[#14213d] focus:ring-opacity-30 transition-all duration-200">
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <div class="bg-[#14213d] p-2 rounded-lg">
                                                <i class="fas fa-file-alt text-white text-sm"></i>
                                            </div>
                                            <div>
                                                <div class="text-sm font-bold text-gray-900">#{{ $document->request_number }}</div>
                                                <div class="text-xs text-gray-500 mt-1">{{ Str::limit($document->purpose, 30) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-2 rounded-lg">
                                                <i class="fas fa-user text-white text-sm"></i>
                                            </div>
                                            <div>
                                                <div class="text-sm font-bold text-gray-900">{{ $document->full_name }}</div>
                                                <div class="text-xs text-gray-500 mt-1">{{ $document->nik }}</div>
                                                <div class="text-xs text-gray-500">{{ $document->phone }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="bg-gray-100 px-3 py-2 rounded-lg">
                                            <span class="text-sm font-semibold text-gray-800">{{ $document->document_type_label }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <span class="status-badge inline-flex items-center px-3 py-2 text-xs font-bold rounded-full {{ $document->status_color }} shadow-sm">
                                            @if($document->status === 'pending')
                                                <i class="fas fa-clock mr-1"></i>
                                            @elseif($document->status === 'processing')
                                                <i class="fas fa-cog mr-1"></i>
                                            @elseif($document->status === 'completed')
                                                <i class="fas fa-check mr-1"></i>
                                            @elseif($document->status === 'rejected')
                                                <i class="fas fa-times mr-1"></i>
                                            @endif
                                            {{ $document->status_label }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="bg-gray-50 px-3 py-2 rounded-lg">
                                            <div class="text-sm font-semibold text-gray-900">{{ $document->created_at->format('d/m/Y') }}</div>
                                            <div class="text-xs text-gray-500 mt-1">{{ $document->created_at->format('H:i') }} WIB</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('admin.documents.show', $document) }}"
                                               class="group bg-[#14213d] hover:bg-[#0f1a2e] text-white p-2 rounded-lg transition-all duration-300 transform hover:scale-110 shadow-md hover:shadow-lg" title="Lihat Detail">
                                                <svg class="w-4 h-4 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            @if($document->status !== 'completed' && $document->status !== 'rejected')
                                                <button onclick="updateStatus({{ $document->id }}, 'processing')"
                                                        class="group bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-lg transition-all duration-300 transform hover:scale-110 shadow-md hover:shadow-lg" title="Proses">
                                                    <i class="fas fa-cog group-hover:animate-spin"></i>
                                                </button>
                                                <button onclick="updateStatus({{ $document->id }}, 'completed')"
                                                        class="group bg-green-500 hover:bg-green-600 text-white p-2 rounded-lg transition-all duration-300 transform hover:scale-110 shadow-md hover:shadow-lg" title="Selesai">
                                                    <i class="fas fa-check group-hover:animate-bounce"></i>
                                                </button>
                                                <button onclick="updateStatus({{ $document->id }}, 'rejected')"
                                                        class="group bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition-all duration-300 transform hover:scale-110 shadow-md hover:shadow-lg" title="Tolak">
                                                    <i class="fas fa-times group-hover:animate-pulse"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center space-y-4">
                                            <div class="bg-gray-100 p-6 rounded-full">
                                                <i class="fas fa-inbox text-5xl text-gray-400"></i>
                                            </div>
                                            <div class="space-y-2">
                                                <p class="text-xl font-bold text-gray-700">Tidak ada pengajuan dokumen</p>
                                                <p class="text-sm text-gray-500 max-w-md">Belum ada pengajuan dokumen yang masuk. Data akan muncul di sini setelah ada pengajuan baru.</p>
                                            </div>
                                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 max-w-md">
                                                <p class="text-sm text-blue-700">
                                                    <i class="fas fa-info-circle mr-2"></i>
                                                    Pengajuan dokumen dari masyarakat akan ditampilkan di tabel ini
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($documents->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $documents->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>

            <!-- Bulk Actions -->
            <div id="bulk-actions" class="hidden bg-gradient-to-r from-blue-50 to-indigo-50 border-t-4 border-[#14213d] shadow-xl sm:rounded-2xl mt-6 overflow-hidden">
                <div class="p-6">
                    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between space-y-4 lg:space-y-0">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-3 sm:space-y-0 sm:space-x-6">
                            <div class="flex items-center space-x-3">
                                <div class="bg-[#14213d] p-2 rounded-lg">
                                    <i class="fas fa-tasks text-white"></i>
                                </div>
                                <div>
                                    <span class="text-sm font-bold text-gray-800">Aksi Massal</span>
                                    <p class="text-xs text-gray-600">Kelola beberapa pengajuan sekaligus</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4">
                                <div class="relative">
                                    <select id="bulk-status" class="appearance-none bg-white border-2 border-gray-300 rounded-xl px-4 py-3 pr-10 text-sm font-semibold text-gray-700 focus:border-[#14213d] focus:ring-4 focus:ring-[#14213d] focus:ring-opacity-20 transition-all duration-300 shadow-md hover:shadow-lg">
                                        <option value="">Pilih Status Baru</option>
                                        <option value="processing">🔄 Proses</option>
                                        <option value="completed">✅ Selesai</option>
                                        <option value="rejected">❌ Tolak</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400"></i>
                                    </div>
                                </div>

                                <button onclick="bulkUpdateStatus()" class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#14213d] to-[#1a2b4a] border border-transparent rounded-xl font-bold text-sm text-white hover:from-[#0f1a2e] hover:to-[#162238] focus:outline-none focus:ring-4 focus:ring-[#14213d] focus:ring-opacity-30 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                    <i class="fas fa-sync-alt mr-2 group-hover:animate-spin"></i>
                                    Update Status
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="bg-white px-4 py-2 rounded-lg border border-gray-200 shadow-sm">
                                <span class="text-sm font-semibold text-gray-700">
                                    <i class="fas fa-check-square text-[#14213d] mr-2"></i>
                                    <span id="selected-count">0</span> pengajuan terpilih
                                </span>
                            </div>

                            <button onclick="clearSelection()" class="group inline-flex items-center px-4 py-2 bg-white border-2 border-gray-300 rounded-xl font-semibold text-sm text-gray-700 hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-200 transition-all duration-300 shadow-md hover:shadow-lg">
                                <i class="fas fa-times mr-2 group-hover:rotate-90 transition-transform duration-300"></i>
                                Batal Pilihan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
         to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideUp {
        from { opacity: 1; transform: translateY(0); }
        to { opacity: 0; transform: translateY(-20px); }
    }

    .animate-fade-in {
        animation: fade-in 0.8s ease-out;
    }

    .stat-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    }

    .stat-card:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .stat-number {
        background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .icon-container {
        background: linear-gradient(135deg, var(--icon-from) 0%, var(--icon-to) 100%);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .loading-spinner {
        background: white;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }
</style>
@endpush

@push('scripts')
    <script>
        // Counter Animation for Statistics
        function animateCounter(element, target) {
            let current = 0;
            const increment = target / 50;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(current);
            }, 30);
        }

        // Initialize counter animations when page loads
        document.addEventListener('DOMContentLoaded', function() {
            const statNumbers = document.querySelectorAll('.stat-number[data-target]');

            // Use Intersection Observer for better performance
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const target = parseInt(entry.target.getAttribute('data-target'));
                        animateCounter(entry.target, target);
                        observer.unobserve(entry.target);
                    }
                });
            });

            statNumbers.forEach(element => {
                observer.observe(element);
            });
        });

        // Loading spinner function
        function showLoading(button) {
            const originalContent = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
            button.disabled = true;
            return originalContent;
        }

        function hideLoading(button, originalContent) {
            button.innerHTML = originalContent;
            button.disabled = false;
        }

        // Update selected count
        function updateSelectedCount() {
            const checkedBoxes = document.querySelectorAll('.document-checkbox:checked');
            const countElement = document.getElementById('selected-count');
            const bulkActions = document.getElementById('bulk-actions');

            countElement.textContent = checkedBoxes.length;

            if (checkedBoxes.length > 0) {
                bulkActions.classList.remove('hidden');
                bulkActions.style.animation = 'slideDown 0.3s ease-out';
            } else {
                bulkActions.style.animation = 'slideUp 0.3s ease-out';
                setTimeout(() => {
                    bulkActions.classList.add('hidden');
                }, 300);
            }
        }

        // Checkbox functionality
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.document-checkbox');

            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });

            updateSelectedCount();
        });

        // Individual checkbox change
        document.querySelectorAll('.document-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('.document-checkbox');
                const checkedBoxes = document.querySelectorAll('.document-checkbox:checked');
                const selectAll = document.getElementById('select-all');

                selectAll.checked = checkboxes.length === checkedBoxes.length;
                selectAll.indeterminate = checkedBoxes.length > 0 && checkedBoxes.length < checkboxes.length;

                updateSelectedCount();
            });
        });

        function updateBulkActions() {
            updateSelectedCount();
        }

        function clearSelection() {
            document.querySelectorAll('.document-checkbox').forEach(checkbox => {
                checkbox.checked = false;
            });
            document.getElementById('select-all').checked = false;
            updateBulkActions();
        }

        // Status update functions
        function updateStatus(documentId, status) {
            if (confirm('Apakah Anda yakin ingin mengubah status pengajuan ini?')) {
                // Show loading overlay
                const loadingOverlay = document.createElement('div');
                loadingOverlay.className = 'loading-overlay';
                loadingOverlay.innerHTML = `
                    <div class="loading-spinner">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-spinner fa-spin text-2xl text-blue-600"></i>
                            <span class="text-lg font-semibold text-gray-700">Mengupdate status...</span>
                        </div>
                    </div>
                `;
                document.body.appendChild(loadingOverlay);

                console.log('Sending AJAX request to update status:', { documentId, status });
                fetch(`/admin/documents/${documentId}/status`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ status: status })
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    console.log('Response headers:', response.headers);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data);
                    document.body.removeChild(loadingOverlay);
                    if (data.success) {
                        // Update status badge in the table
                        const statusCell = document.querySelector(`tr[data-id="${documentId}"] .status-badge`);
                        if (statusCell) {
                            statusCell.className = `status-badge px-3 py-1 rounded-full text-xs font-semibold ${getStatusClass(status)}`;
                            statusCell.textContent = getStatusLabel(status);
                        }

                        // Show success message
                        showNotification(data.message, 'success');
                    } else {
                        alert('Terjadi kesalahan: ' + data.message);
                    }
                })
                .catch(error => {
                    document.body.removeChild(loadingOverlay);
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengupdate status');
                });
            }
        }

        function bulkUpdateStatus() {
            const selectedCheckboxes = document.querySelectorAll('.document-checkbox:checked');
            const status = document.getElementById('bulk-status').value;

            if (selectedCheckboxes.length === 0) {
                alert('Pilih pengajuan yang ingin diupdate');
                return;
            }

            if (!status) {
                alert('Pilih status yang ingin diterapkan');
                return;
            }

            if (confirm(`Apakah Anda yakin ingin mengubah status ${selectedCheckboxes.length} pengajuan?`)) {
                // Show loading overlay
                const loadingOverlay = document.createElement('div');
                loadingOverlay.className = 'loading-overlay';
                loadingOverlay.innerHTML = `
                    <div class="loading-spinner">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-spinner fa-spin text-2xl text-blue-600"></i>
                            <span class="text-lg font-semibold text-gray-700">Mengupdate ${selectedCheckboxes.length} pengajuan...</span>
                        </div>
                    </div>
                `;
                document.body.appendChild(loadingOverlay);

                const documentIds = Array.from(selectedCheckboxes).map(cb => cb.value);

                fetch('/admin/documents/bulk-update', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        document_ids: documentIds,
                        action: getActionFromStatus(status)
                    })
                })
                .then(response => response.json())
                .then(data => {
                    document.body.removeChild(loadingOverlay);
                    if (data.success) {
                        // Update status badges for all selected items
                        documentIds.forEach(id => {
                            const statusCell = document.querySelector(`tr[data-id="${id}"] .status-badge`);
                            if (statusCell) {
                                statusCell.className = `status-badge px-3 py-1 rounded-full text-xs font-semibold ${getStatusClass(status)}`;
                                statusCell.textContent = getStatusLabel(status);
                            }
                        });

                        // Clear selections
                        selectedCheckboxes.forEach(cb => cb.checked = false);
                        updateBulkActions();

                        // Show success message
                        showNotification(data.message, 'success');
                    } else {
                        alert('Terjadi kesalahan: ' + data.message);
                    }
                })
                .catch(error => {
                    document.body.removeChild(loadingOverlay);
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengupdate status');
                });
            }
        }

        // Helper functions
        function getStatusClass(status) {
            switch(status) {
                case 'pending': return 'bg-yellow-100 text-yellow-800';
                case 'processing': return 'bg-blue-100 text-blue-800';
                case 'completed': return 'bg-green-100 text-green-800';
                case 'rejected': return 'bg-red-100 text-red-800';
                default: return 'bg-gray-100 text-gray-800';
            }
        }

        function getStatusLabel(status) {
            switch(status) {
                case 'pending': return 'Menunggu';
                case 'processing': return 'Diproses';
                case 'completed': return 'Selesai';
                case 'rejected': return 'Ditolak';
                default: return status;
            }
        }

        function getActionFromStatus(status) {
            switch(status) {
                case 'completed': return 'approve';
                case 'rejected': return 'reject';
                case 'processing': return 'process';
                default: return 'process';
            }
        }

        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg transform transition-all duration-300 ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            notification.innerHTML = `
                <div class="flex items-center space-x-3">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                    <span>${message}</span>
                </div>
            `;

            document.body.appendChild(notification);

            // Auto remove after 3 seconds
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (notification.parentNode) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }
    </script>
@endpush
