@extends('layouts.app')

@section('title', 'Pengajuan Surat - Staff')

@section('content')
<x-slot name="header">
    <div class="bg-gradient-to-r from-green-600 to-green-800 rounded-xl shadow-lg">
        <div class="px-6 py-8">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-3xl font-bold text-white mb-2">
                        <i class="fas fa-envelope-open-text mr-3"></i>Pengajuan Surat
                    </h2>
                    <p class="text-green-100 text-sm opacity-90">Kelola dan pantau semua pengajuan surat masyarakat</p>
                </div>
            </div>
        </div>
    </div>
</x-slot>

<div class="py-8 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
            <div class="stat-card overflow-hidden shadow-lg rounded-xl border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="icon-container w-12 h-12 rounded-xl flex items-center justify-center" style="--icon-from: #3b82f6; --icon-to: #1d4ed8;">
                                <i class="fas fa-file-alt text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Pengajuan</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="stat-card overflow-hidden shadow-lg rounded-xl border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="icon-container w-12 h-12 rounded-xl flex items-center justify-center" style="--icon-from: #f59e0b; --icon-to: #d97706;">
                                <i class="fas fa-clock text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Menunggu</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['pending'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="stat-card overflow-hidden shadow-lg rounded-xl border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="icon-container w-12 h-12 rounded-xl flex items-center justify-center" style="--icon-from: #3b82f6; --icon-to: #1e40af;">
                                <i class="fas fa-cog text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Diproses</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['processing'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="stat-card overflow-hidden shadow-lg rounded-xl border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="icon-container w-12 h-12 rounded-xl flex items-center justify-center" style="--icon-from: #10b981; --icon-to: #047857;">
                                <i class="fas fa-check-circle text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Selesai</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['completed'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="stat-card overflow-hidden shadow-lg rounded-xl border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="icon-container w-12 h-12 rounded-xl flex items-center justify-center" style="--icon-from: #ef4444; --icon-to: #dc2626;">
                                <i class="fas fa-times-circle text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Ditolak</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['rejected'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border border-gray-100">
            <form method="GET" action="{{ route('admin.letters.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                           placeholder="Nama, NIK, atau nomor pengajuan..." 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                </div>
                
                <div>
                    <label for="letter_type" class="block text-sm font-medium text-gray-700 mb-2">Jenis Surat</label>
                    <select name="letter_type" id="letter_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <option value="">Semua Jenis</option>
                        @foreach($letterTypes ?? [] as $key => $label)
                            <option value="{{ $key }}" {{ request('letter_type') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <option value="">Semua Status</option>
                        @foreach($statuses ?? [] as $key => $label)
                            <option value="{{ $key }}" {{ request('status') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                        <i class="fas fa-search mr-2"></i>Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Letters Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Pengajuan Surat</h3>
            </div>
            
            @if($letters && $letters->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengajuan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemohon</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Surat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($letters as $letter)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">#{{ $letter->id }}</p>
                                            <p class="text-xs text-gray-500 font-mono">{{ $letter->request_number ?? 'LTR-' . str_pad($letter->id, 6, '0', STR_PAD_LEFT) }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $letter->applicant_name }}</p>
                                            <p class="text-xs text-gray-500">{{ $letter->applicant_nik }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $letter->letter_type_label }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'processing' => 'bg-blue-100 text-blue-800',
                                                'completed' => 'bg-green-100 text-green-800',
                                                'rejected' => 'bg-red-100 text-red-800'
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$letter->status] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ $letter->status_label }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $letter->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('admin.letters.show', $letter) }}" 
                                           class="text-green-600 hover:text-green-900 mr-3">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($letters->hasPages())
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                        {{ $letters->links() }}
                    </div>
                @endif
            @else
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada pengajuan surat</h3>
                    <p class="mt-1 text-sm text-gray-500">Belum ada pengajuan surat yang masuk.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.stat-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.icon-container {
    background: linear-gradient(135deg, var(--icon-from), var(--icon-to));
    box-shadow: 0 4px 14px 0 rgba(0, 0, 0, 0.15);
}
</style>
@endsection