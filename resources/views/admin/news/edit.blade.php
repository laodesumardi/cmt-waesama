@extends('layouts.app')

@section('title', 'Edit Berita')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Edit Berita</h1>
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
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <a href="{{ route('admin.news.show', $news) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">
                                {{ Str::limit($news->title, 30) }}
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Edit</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.news.show', $news) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition-colors duration-200">
                <i class="fas fa-eye mr-2"></i> Lihat
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
                        <h6 class="text-lg font-semibold text-[#14213d]">Edit Informasi Berita</h6>
                        <div class="flex gap-2">
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
                            @if($news->is_featured)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-star mr-1"></i> Featured
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <form id="newsForm" method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Title -->
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Berita <span class="text-red-500">*</span></label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror" 
                                   id="title" name="title" value="{{ old('title', $news->title) }}" 
                                   placeholder="Masukkan judul berita..." required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div class="mb-6">
                            <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug (URL)</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('slug') border-red-500 @enderror" 
                                   id="slug" name="slug" value="{{ old('slug', $news->slug) }}" 
                                   placeholder="Auto generate dari judul...">
                            <p class="mt-1 text-sm text-gray-500">Kosongkan untuk auto generate dari judul</p>
                            @error('slug')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Excerpt -->
                        <div class="mb-6">
                            <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Ringkasan</label>
                            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('excerpt') border-red-500 @enderror" 
                                      id="excerpt" name="excerpt" rows="3" 
                                      placeholder="Ringkasan singkat berita...">{{ old('excerpt', $news->excerpt) }}</textarea>
                            <p class="mt-1 text-sm text-gray-500">Maksimal 200 karakter</p>
                            @error('excerpt')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-6">
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Konten Berita <span class="text-red-500">*</span></label>
                            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('content') border-red-500 @enderror" 
                                      id="content" name="content" rows="15" required>{{ old('content', $news->content) }}</textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Current Featured Image -->
                        @if($news->featured_image)
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini</label>
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $news->featured_image) }}" 
                                         alt="{{ $news->title }}" class="rounded-lg border border-gray-200 max-w-xs">
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                                           id="remove_image" name="remove_image" value="1">
                                    <label class="ml-2 block text-sm text-gray-700" for="remove_image">
                                        Hapus gambar ini
                                    </label>
                                </div>
                            </div>
                        @endif

                        <!-- Featured Image -->
                        <div class="mb-6">
                            <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $news->featured_image ? 'Ganti Gambar Utama' : 'Gambar Utama' }}
                            </label>
                            <input type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('featured_image') border-red-500 @enderror" 
                                   id="featured_image" name="featured_image" accept="image/*">
                            <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                            @error('featured_image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            
                            <!-- Image Preview -->
                            <div id="imagePreview" class="mt-3 hidden">
                                <img id="preview" src="" alt="Preview" class="rounded-lg border border-gray-200 max-w-xs">
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-6">
                            <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-md transition-colors duration-200" onclick="history.back()">
                                <i class="fas fa-times mr-2"></i> Batal
                            </button>
                            <button type="submit" name="action" value="draft" class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-md transition-colors duration-200">
                                <i class="fas fa-save mr-2"></i> Simpan sebagai Draft
                            </button>
                            <button type="submit" name="action" value="publish" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition-colors duration-200">
                                <i class="fas fa-paper-plane mr-2"></i> Publikasikan
                            </button>
                        </div>
                    </form>
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
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('category') border-red-500 @enderror" 
                                id="category" name="category" form="newsForm" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $key => $value)
                                <option value="{{ $key }}" {{ old('category', $news->category) == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-6">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror" 
                                id="status" name="status" form="newsForm">
                            @foreach($statuses as $key => $value)
                                <option value="{{ $key }}" {{ old('status', $news->status) == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Featured -->
                    <div class="mb-6">
                        <div class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                                   id="is_featured" name="is_featured" value="1" 
                                   form="newsForm" {{ old('is_featured', $news->is_featured) ? 'checked' : '' }}>
                            <label class="ml-2 block text-sm text-gray-700" for="is_featured">
                                Jadikan Berita Unggulan
                            </label>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Berita unggulan akan ditampilkan di halaman utama</p>
                    </div>

                    <!-- Published At -->
                    <div class="mb-6">
                        <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Publikasi</label>
                        <input type="datetime-local" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('published_at') border-red-500 @enderror" 
                               id="published_at" name="published_at" 
                               value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') }}" form="newsForm">
                        <p class="mt-1 text-sm text-gray-500">Kosongkan untuk menggunakan waktu sekarang</p>
                        @error('published_at')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Technical Information -->
            <div class="bg-white rounded-lg shadow-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-[#14213d]">Informasi Teknis</h6>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4 text-center mb-4">
                        <div class="border-r border-gray-200 pr-3">
                            <h5 class="text-xl font-bold text-blue-600 mb-1">{{ number_format($news->views) }}</h5>
                            <small class="text-gray-500">Total Views</small>
                        </div>
                        <div>
                            <h5 class="text-xl font-bold text-blue-500 mb-1">{{ $news->created_at->diffForHumans() }}</h5>
                            <small class="text-gray-500">Dibuat</small>
                        </div>
                    </div>
                    
                    <div class="text-sm text-gray-600 space-y-2">
                        <div class="flex justify-between">
                            <span class="font-medium">ID:</span>
                            <span>#{{ $news->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Slug:</span>
                            <span class="truncate max-w-[150px]">{{ $news->slug }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Dibuat:</span>
                            <span>{{ $news->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Diupdate:</span>
                            <span>{{ $news->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO Settings -->
            <div class="bg-white rounded-lg shadow-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-[#14213d]">Pengaturan SEO</h6>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="meta_title" name="meta_title" 
                               value="{{ old('meta_title', $news->meta_title ?? '') }}" form="newsForm" maxlength="60">
                        <small class="text-sm text-gray-500 mt-1 block">Maksimal 60 karakter. Kosongkan untuk menggunakan judul berita</small>
                    </div>

                    <div class="mb-4">
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="meta_description" name="meta_description" 
                                  rows="3" form="newsForm" maxlength="160">{{ old('meta_description', $news->meta_description ?? '') }}</textarea>
                        <small class="text-sm text-gray-500 mt-1 block">Maksimal 160 karakter. Kosongkan untuk menggunakan ringkasan</small>
                    </div>

                    <div class="mb-4">
                        <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="tags" name="tags" 
                               value="{{ old('tags', $news->tags ?? '') }}" form="newsForm" 
                               placeholder="tag1, tag2, tag3">
                        <small class="text-sm text-gray-500 mt-1 block">Pisahkan dengan koma</small>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-[#14213d]">Aksi Cepat</h6>
                </div>
                <div class="p-6">
                    <div class="space-y-2">
                        <button type="button" class="w-full inline-flex items-center justify-center px-4 py-2 border border-blue-300 text-blue-700 bg-blue-50 hover:bg-blue-100 font-medium rounded-md transition-colors duration-200" onclick="previewNews()">
                            <i class="fas fa-eye mr-2"></i> Preview Berita
                        </button>
                        <button type="button" class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 bg-gray-50 hover:bg-gray-100 font-medium rounded-md transition-colors duration-200" onclick="saveAsDraft()">
                            <i class="fas fa-save mr-2"></i> Simpan Draft
                        </button>
                        <button type="button" class="w-full inline-flex items-center justify-center px-4 py-2 border border-blue-300 text-blue-700 bg-blue-50 hover:bg-blue-100 font-medium rounded-md transition-colors duration-200" onclick="duplicateNews()">
                            <i class="fas fa-copy mr-2"></i> Duplikasi Berita
                        </button>
                        <hr class="my-3 border-gray-200">
                        <button type="button" class="w-full inline-flex items-center justify-center px-4 py-2 border border-red-300 text-red-700 bg-red-50 hover:bg-red-100 font-medium rounded-md transition-colors duration-200" onclick="deleteNews()">
                            <i class="fas fa-trash mr-2"></i> Hapus Berita
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview -->
<div id="previewModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-4xl shadow-lg rounded-md bg-white">
        <div class="flex items-center justify-between pb-3 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Preview Berita</h3>
            <button type="button" class="text-gray-400 hover:text-gray-600" onclick="closePreview()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="pt-4">
            <div id="previewContent" class="prose max-w-none">
                <!-- Preview content will be loaded here -->
            </div>
        </div>
        <div class="flex justify-end pt-4 border-t border-gray-200 mt-4">
            <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors duration-200" onclick="closePreview()">Tutup</button>
        </div>
    </div>
</div>

<!-- Delete Form -->
<form id="deleteForm" method="POST" action="{{ route('admin.news.destroy', $news) }}" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<!-- Duplicate Form -->
<form id="duplicateForm" method="POST" action="{{ route('admin.news.duplicate', $news) }}" style="display: none;">
    @csrf
</form>
@endsection

@push('scripts')
<script>
// Simple content editor initialization
$(document).ready(function() {
    // Add basic formatting toolbar for content textarea
    const contentTextarea = $('#content');
    
    // Create simple toolbar
    const toolbar = $(`
        <div class="content-toolbar mb-2">
            <div class="btn-group btn-group-sm" role="group">
                <button type="button" class="btn btn-outline-secondary" onclick="formatText('bold')" title="Bold">
                    <i class="fas fa-bold"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary" onclick="formatText('italic')" title="Italic">
                    <i class="fas fa-italic"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary" onclick="formatText('underline')" title="Underline">
                    <i class="fas fa-underline"></i>
                </button>
            </div>
            <div class="btn-group btn-group-sm ml-2" role="group">
                <button type="button" class="btn btn-outline-secondary" onclick="formatText('h2')" title="Heading 2">
                    <i class="fas fa-heading"></i> H2
                </button>
                <button type="button" class="btn btn-outline-secondary" onclick="formatText('h3')" title="Heading 3">
                    <i class="fas fa-heading"></i> H3
                </button>
            </div>
            <div class="btn-group btn-group-sm ml-2" role="group">
                <button type="button" class="btn btn-outline-secondary" onclick="formatText('ul')" title="Bullet List">
                    <i class="fas fa-list-ul"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary" onclick="formatText('ol')" title="Numbered List">
                    <i class="fas fa-list-ol"></i>
                </button>
            </div>
        </div>
    `);
    
    contentTextarea.before(toolbar);
    
    // Increase textarea height
    contentTextarea.attr('rows', 20);
});

// Simple text formatting functions
function formatText(format) {
    const textarea = document.getElementById('content');
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const selectedText = textarea.value.substring(start, end);
    let formattedText = '';
    
    switch(format) {
        case 'bold':
            formattedText = `<strong>${selectedText}</strong>`;
            break;
        case 'italic':
            formattedText = `<em>${selectedText}</em>`;
            break;
        case 'underline':
            formattedText = `<u>${selectedText}</u>`;
            break;
        case 'h2':
            formattedText = `<h2>${selectedText}</h2>`;
            break;
        case 'h3':
            formattedText = `<h3>${selectedText}</h3>`;
            break;
        case 'ul':
            formattedText = `<ul>\n<li>${selectedText}</li>\n</ul>`;
            break;
        case 'ol':
            formattedText = `<ol>\n<li>${selectedText}</li>\n</ol>`;
            break;
    }
    
    if (formattedText) {
        textarea.value = textarea.value.substring(0, start) + formattedText + textarea.value.substring(end);
        textarea.focus();
        textarea.setSelectionRange(start + formattedText.length, start + formattedText.length);
    }
}

// Auto generate slug from title (only if slug is empty)
$('#title').on('input', function() {
    const currentSlug = $('#slug').val();
    if (!currentSlug || currentSlug === '') {
        const title = $(this).val();
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim('-');
        $('#slug').val(slug);
    }
});

// Image preview
$('#featured_image').change(function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $('#preview').attr('src', e.target.result);
            $('#imagePreview').show();
        };
        reader.readAsDataURL(file);
        
        // Update label
        $(this).next('.custom-file-label').text(file.name);
        
        // Uncheck remove image if new image is selected
        $('#remove_image').prop('checked', false);
    } else {
        $('#imagePreview').hide();
        $(this).next('.custom-file-label').text('Pilih gambar...');
    }
});

// Character counter for excerpt
$('#excerpt').on('input', function() {
    const maxLength = 200;
    const currentLength = $(this).val().length;
    const remaining = maxLength - currentLength;
    
    let counterText = `${currentLength}/${maxLength} karakter`;
    if (remaining < 0) {
        counterText += ` (${Math.abs(remaining)} berlebih)`;
        $(this).addClass('is-invalid');
    } else {
        $(this).removeClass('is-invalid');
    }
    
    // Update or create counter
    let counter = $(this).siblings('.char-counter');
    if (counter.length === 0) {
        counter = $('<small class="form-text text-muted char-counter"></small>');
        $(this).after(counter);
    }
    counter.text(counterText);
});

// Trigger character counter on page load
$('#excerpt').trigger('input');

// Form validation
$('form#newsForm').submit(function(e) {
    let isValid = true;
    
    // Check required fields
    const requiredFields = ['title', 'content', 'category'];
    requiredFields.forEach(function(field) {
        const input = $(`[name="${field}"]`);
        if (!input.val().trim()) {
            input.addClass('is-invalid');
            isValid = false;
        } else {
            input.removeClass('is-invalid');
        }
    });
    
    if (!isValid) {
        e.preventDefault();
        alert('Mohon lengkapi semua field yang wajib diisi.');
    }
});

// Quick actions
function previewNews() {
    // Get form data
    const title = $('#title').val();
    const content = $('#content').val();
    const excerpt = $('#excerpt').val();
    
    if (!title || !content) {
        alert('Judul dan konten harus diisi untuk preview.');
        return;
    }
    
    // Show modal preview
    const previewContent = `
        <article class="max-w-none">
            <header class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">${title}</h1>
                ${excerpt ? `<p class="text-lg text-gray-600 italic">${excerpt}</p>` : ''}
            </header>
            <div class="prose prose-lg max-w-none">
                ${content}
            </div>
        </article>
    `;
    
    document.getElementById('previewContent').innerHTML = previewContent;
    document.getElementById('previewModal').classList.remove('hidden');
}

function closePreview() {
    document.getElementById('previewModal').classList.add('hidden');
}

function saveAsDraft() {
    $('#status').val('draft');
    $('form#newsForm').submit();
}

function duplicateNews() {
    if (confirm('Apakah Anda yakin ingin menduplikasi berita ini?')) {
        document.getElementById('duplicateForm').submit();
    }
}

function deleteNews() {
    if (confirm('Apakah Anda yakin ingin menghapus berita ini? Tindakan ini tidak dapat dibatalkan.')) {
        document.getElementById('deleteForm').submit();
    }
}

// Close modal when clicking outside
document.getElementById('previewModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closePreview();
    }
});

// Escape key to close modal
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closePreview();
    }
});
</script>
@endpush

@push('styles')
<style>
.char-counter {
    font-size: 0.8em;
}

/* Content editor toolbar */
.content-toolbar {
    background-color: #f9fafb;
    padding: 10px;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    margin-bottom: 10px;
}

.content-toolbar .btn-group {
    margin-right: 10px;
    display: inline-flex;
}

.content-toolbar .btn {
    padding: 0.375rem 0.75rem;
    margin-right: 0.25rem;
    border: 1px solid #d1d5db;
    background-color: white;
    color: #374151;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.2s;
}

.content-toolbar .btn:hover {
    background-color: #f3f4f6;
    border-color: #9ca3af;
}

/* Prose styling for preview */
.prose {
    color: #374151;
    line-height: 1.75;
}

.prose h1 {
    color: #111827;
    font-weight: 800;
    font-size: 2.25em;
    margin-top: 0;
    margin-bottom: 0.8888889em;
    line-height: 1.1111111;
}

.prose h2 {
    color: #111827;
    font-weight: 700;
    font-size: 1.5em;
    margin-top: 2em;
    margin-bottom: 1em;
    line-height: 1.3333333;
}

.prose h3 {
    color: #111827;
    font-weight: 600;
    font-size: 1.25em;
    margin-top: 1.6em;
    margin-bottom: 0.6em;
    line-height: 1.6;
}

.prose p {
    margin-top: 1.25em;
    margin-bottom: 1.25em;
}

.prose ul, .prose ol {
    margin-top: 1.25em;
    margin-bottom: 1.25em;
    padding-left: 1.625em;
}

.prose li {
    margin-top: 0.5em;
    margin-bottom: 0.5em;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .content-toolbar {
        padding: 8px;
    }
    
    .content-toolbar .btn-group {
        margin-right: 5px;
        margin-bottom: 5px;
    }
    
    .content-toolbar .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
}
</style>
@endpush