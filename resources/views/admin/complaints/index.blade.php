@extends('layouts.app')

@section('title', 'Manajemen Pengaduan')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6">
        <div class="flex-1">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Manajemen Pengaduan</h1>
                    <nav class="flex mt-2" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                    <span class="text-gray-500 ml-1 md:ml-2">Pengaduan</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>
        <!-- Export Button -->
        <div class="mt-4 lg:mt-0">
            <a href="{{ route('admin.complaints.export') }}{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}" class="inline-flex items-center px-6 py-3 bg-[#14213d] hover:bg-[#0f1a2e] text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                <i class="fas fa-download mr-2"></i> Export CSV
            </a>
        </div>
    </div>



    <!-- Alert Messages -->
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="stat-card group bg-white/95 backdrop-blur-md border border-gray-200/50 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 animate-fade-in" style="animation-delay: 0.1s; --icon-from: #6b7280; --icon-to: #4b5563;">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <dt class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2">Total Pengaduan</dt>
                    <dd class="stat-number text-3xl font-bold mb-2" data-target="{{ $stats['total'] ?? 0 }}">0</dd>
                    <div class="flex items-center text-sm">
                        <span class="text-gray-500">Semua pengaduan</span>
                    </div>
                </div>
                <div class="icon-container w-14 h-14 rounded-xl flex items-center justify-center ml-4">
                    <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 bg-gray-100 rounded-full h-2 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-400 to-gray-600 h-full rounded-full" style="width: 100%;"></div>
            </div>
        </div>

        <div class="stat-card group bg-white/95 backdrop-blur-md border border-gray-200/50 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 animate-fade-in" style="animation-delay: 0.2s; --icon-from: #f59e0b; --icon-to: #d97706;">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <dt class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2">Menunggu</dt>
                    <dd class="stat-number text-3xl font-bold mb-2" data-target="{{ $stats['open'] ?? 0 }}">0</dd>
                    <div class="flex items-center text-sm">
                        <span class="text-yellow-600 font-medium">⏳ Perlu ditindaklanjuti</span>
                    </div>
                </div>
                <div class="icon-container w-14 h-14 rounded-xl flex items-center justify-center ml-4">
                    <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 bg-gray-100 rounded-full h-2 overflow-hidden">
                <div class="bg-gradient-to-r from-yellow-400 to-yellow-600 h-full rounded-full" style="width: {{ $stats['total'] > 0 ? round(($stats['open'] ?? 0) / $stats['total'] * 100) : 0 }}%;"></div>
            </div>
        </div>

        <div class="stat-card group bg-white/95 backdrop-blur-md border border-gray-200/50 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 animate-fade-in" style="animation-delay: 0.3s; --icon-from: #3b82f6; --icon-to: #2563eb;">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <dt class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2">Diproses</dt>
                    <dd class="stat-number text-3xl font-bold mb-2" data-target="{{ $stats['in_progress'] ?? 0 }}">0</dd>
                    <div class="flex items-center text-sm">
                        <span class="text-blue-600 font-medium">🔄 Sedang ditangani</span>
                    </div>
                </div>
                <div class="icon-container w-14 h-14 rounded-xl flex items-center justify-center ml-4">
                    <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 bg-gray-100 rounded-full h-2 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-full rounded-full" style="width: {{ $stats['total'] > 0 ? round(($stats['in_progress'] ?? 0) / $stats['total'] * 100) : 0 }}%;"></div>
            </div>
        </div>

        <div class="stat-card group bg-white/95 backdrop-blur-md border border-gray-200/50 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 animate-fade-in" style="animation-delay: 0.4s; --icon-from: #10b981; --icon-to: #059669;">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <dt class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2">Selesai</dt>
                    <dd class="stat-number text-3xl font-bold mb-2" data-target="{{ $stats['resolved'] ?? 0 }}">0</dd>
                    <div class="flex items-center text-sm">
                        <span class="text-green-600 font-medium">✅ Telah diselesaikan</span>
                    </div>
                </div>
                <div class="icon-container w-14 h-14 rounded-xl flex items-center justify-center ml-4">
                    <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 bg-gray-100 rounded-full h-2 overflow-hidden">
                <div class="bg-gradient-to-r from-green-400 to-green-600 h-full rounded-full" style="width: {{ $stats['total'] > 0 ? round(($stats['resolved'] ?? 0) / $stats['total'] * 100) : 0 }}%;"></div>
            </div>
        </div>
    </div>

    <!-- Filter and Search -->
    <div class="bg-white/95 backdrop-blur-md border border-gray-200/50 rounded-2xl shadow-xl mb-8 animate-fade-in" style="animation-delay: 0.5s;">
        <div class="p-8">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-br from-[#14213d] to-[#1a2b4a] rounded-xl flex items-center justify-center mr-4 shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">Filter & Pencarian</h3>
                    <p class="text-sm text-gray-600 mt-1">Gunakan filter untuk menemukan pengaduan yang spesifik</p>
                </div>
            </div>
            <form method="GET" action="{{ route('admin.complaints.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-6">
                <div>
                    <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">🔍 Pencarian</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Nomor tiket, nama, atau subjek..." class="w-full px-4 py-3 bg-white border-2 border-gray-300 rounded-xl text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-[#14213d] focus:ring-opacity-20 focus:border-[#14213d] transition-all duration-300 shadow-sm hover:shadow-md">
                </div>
                <div>
                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">📊 Status</label>
                    <select name="status" id="status" class="w-full px-4 py-3 bg-white border-2 border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-4 focus:ring-[#14213d] focus:ring-opacity-20 focus:border-[#14213d] transition-all duration-300 shadow-sm hover:shadow-md">
                        <option value="">Semua Status</option>
                        <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>🟡 Terbuka</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>🔵 Sedang Diproses</option>
                        <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>🟢 Selesai</option>
                        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>⚫ Ditutup</option>
                    </select>
                </div>
                <div>
                    <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">📂 Kategori</label>
                    <select name="category" id="category" class="w-full px-4 py-3 bg-white border-2 border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-4 focus:ring-[#14213d] focus:ring-opacity-20 focus:border-[#14213d] transition-all duration-300 shadow-sm hover:shadow-md">
                        <option value="">Semua Kategori</option>
                        @foreach(App\Http\Controllers\ComplaintController::getCategories() as $key => $value)
                            <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="priority" class="block text-sm font-semibold text-gray-700 mb-2">⚡ Prioritas</label>
                    <select name="priority" id="priority" class="w-full px-4 py-3 bg-white border-2 border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-4 focus:ring-[#14213d] focus:ring-opacity-20 focus:border-[#14213d] transition-all duration-300 shadow-sm hover:shadow-md">
                        <option value="">Semua Prioritas</option>
                        @foreach(App\Http\Controllers\ComplaintController::getPriorities() as $key => $value)
                            <option value="{{ $key }}" {{ request('priority') == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full group inline-flex justify-center items-center px-6 py-3 bg-gradient-to-r from-[#14213d] to-[#1a2b4a] border border-transparent rounded-xl font-bold text-sm text-white hover:from-[#0f1a2e] hover:to-[#162238] focus:outline-none focus:ring-4 focus:ring-[#14213d] focus:ring-opacity-30 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-4 h-4 mr-2 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cari & Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bulk Actions -->
    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl shadow-xl mb-8">
        <div class="p-8">
            <div class="flex justify-between items-center">
                <div>
                    <div class="flex items-center mb-2">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-purple-600 rounded-xl flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-[#14213d]">Daftar Pengaduan</h3>
                    </div>
                    <p class="text-[#14213d] ml-13">Kelola dan pantau semua pengaduan masyarakat</p>
                </div>
                <div class="flex space-x-4">
                    <button type="button" onclick="toggleBulkActions()" class="inline-flex items-center px-4 py-3 bg-gradient-to-r from-gray-500 to-gray-600 border border-transparent rounded-xl font-semibold text-sm text-white hover:from-gray-600 hover:to-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-transparent transition-all duration-300 hover:scale-105 hover:shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Aksi Massal
                    </button>
                    <a href="{{ route('admin.complaints.export') }}{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}" class="inline-flex items-center px-4 py-3 bg-gradient-to-r from-green-500 to-green-600 border border-transparent rounded-xl font-semibold text-sm text-white hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2 focus:ring-offset-transparent transition-all duration-300 hover:scale-105 hover:shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Export
                    </a>
                        </div>
                    </div>

            <!-- Bulk Actions Form -->
            <div id="bulk-actions" class="hidden mt-6 p-6 bg-white rounded-xl shadow-xl border border-gray-200 animate-slideDown">
                <div class="flex items-center mb-4">
                    <div class="bg-gradient-to-r from-[#14213d] to-blue-600 p-2 rounded-lg mr-3">
                        <i class="fas fa-tasks text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900">Aksi Massal</h4>
                        <p class="text-sm text-gray-500">Pilih aksi yang ingin dilakukan pada item terpilih</p>
                    </div>
                </div>
                <form id="bulk-form" method="POST" action="{{ route('admin.complaints.bulk-update') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div>
                            <label for="bulk_status" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-flag mr-2 text-[#14213d]"></i>Ubah Status
                            </label>
                            <select name="status" id="bulk_status" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-300 rounded-xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#14213d] focus:border-[#14213d] transition-all duration-300">
                                <option value="">Pilih Status</option>
                                <option value="open">Terbuka</option>
                                <option value="in_progress">Sedang Diproses</option>
                                <option value="resolved">Selesai</option>
                                <option value="closed">Ditutup</option>
                            </select>
                        </div>
                        <div>
                            <label for="bulk_priority" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-exclamation-triangle mr-2 text-[#14213d]"></i>Ubah Prioritas
                            </label>
                            <select name="priority" id="bulk_priority" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-300 rounded-xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#14213d] focus:border-[#14213d] transition-all duration-300">
                                <option value="">Pilih Prioritas</option>
                                @foreach(App\Http\Controllers\ComplaintController::getPriorities() as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="bulk_assign" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user-tie mr-2 text-[#14213d]"></i>Assign ke
                            </label>
                            <select name="assigned_to" id="bulk_assign" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-300 rounded-xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#14213d] focus:border-[#14213d] transition-all duration-300">
                                <option value="">Pilih Staff</option>
                                @foreach($staffUsers as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                         </div>
                         <div class="flex items-end">
                             <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 bg-gradient-to-r from-[#14213d] to-blue-600 border border-transparent rounded-xl font-semibold text-sm text-white hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-[#14213d] focus:ring-offset-2 focus:ring-offset-transparent transition-all duration-300 hover:scale-105 hover:shadow-lg">
                                 <i class="fas fa-check mr-2"></i>Terapkan
                             </button>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>

     <!-- Complaints Table -->
     <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
         <div class="overflow-x-auto">
             @if($complaints->count() > 0)
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
                                      <i class="fas fa-ticket-alt text-gray-400"></i>
                                      <span>Tiket</span>
                                  </div>
                              </th>
                              <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                  <div class="flex items-center space-x-1">
                                      <i class="fas fa-user text-gray-400"></i>
                                      <span>Pengadu</span>
                                  </div>
                              </th>
                              <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                  <div class="flex items-center space-x-1">
                                      <i class="fas fa-file-alt text-gray-400"></i>
                                      <span>Subjek</span>
                                  </div>
                              </th>
                              <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                  <div class="flex items-center space-x-1">
                                      <i class="fas fa-tags text-gray-400"></i>
                                      <span>Kategori</span>
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
                                      <i class="fas fa-exclamation-triangle text-gray-400"></i>
                                      <span>Prioritas</span>
                                  </div>
                              </th>
                              <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                  <div class="flex items-center space-x-1">
                                      <i class="fas fa-user-tie text-gray-400"></i>
                                      <span>Assigned</span>
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
                                    @foreach($complaints as $complaint)
                                    <tr data-id="{{ $complaint->id }}" class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-300 {{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <input type="checkbox" name="selected_complaints[]" value="{{ $complaint->id }}" class="complaint-checkbox rounded-lg border-2 border-gray-300 text-[#14213d] shadow-sm focus:border-[#14213d] focus:ring focus:ring-[#14213d] focus:ring-opacity-30 transition-all duration-200">
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div class="flex items-center space-x-3">
                                                <div class="bg-[#14213d] p-2 rounded-lg">
                                                    <i class="fas fa-ticket-alt text-white text-sm"></i>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-bold text-gray-900">#{{ $complaint->ticket_number }}</div>
                                                    <div class="text-xs text-gray-500 mt-1">{{ Str::limit($complaint->subject, 30) }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div class="flex items-center space-x-3">
                                                <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-2 rounded-lg">
                                                    <i class="fas fa-user text-white text-sm"></i>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-bold text-gray-900">{{ $complaint->complainant_name }}</div>
                                                    <div class="text-xs text-gray-500 mt-1">{{ $complaint->complainant_email ?? 'Email tidak tersedia' }}</div>
                                                    <div class="text-xs text-gray-500">{{ $complaint->complainant_phone ?? 'Telepon tidak tersedia' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div class="bg-gray-100 px-3 py-2 rounded-lg">
                                                <span class="text-sm font-semibold text-gray-800">{{ Str::limit($complaint->subject, 40) }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div class="bg-gray-100 px-3 py-2 rounded-lg">
                                                <span class="text-sm font-semibold text-gray-800">{{ App\Http\Controllers\ComplaintController::getCategories()[$complaint->category] ?? $complaint->category }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            {!! $complaint->status_badge !!}
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            {!! $complaint->priority_badge !!}
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div class="flex items-center space-x-3">
                                                <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-2 rounded-lg">
                                                    <i class="fas fa-user-tie text-white text-sm"></i>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-bold text-gray-900">{{ $complaint->assignedUser->name ?? 'Belum ditugaskan' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div class="bg-gray-50 px-3 py-2 rounded-lg">
                                                <div class="text-sm font-semibold text-gray-900">{{ $complaint->created_at->format('d/m/Y') }}</div>
                                                <div class="text-xs text-gray-500 mt-1">{{ $complaint->created_at->format('H:i') }} WIB</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-3">
                                                <a href="{{ route('admin.complaints.show', $complaint) }}" class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-xs font-semibold rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 hover:scale-105 shadow-sm" title="Lihat Detail">
                                                    <i class="fas fa-eye mr-1"></i>
                                                    Detail
                                                </a>
                                                @if(auth()->user()->role === 'admin')
                                                    <button onclick="deleteComplaint({{ $complaint->id }})" class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white text-xs font-semibold rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 hover:scale-105 shadow-sm" title="Hapus">
                                                        <i class="fas fa-trash mr-1"></i>
                                                        Hapus
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                        </div>
                    @else
                        <div class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center space-y-4">
                                <div class="bg-gradient-to-br from-gray-100 to-gray-200 p-6 rounded-full">
                                    <i class="fas fa-inbox text-4xl text-gray-400"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada pengaduan ditemukan</h3>
                                    <p class="text-gray-500 mb-4">Belum ada pengaduan yang sesuai dengan filter yang dipilih.</p>
                                    <a href="{{ route('admin.complaints.index') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#14213d] to-blue-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg hover:shadow-xl">
                                        <i class="fas fa-refresh mr-2"></i>
                                        Reset Filter
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Pagination -->
                        @if($complaints->hasPages())
                            <div class="bg-white px-6 py-4 border-t border-gray-200 rounded-b-xl mt-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2 text-sm text-gray-600">
                                        <span>Menampilkan</span>
                                        <span class="font-semibold text-[#14213d]">{{ $complaints->firstItem() ?? 0 }}</span>
                                        <span>sampai</span>
                                        <span class="font-semibold text-[#14213d]">{{ $complaints->lastItem() ?? 0 }}</span>
                                        <span>dari</span>
                                        <span class="font-semibold text-[#14213d]">{{ $complaints->total() }}</span>
                                        <span>pengaduan</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        {{ $complaints->appends(request()->query())->links('pagination::tailwind') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-6 border border-white/20 w-96 shadow-2xl rounded-2xl bg-white/10 backdrop-blur-md">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-gradient-to-br from-red-400 to-red-600 mb-4">
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-4">Hapus Pengaduan</h3>
                <div class="mb-6">
                    <p class="text-blue-100">Apakah Anda yakin ingin menghapus pengaduan ini? Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="flex space-x-4 justify-center">
                    <button id="confirm-delete" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-xl hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2 focus:ring-offset-transparent transition-all duration-300 hover:scale-105">
                        Hapus
                    </button>
                    <button onclick="closeDeleteModal()" class="px-6 py-3 bg-gradient-to-r from-gray-500 to-gray-600 text-white font-semibold rounded-xl hover:from-gray-600 hover:to-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-transparent transition-all duration-300 hover:scale-105">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

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

        let complaintToDelete = null;

        // Toggle bulk actions
        function toggleBulkActions() {
            const bulkActions = document.getElementById('bulk-actions');
            bulkActions.classList.toggle('hidden');
        }

        // Select all checkboxes
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.complaint-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateBulkForm();
        });

        // Update bulk form with selected IDs
        function updateBulkForm() {
            const selectedCheckboxes = document.querySelectorAll('.complaint-checkbox:checked');
            const bulkForm = document.getElementById('bulk-form');

            // Remove existing hidden inputs
            const existingInputs = bulkForm.querySelectorAll('input[name="complaint_ids[]"]');
            existingInputs.forEach(input => input.remove());

            // Add new hidden inputs
            selectedCheckboxes.forEach(checkbox => {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'complaint_ids[]';
                hiddenInput.value = checkbox.value;
                bulkForm.appendChild(hiddenInput);
            });
        }

        // Add event listeners to individual checkboxes
        document.querySelectorAll('.complaint-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateBulkForm);
        });

        // Delete complaint
        function deleteComplaint(id) {
            complaintToDelete = id;
            document.getElementById('delete-modal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('delete-modal').classList.add('hidden');
            complaintToDelete = null;
        }

        document.getElementById('confirm-delete').addEventListener('click', function() {
            if (complaintToDelete) {
                const originalContent = showLoading(this);
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/complaints/${complaintToDelete}`;

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';

                form.appendChild(csrfToken);
                form.appendChild(methodInput);
                document.body.appendChild(form);
                form.submit();
            }
        });

        // Close modal when clicking outside
        document.getElementById('delete-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        // Status update functions
        function getStatusClass(status) {
            const statusClasses = {
                'open': 'bg-yellow-100 text-yellow-800',
                'in_progress': 'bg-blue-100 text-blue-800',
                'resolved': 'bg-green-100 text-green-800',
                'closed': 'bg-red-100 text-red-800'
            };
            return statusClasses[status] || 'bg-gray-100 text-gray-800';
        }

        function getStatusLabel(status) {
            const statusLabels = {
                'open': 'Terbuka',
                'in_progress': 'Diproses',
                'resolved': 'Selesai',
                'closed': 'Ditutup'
            };
            return statusLabels[status] || status;
        }

        function getActionFromStatus(status) {
            const actions = {
                'open': 'in_progress',
                'in_progress': 'resolved',
                'resolved': 'closed',
                'closed': 'open'
            };
            return actions[status] || 'open';
        }

        // Show notification
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Bulk form submission with loading state
        document.getElementById('bulk-form').addEventListener('submit', function(e) {
            const submitButton = this.querySelector('button[type="submit"]');
            const originalContent = showLoading(submitButton);
        });


    </script>
@endpush
@endsection
