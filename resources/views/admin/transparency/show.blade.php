@extends('layouts.app')

@section('title', 'Detail Data Transparansi')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div class="mb-4 sm:mb-0">
            <nav class="flex mb-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-[#14213d] inline-flex items-center">
                            <i class="fas fa-home w-4 h-4 mr-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <a href="{{ route('admin.transparency.index') }}" class="text-gray-700 hover:text-[#14213d]">Transparansi</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="text-gray-500">Detail</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-2xl font-bold text-[#14213d]">Detail Data Transparansi</h1>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('transparency.show', $transparency) }}" target="_blank" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                <i class="fas fa-external-link-alt mr-2"></i> Lihat Publik
            </a>
            <a href="{{ route('admin.transparency.edit', $transparency) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <a href="{{ route('admin.transparency.index') }}" class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#14213d]">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <!-- Main Content -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
                <div class="bg-[#14213d] text-white px-6 py-4">
                    <div class="flex flex-wrap items-center justify-between">
                        <h2 class="text-xl font-semibold text-white mb-2 lg:mb-0">{{ $transparency->title }}</h2>
                        <div class="flex flex-wrap gap-2">
                            @if($transparency->is_featured)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-star mr-1"></i> Unggulan
                                </span>
                            @endif
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $transparency->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $transparency->status === 'published' ? 'Dipublikasikan' : 'Draft' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">{{ $categories[$transparency->category] ?? $transparency->category }}</span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tipe</label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">{{ $types[$transparency->type] ?? $transparency->type }}</span>
                        </div>
                    </div>

                    @if($transparency->description)
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                            <div class="bg-gray-50 px-4 py-3 rounded-md text-gray-900">
                                {!! nl2br(e($transparency->description)) !!}
                            </div>
                        </div>
                    @endif

                    @if($transparency->period_start || $transparency->period_end)
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                            <p class="text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                @if($transparency->period_start && $transparency->period_end)
                                    {{ $transparency->period_start->format('d/m/Y') }} - {{ $transparency->period_end->format('d/m/Y') }}
                                @elseif($transparency->period_start)
                                    Mulai: {{ $transparency->period_start->format('d/m/Y') }}
                                @elseif($transparency->period_end)
                                    Sampai: {{ $transparency->period_end->format('d/m/Y') }}
                                @endif
                            </p>
                        </div>
                    @endif

                    @if($transparency->amount)
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nilai/Jumlah</label>
                            <p class="text-2xl font-semibold text-green-600 bg-gray-50 px-3 py-2 rounded-md">Rp {{ number_format($transparency->amount, 0, ',', '.') }}</p>
                        </div>
                    @endif

                    @if($transparency->data)
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Data Terstruktur</label>
                            <div class="bg-gray-50 p-4 rounded-md">
                                <pre class="text-sm text-gray-900 overflow-x-auto"><code>{{ json_encode(json_decode($transparency->data), JSON_PRETTY_PRINT) }}</code></pre>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Files Section -->
            @if($transparency->files)
                @php
                    $files = json_decode($transparency->files, true) ?? [];
                @endphp
                @if(count($files) > 0)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
                        <div class="bg-[#14213d] text-white px-6 py-4">
                            <h3 class="text-lg font-semibold text-white">
                                <i class="fas fa-file mr-2"></i> File Terlampir ({{ count($files) }})
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($files as $file)
                                    <div class="border border-gray-200 rounded-lg p-4 h-full">
                                        <div class="flex justify-between items-start mb-3">
                                            <div class="flex-grow">
                                                <h6 class="text-sm font-medium text-gray-900 mb-1">{{ $file['name'] }}</h6>
                                                <p class="text-xs text-gray-500">
                                                    {{ number_format($file['size'] / 1024, 2) }} KB
                                                </p>
                                            </div>
                                            <div class="flex-shrink-0 ml-3">
                                                @php
                                                    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                                                    $iconClass = match($extension) {
                                                        'pdf' => 'fas fa-file-pdf text-red-500',
                                                        'doc', 'docx' => 'fas fa-file-word text-blue-500',
                                                        'xls', 'xlsx' => 'fas fa-file-excel text-green-500',
                                                        'jpg', 'jpeg', 'png' => 'fas fa-file-image text-blue-400',
                                                        default => 'fas fa-file text-gray-500'
                                                    };
                                                @endphp
                                                <i class="{{ $iconClass }} text-2xl"></i>
                                            </div>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ asset('storage/' . $file['path']) }}" target="_blank" 
                                               class="flex-1 inline-flex items-center justify-center px-3 py-2 border border-[#14213d] text-sm leading-4 font-medium rounded-md text-[#14213d] bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#14213d]">
                                                <i class="fas fa-eye mr-1"></i> Lihat
                                            </a>
                                            <a href="{{ route('transparency.download', ['transparency' => $transparency, 'file' => basename($file['path'])]) }}" 
                                               class="flex-1 inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                <i class="fas fa-download mr-1"></i> Download
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            <!-- Activity Log -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-[#14213d] text-white px-6 py-4">
                    <h3 class="text-lg font-semibold text-white">
                        <i class="fas fa-history mr-2"></i> Riwayat Aktivitas
                    </h3>
                </div>
                <div class="p-6">
                    <div class="flow-root">
                        <ul class="-mb-8">
                            <li>
                                <div class="relative pb-8">
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                                <i class="fas fa-plus text-white text-sm"></i>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">Data Dibuat</p>
                                                <p class="text-sm text-gray-500">{{ $transparency->created_at->format('d/m/Y H:i:s') }}</p>
                                                <p class="text-xs text-gray-400">oleh {{ $transparency->creator?->name ?? 'System' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            
                            @if($transparency->updated_at != $transparency->created_at)
                            <li>
                                <div class="relative pb-8">
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-yellow-500 flex items-center justify-center ring-8 ring-white">
                                                <i class="fas fa-edit text-white text-sm"></i>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">Data Diperbarui</p>
                                                <p class="text-sm text-gray-500">{{ $transparency->updated_at->format('d/m/Y H:i:s') }}</p>
                                                <p class="text-xs text-gray-400">oleh {{ $transparency->updater?->name ?? 'System' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endif
                            
                            @if($transparency->published_at)
                            <li>
                                <div class="relative">
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-[#14213d] flex items-center justify-center ring-8 ring-white">
                                                <i class="fas fa-globe text-white text-sm"></i>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">Data Dipublikasikan</p>
                                                <p class="text-sm text-gray-500">{{ $transparency->published_at->format('d/m/Y H:i:s') }}</p>
                                                <p class="text-xs text-gray-400">Tersedia untuk publik</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <!-- Statistics Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
                <div class="bg-[#14213d] text-white px-6 py-4">
                    <h3 class="text-lg font-semibold text-white">
                        <i class="fas fa-chart-bar mr-2"></i> Statistik
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center border-r border-gray-200">
                            <div class="text-2xl font-bold text-[#14213d]">{{ number_format($transparency->views) }}</div>
                            <div class="text-sm text-gray-500">Views</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">{{ number_format($transparency->downloads) }}</div>
                            <div class="text-sm text-gray-500">Downloads</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Information Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
                <div class="bg-[#14213d] text-white px-6 py-4">
                    <h3 class="text-lg font-semibold text-white">
                        <i class="fas fa-info-circle mr-2"></i> Informasi
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="font-medium text-gray-700">ID:</span>
                            <span class="text-gray-900">{{ $transparency->id }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="font-medium text-gray-700">Slug:</span>
                            <code class="bg-gray-100 px-2 py-1 rounded text-sm">{{ $transparency->slug }}</code>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="font-medium text-gray-700">Status:</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $transparency->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $transparency->status === 'published' ? 'Dipublikasikan' : 'Draft' }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="font-medium text-gray-700">Unggulan:</span>
                            @if($transparency->is_featured)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-star mr-1"></i> Ya
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Tidak</span>
                            @endif
                        </div>
                        @if($transparency->files)
                            <div class="flex justify-between items-center py-2">
                                <span class="font-medium text-gray-700">File:</span>
                                <span class="text-gray-900">{{ count(json_decode($transparency->files, true) ?? []) }} file</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
                <div class="bg-[#14213d] text-white px-6 py-4">
                    <h3 class="text-lg font-semibold text-white">
                        <i class="fas fa-bolt mr-2"></i> Aksi Cepat
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        @if($transparency->status === 'draft')
                            <form method="POST" action="{{ route('admin.transparency.update', $transparency) }}" class="w-full">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="published">
                                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" 
                                        onclick="return confirm('Publikasikan data ini?')">
                                    <i class="fas fa-eye mr-2"></i> Publikasikan
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.transparency.update', $transparency) }}" class="w-full">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="draft">
                                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" 
                                        onclick="return confirm('Ubah ke draft? Data tidak akan tampil di publik.')">
                                    <i class="fas fa-eye-slash mr-2"></i> Jadikan Draft
                                </button>
                            </form>
                        @endif
                        
                        <form method="POST" action="{{ route('admin.transparency.update', $transparency) }}" class="w-full">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="is_featured" value="{{ $transparency->is_featured ? '0' : '1' }}">
                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border {{ $transparency->is_featured ? 'border-yellow-300 text-yellow-700 bg-white hover:bg-yellow-50' : 'border-transparent text-white bg-yellow-600 hover:bg-yellow-700' }} text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                <i class="fas fa-star mr-2"></i> 
                                {{ $transparency->is_featured ? 'Hapus dari Unggulan' : 'Jadikan Unggulan' }}
                            </button>
                        </form>
                        
                        <a href="{{ route('admin.transparency.edit', $transparency) }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-[#14213d] hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#14213d]">
                            <i class="fas fa-edit mr-2"></i> Edit Data
                        </a>
                        
                        <button type="button" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="document.getElementById('deleteModal').classList.remove('hidden')">
                            <i class="fas fa-trash mr-2"></i> Hapus Data
                        </button>
                    </div>
                </div>
            </div>

            <!-- Share Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-[#14213d] text-white px-6 py-4">
                    <h3 class="text-lg font-semibold text-white">
                        <i class="fas fa-share-alt mr-2"></i> Bagikan
                    </h3>
                </div>
                <div class="p-6">
                    <div class="flex mb-3">
                        <input type="text" class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-[#14213d] focus:border-transparent" id="shareUrl" 
                               value="{{ route('transparency.show', $transparency) }}" readonly>
                        <button class="px-4 py-2 border border-l-0 border-gray-300 rounded-r-md bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-[#14213d] focus:border-transparent" type="button" onclick="copyUrl()">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                    <p class="text-sm text-gray-500">URL publik untuk data transparansi ini</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Konfirmasi Hapus</h3>
                <button type="button" class="text-gray-400 hover:text-gray-600" onclick="document.getElementById('deleteModal').classList.add('hidden')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500 mb-3">
                    Apakah Anda yakin ingin menghapus data transparansi "{{ $transparency->title }}"?
                </p>
                <div class="bg-yellow-50 border border-yellow-200 rounded-md p-3">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                <strong>Peringatan:</strong> Tindakan ini tidak dapat dibatalkan. Semua file terkait juga akan dihapus.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end px-4 py-3 space-x-3">
                <button type="button" class="px-4 py-2 bg-gray-300 text-gray-700 text-base font-medium rounded-md shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300" onclick="document.getElementById('deleteModal').classList.add('hidden')">
                    Batal
                </button>
                <form method="POST" action="{{ route('admin.transparency.destroy', $transparency) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <i class="fas fa-trash mr-2"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Custom styles for better visual hierarchy */
.timeline-connector {
    @apply absolute left-4 top-8 w-0.5 bg-gray-200;
    height: calc(100% - 2rem);
}

.file-icon {
    @apply transition-colors duration-200;
}

.file-card:hover .file-icon {
    @apply scale-110;
}

.stats-card {
    @apply transition-all duration-200 hover:shadow-xl;
}

.action-button {
    @apply transition-all duration-200 transform hover:scale-105;
}
</style>
@endpush

@push('scripts')
<script>
function copyUrl() {
    const urlInput = document.getElementById('shareUrl');
    urlInput.select();
    urlInput.setSelectionRange(0, 99999);
    
    try {
        document.execCommand('copy');
        
        // Show feedback
        const button = event.target;
        const originalHTML = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check"></i>';
        button.classList.remove('bg-gray-50', 'hover:bg-gray-100');
        button.classList.add('bg-green-100', 'text-green-600');
        
        setTimeout(() => {
            button.innerHTML = originalHTML;
            button.classList.remove('bg-green-100', 'text-green-600');
            button.classList.add('bg-gray-50', 'hover:bg-gray-100');
        }, 2000);
        
        // Show toast notification
        showToast('URL berhasil disalin!', 'success');
    } catch (err) {
        showToast('Gagal menyalin URL', 'error');
    }
}

function showToast(message, type) {
    const toast = document.createElement('div');
    toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300 transform translate-x-full ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    }`;
    toast.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-${type === 'success' ? 'check' : 'exclamation-triangle'} mr-2"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.classList.remove('translate-x-full');
    }, 100);
    
    // Animate out and remove
    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 3000);
}
</script>
@endpush