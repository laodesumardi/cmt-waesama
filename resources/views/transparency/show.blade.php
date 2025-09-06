@extends('layouts.app')

@section('title', $transparency->title . ' - Portal Transparansi')

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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ Str::limit($transparency->title, 50) }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Document Header -->
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-3">
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">
                                    {{ $transparency->category_display }}
                                </span>
                                <span class="px-3 py-1 bg-gray-100 text-gray-800 text-sm font-medium rounded-full">
                                    {{ $transparency->type_display }}
                                </span>
                                @if($transparency->is_featured)
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-medium rounded-full">
                                        <i class="fas fa-star mr-1"></i>Unggulan
                                    </span>
                                @endif
                            </div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $transparency->title }}</h1>
                            <div class="flex items-center space-x-6 text-sm text-gray-500">
                                <span><i class="fas fa-calendar mr-2"></i>{{ $transparency->period_display }}</span>
                                <span><i class="fas fa-eye mr-2"></i>{{ number_format($transparency->views) }} views</span>
                                @if($transparency->files)
                                    <span><i class="fas fa-download mr-2"></i>{{ number_format($transparency->downloads) }} downloads</span>
                                @endif
                                <span><i class="fas fa-clock mr-2"></i>{{ $transparency->published_at->format('d M Y H:i') }}</span>
                            </div>
                        </div>
                        @if($transparency->files)
                            <div class="ml-4">
                                <a href="{{ route('transparency.download', $transparency) }}" 
                                   class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors inline-flex items-center">
                                    <i class="fas fa-download mr-2"></i>Download Dokumen
                                </a>
                            </div>
                        @endif
                    </div>
                    
                    @if($transparency->amount)
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-green-800">Nilai Anggaran</h3>
                                    <div class="text-lg font-bold text-green-900">{{ $transparency->formatted_amount }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Document Description -->
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Deskripsi</h2>
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br(e($transparency->description)) !!}
                    </div>
                </div>

                <!-- Document Data (if available) -->
                @if($transparency->data)
                    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Data Terkait</h2>
                        <div class="overflow-x-auto">
                            @php
                                $data = json_decode($transparency->data, true);
                            @endphp
                            
                            @if(is_array($data) && count($data) > 0)
                                @if(isset($data[0]) && is_array($data[0]))
                                    <!-- Tabular data -->
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                @foreach(array_keys($data[0]) as $header)
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        {{ ucfirst(str_replace('_', ' ', $header)) }}
                                                    </th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($data as $row)
                                                <tr>
                                                    @foreach($row as $cell)
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                            {{ $cell }}
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <!-- Key-value data -->
                                    <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                        @foreach($data as $key => $value)
                                            <div>
                                                <dt class="text-sm font-medium text-gray-500">{{ ucfirst(str_replace('_', ' ', $key)) }}</dt>
                                                <dd class="mt-1 text-sm text-gray-900">{{ is_array($value) ? json_encode($value) : $value }}</dd>
                                            </div>
                                        @endforeach
                                    </dl>
                                @endif
                            @else
                                <p class="text-gray-500">Data tidak tersedia dalam format yang dapat ditampilkan.</p>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Files List -->
                @if($transparency->files)
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">File Lampiran</h2>
                        @php
                            $files = json_decode($transparency->files, true);
                        @endphp
                        
                        @if(is_array($files) && count($files) > 0)
                            <div class="space-y-3">
                                @foreach($files as $file)
                                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                @php
                                                    $extension = pathinfo($file['name'] ?? '', PATHINFO_EXTENSION);
                                                    $iconClass = match(strtolower($extension)) {
                                                        'pdf' => 'fas fa-file-pdf text-red-500',
                                                        'doc', 'docx' => 'fas fa-file-word text-blue-500',
                                                        'xls', 'xlsx' => 'fas fa-file-excel text-green-500',
                                                        'ppt', 'pptx' => 'fas fa-file-powerpoint text-orange-500',
                                                        'jpg', 'jpeg', 'png', 'gif' => 'fas fa-file-image text-purple-500',
                                                        default => 'fas fa-file text-gray-500'
                                                    };
                                                @endphp
                                                <i class="{{ $iconClass }} text-2xl"></i>
                                            </div>
                                            <div class="ml-4">
                                                <h3 class="text-sm font-medium text-gray-900">{{ $file['name'] ?? 'File' }}</h3>
                                                @if(isset($file['size']))
                                                    <p class="text-sm text-gray-500">{{ number_format($file['size'] / 1024, 2) }} KB</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex space-x-2">
                                            @if(isset($file['url']))
                                                <a href="{{ $file['url'] }}" target="_blank" 
                                                   class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors text-sm">
                                                    <i class="fas fa-eye mr-1"></i>Lihat
                                                </a>
                                            @endif
                                            <a href="{{ route('transparency.download', $transparency) }}" 
                                               class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition-colors text-sm">
                                                <i class="fas fa-download mr-1"></i>Download
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500">Tidak ada file lampiran.</p>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Document Info -->
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Dokumen</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Kategori</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $transparency->category_display }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tipe</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $transparency->type_display }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Periode</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $transparency->period_display }}</dd>
                        </div>
                        @if($transparency->amount)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Nilai</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-semibold text-green-600">{{ $transparency->formatted_amount }}</dd>
                            </div>
                        @endif
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Dipublikasikan</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $transparency->published_at->format('d M Y H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Dilihat</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ number_format($transparency->views) }} kali</dd>
                        </div>
                        @if($transparency->files)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Diunduh</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ number_format($transparency->downloads) }} kali</dd>
                            </div>
                        @endif
                    </dl>
                </div>

                <!-- Share -->
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Bagikan</h3>
                    <div class="flex space-x-3">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                           target="_blank" 
                           class="flex-1 bg-blue-600 text-white text-center py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($transparency->title) }}" 
                           target="_blank" 
                           class="flex-1 bg-sky-500 text-white text-center py-2 px-4 rounded-md hover:bg-sky-600 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($transparency->title . ' - ' . request()->fullUrl()) }}" 
                           target="_blank" 
                           class="flex-1 bg-green-500 text-white text-center py-2 px-4 rounded-md hover:bg-green-600 transition-colors">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <button onclick="copyToClipboard('{{ request()->fullUrl() }}')" 
                                class="flex-1 bg-gray-500 text-white text-center py-2 px-4 rounded-md hover:bg-gray-600 transition-colors">
                            <i class="fas fa-link"></i>
                        </button>
                    </div>
                </div>

                <!-- Related Documents -->
                @if($related->count() > 0)
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Dokumen Terkait</h3>
                        <div class="space-y-4">
                            @foreach($related as $item)
                                <div class="border-b border-gray-200 pb-4 last:border-b-0 last:pb-0">
                                    <h4 class="font-medium text-gray-900 mb-1">
                                        <a href="{{ route('transparency.show', $item) }}" class="hover:text-blue-600">
                                            {{ Str::limit($item->title, 60) }}
                                        </a>
                                    </h4>
                                    <div class="flex items-center space-x-2 text-xs text-gray-500">
                                        <span class="px-2 py-1 bg-gray-100 rounded">{{ $item->category_display }}</span>
                                        <span>{{ $item->published_at->format('M Y') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success message
        const toast = document.createElement('div');
        toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
        toast.textContent = 'Link berhasil disalin!';
        document.body.appendChild(toast);
        
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 3000);
    }).catch(function(err) {
        console.error('Could not copy text: ', err);
    });
}
</script>
@endpush