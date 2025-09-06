@extends('layouts.app')

@section('title', 'Detail Berita - ' . $news->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Detail Berita</h1>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <a href="{{ route('admin.news.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">
                                Berita
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Detail</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.news.edit', $news->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition-colors duration-200">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <a href="{{ route('admin.news.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-md transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <!-- Main Content -->
            <div class="bg-white rounded-lg shadow-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h6 class="text-lg font-semibold text-[#14213d]">Informasi Berita</h6>
                        @if($news->status === 'published')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i> Published
                            </span>
                        @elseif($news->status === 'draft')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-edit mr-1"></i> Draft
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                <i class="fas fa-clock mr-1"></i> {{ ucfirst($news->status) }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    <!-- Title -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul Berita</label>
                        <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-900">
                            {{ $news->title }}
                        </div>
                    </div>

                    <!-- Slug -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Slug (URL)</label>
                        <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-900">
                            {{ $news->slug }}
                        </div>
                    </div>

                    <!-- Excerpt -->
                    @if($news->excerpt)
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ringkasan</label>
                        <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-700 min-h-[80px]">
                            {{ $news->excerpt }}
                        </div>
                    </div>
                    @endif

                    <!-- Content -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Konten Berita</label>
                        <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-700 min-h-[300px] prose max-w-none">
                            {!! nl2br(e($news->content)) !!}
                        </div>
                    </div>

                    <!-- Featured Image -->
                    @if($news->featured_image)
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama</label>
                        <div class="relative cursor-pointer" onclick="viewFullImage('{{ asset('storage/' . $news->featured_image) }}')">
                            <img src="{{ asset('storage/' . $news->featured_image) }}" alt="{{ $news->title }}" class="rounded-lg border border-gray-200 max-w-xs hover:shadow-lg transition-shadow duration-200">
                            <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center rounded-lg">
                                <i class="fas fa-search-plus text-white text-xl opacity-0 hover:opacity-100 transition-opacity duration-300"></i>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Tags -->
                    @if($news->tags)
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $news->tags) as $tag)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-tag mr-1"></i>
                                    {{ trim($tag) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <!-- Publishing Options -->
            <div class="bg-white rounded-lg shadow-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-[#14213d]">Informasi Publikasi</h6>
                </div>
                <div class="p-6">
                    <!-- Category -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-900">
                            {{ $news->category ?? 'Tidak ada kategori' }}
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-900">
                            {{ ucfirst($news->status) }}
                        </div>
                    </div>

                    <!-- Featured -->
                    <div class="mb-6">
                        <div class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" 
                                   {{ $news->is_featured ? 'checked' : '' }} disabled>
                            <label class="ml-2 text-sm text-gray-700">
                                Berita Unggulan
                            </label>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Berita unggulan akan ditampilkan di halaman utama</p>
                    </div>

                    <!-- Published At -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Publikasi</label>
                        <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-900">
                            {{ $news->published_at ? $news->published_at->format('d M Y, H:i') : 'Belum dipublikasi' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO Settings -->
            <div class="bg-white rounded-lg shadow-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-[#14213d]">Informasi SEO</h6>
                </div>
                <div class="p-6">
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                        <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-900 min-h-[40px]">
                            {{ $news->meta_title ?: $news->title }}
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                        <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-900 min-h-[80px]">
                            {{ $news->meta_description ?: $news->excerpt ?: 'Tidak ada deskripsi' }}
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">URL</label>
                        <div class="flex items-center space-x-2">
                            <input type="text" value="{{ route('news.show', $news->slug) }}" class="flex-1 px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-600 text-sm" readonly>
                            <button onclick="copyUrl('{{ route('news.show', $news->slug) }}')" class="px-3 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 transition-colors duration-200">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-[#14213d]">Aksi Cepat</h6>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <a href="{{ route('admin.news.edit', $news->id) }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-blue-600 text-blue-600 bg-white hover:bg-blue-50 font-medium rounded-md transition-colors duration-200">
                            <i class="fas fa-edit mr-2"></i> Edit Berita
                        </a>
                        <a href="{{ route('news.show', $news->slug) }}" target="_blank" class="w-full inline-flex items-center justify-center px-4 py-2 border border-green-600 text-green-600 bg-white hover:bg-green-50 font-medium rounded-md transition-colors duration-200">
                            <i class="fas fa-external-link-alt mr-2"></i> Lihat di Website
                        </a>
                        <button type="button" onclick="duplicateNews({{ $news->id }})" class="w-full inline-flex items-center justify-center px-4 py-2 border border-orange-600 text-orange-600 bg-white hover:bg-orange-50 font-medium rounded-md transition-colors duration-200">
                            <i class="fas fa-copy mr-2"></i> Duplikasi
                        </button>
                        <button type="button" onclick="deleteNews({{ $news->id }})" class="w-full inline-flex items-center justify-center px-4 py-2 border border-red-600 text-red-600 bg-white hover:bg-red-50 font-medium rounded-md transition-colors duration-200">
                            <i class="fas fa-trash mr-2"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="bg-white rounded-lg shadow-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-[#14213d]">Statistik</h6>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-eye text-blue-600 mr-3"></i>
                                <span class="text-sm font-medium text-gray-700">Total Views</span>
                            </div>
                            <span class="text-lg font-bold text-blue-600" id="totalViews">{{ $news->views ?? 0 }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-day text-green-600 mr-3"></i>
                                <span class="text-sm font-medium text-gray-700">Hari yang Lalu</span>
                            </div>
                            <span class="text-lg font-bold text-green-600">{{ $news->created_at->diffInDays() }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-clock text-purple-600 mr-3"></i>
                                <span class="text-sm font-medium text-gray-700">Tanggal Publikasi</span>
                            </div>
                            <span class="text-sm font-bold text-purple-600">{{ $news->published_at ? $news->published_at->format('d/m/Y') : 'Belum dipublikasi' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Technical Info -->
            <div class="bg-white rounded-lg shadow-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-[#14213d]">Informasi Teknis</h6>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 mb-1">ID</label>
                            <p class="text-lg font-bold text-gray-900">{{ $news->id }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                            <p class="text-sm text-gray-900 break-all">{{ $news->slug }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Dibuat</label>
                            <p class="text-sm text-gray-900">{{ $news->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Diupdate</label>
                            <p class="text-sm text-gray-900">{{ $news->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                        @if($news->published_at)
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Dipublikasi</label>
                            <p class="text-sm text-gray-900">{{ $news->published_at->format('d M Y, H:i') }}</p>
                        </div>
                        @endif
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
                            <p class="text-sm text-gray-900">{{ $news->author->name ?? 'Unknown' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Form -->
<form id="deleteForm" action="{{ route('admin.news.destroy', $news->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<!-- Duplicate Form -->
<form id="duplicateForm" action="{{ route('admin.news.duplicate', $news->id) }}" method="POST" style="display: none;">
    @csrf
</form>
@endsection

@push('scripts')
<script>
// Delete news function
function deleteNews(newsId) {
    Swal.fire({
        title: 'Hapus Berita?',
        text: 'Berita yang dihapus tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteForm').submit();
        }
    });
}

// Duplicate news function
function duplicateNews(newsId) {
    Swal.fire({
        title: 'Duplikasi Berita?',
        text: 'Berita akan diduplikasi sebagai draft',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Duplikasi!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('duplicateForm').submit();
        }
    });
}

// Copy URL function
function copyUrl(url) {
    navigator.clipboard.writeText(url).then(() => {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'URL berhasil disalin!',
            showConfirmButton: false,
            timer: 3000
        });
    }).catch(() => {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = url;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'URL berhasil disalin!',
            showConfirmButton: false,
            timer: 3000
        });
    });
}

// View full image function
function viewFullImage(imageSrc) {
    Swal.fire({
        imageUrl: imageSrc,
        imageAlt: 'Gambar Berita',
        showConfirmButton: false,
        showCloseButton: true,
        imageWidth: '90%',
        imageHeight: 'auto',
        customClass: {
            image: 'rounded-lg'
        }
    });
}
</script>
@endpush

@push('styles')
<style>
/* Content Styling */
.content-body {
    line-height: 1.8;
    font-size: 1.1rem;
    color: #2c3e50;
}

.content-body img {
    max-width: 100%;
    height: auto;
    border-radius: 12px;
    margin: 1.5rem 0;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.content-body img:hover {
    transform: scale(1.02);
}

.content-body p {
    margin-bottom: 1.2rem;
    text-align: justify;
}

.content-body h1,
.content-body h2,
.content-body h3,
.content-body h4,
.content-body h5,
.content-body h6 {
    margin-top: 2.5rem;
    margin-bottom: 1.2rem;
    color: #2c3e50;
    font-weight: 600;
}

.content-body ul,
.content-body ol {
    margin-bottom: 1.2rem;
    padding-left: 2rem;
}

.content-body blockquote {
    border-left: 4px solid #007bff;
    padding: 1.5rem;
    margin: 2rem 0;
    font-style: italic;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

/* Responsive Improvements */
@media (max-width: 768px) {
    .display-5 {
        font-size: 1.8rem;
    }
    
    .meta-info .row > div {
        margin-bottom: 1rem;
    }
    
    .stat-item {
        margin-bottom: 1rem;
    }
    
    .gap-2 {
        gap: 0.75rem;
    }
}

/* Scrollbar Styling */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>
@endpush