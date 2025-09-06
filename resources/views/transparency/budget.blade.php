@extends('layouts.app')

@section('title', 'Transparansi Anggaran - Portal Transparansi')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Breadcrumb -->
    <div class="bg-white border-b border-gray-200">
        <div class="container mx-auto px-4 py-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('transparency.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">
                                Portal Transparansi
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Transparansi Anggaran</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-green-600 to-green-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-3xl font-bold mb-4">Transparansi Anggaran</h1>
                <p class="text-xl text-green-100 max-w-3xl mx-auto">
                    Informasi lengkap mengenai anggaran daerah, realisasi, dan laporan keuangan untuk transparansi pengelolaan keuangan publik
                </p>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <!-- Budget Summary -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="text-3xl font-bold text-blue-600 mb-2">{{ $stats['total_budget'] }}</div>
                <div class="text-gray-600">Total Anggaran</div>
                <div class="text-sm text-gray-500 mt-1">Tahun {{ date('Y') }}</div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="text-3xl font-bold text-green-600 mb-2">{{ $stats['realized_budget'] }}</div>
                <div class="text-gray-600">Realisasi</div>
                <div class="text-sm text-gray-500 mt-1">{{ number_format($stats['realization_percentage'], 1) }}%</div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="text-3xl font-bold text-orange-600 mb-2">{{ $stats['remaining_budget'] }}</div>
                <div class="text-gray-600">Sisa Anggaran</div>
                <div class="text-sm text-gray-500 mt-1">{{ number_format(100 - $stats['realization_percentage'], 1) }}%</div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="text-3xl font-bold text-purple-600 mb-2">{{ $stats['total_documents'] }}</div>
                <div class="text-gray-600">Dokumen</div>
                <div class="text-sm text-gray-500 mt-1">Laporan & APBD</div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <form method="GET" action="{{ route('transparency.budget') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Cari dokumen anggaran..." 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                        <select name="year" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Semua Tahun</option>
                            @for($year = date('Y'); $year >= 2020; $year--)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Dokumen</label>
                        <select name="type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Semua Tipe</option>
                            <option value="apbd" {{ request('type') == 'apbd' ? 'selected' : '' }}>APBD</option>
                            <option value="realisasi" {{ request('type') == 'realisasi' ? 'selected' : '' }}>Realisasi</option>
                            <option value="laporan" {{ request('type') == 'laporan' ? 'selected' : '' }}>Laporan Keuangan</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition-colors">
                            <i class="fas fa-search mr-2"></i>Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>

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
</div>
@endsection

@push('styles')
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endpush