@extends('layouts.app')

@section('title', 'Tambah Berita')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Tambah Berita</h1>
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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Tambah</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.news.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-md transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <!-- Main Form -->
            <div class="bg-white rounded-lg shadow-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-[#14213d]">Informasi Berita</h6>
                </div>
                <div class="p-6">
                    <form id="newsForm" method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Title -->
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2 required">Judul Berita</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" 
                                   placeholder="Masukkan judul berita..." required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div class="mb-6">
                            <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug (URL)</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('slug') border-red-500 @enderror" 
                                   id="slug" name="slug" value="{{ old('slug') }}" 
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
                                      placeholder="Ringkasan singkat berita...">{{ old('excerpt') }}</textarea>
                            <p class="mt-1 text-sm text-gray-500">Maksimal 200 karakter</p>
                            @error('excerpt')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-6">
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2 required">Konten Berita</label>
                            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-vertical @error('content') border-red-500 @enderror" 
                                      id="content" name="content" rows="15" placeholder="Tulis konten berita di sini..." required>{{ old('content') }}</textarea>
                            <div class="flex justify-between items-center mt-1">
                                <span class="text-xs text-gray-500">Minimal 50 karakter untuk SEO yang baik</span>
                                <span id="contentCounter" class="text-xs text-gray-500">0 karakter</span>
                            </div>
                            @error('content')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Featured Image -->
                        <div class="mb-6">
                            <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama</label>
                            <div class="relative">
                                <input type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('featured_image') border-red-500 @enderror" 
                                       id="featured_image" name="featured_image" accept="image/*">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                            @error('featured_image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            
                            <!-- Image Preview -->
                            <div id="imagePreview" class="mt-3 hidden">
                                <img id="preview" src="" alt="Preview" class="rounded-lg border border-gray-200 max-w-xs">
                            </div>
                        </div>

                        <!-- Gallery Images -->
                        <div class="mb-6">
                            <label for="gallery_images" class="block text-sm font-medium text-gray-700 mb-2">Galeri Gambar</label>
                            <div class="relative">
                                <input type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100 @error('gallery_images.*') border-red-500 @enderror" 
                                       id="gallery_images" name="gallery_images[]" accept="image/*" multiple>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Pilih beberapa gambar untuk galeri. Format: JPG, PNG, GIF. Maksimal 2MB per gambar</p>
                            @error('gallery_images.*')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            
                            <!-- Gallery Preview -->
                            <div id="galleryPreview" class="mt-3 hidden">
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3" id="galleryGrid"></div>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-md transition-colors duration-200" onclick="history.back()">
                                <i class="fas fa-times mr-2"></i> Batal
                            </button>
                            <button type="submit" id="draftBtn" name="action" value="draft" class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-md transition-colors duration-200">
                                <i class="fas fa-save mr-2"></i> Simpan sebagai Draft
                            </button>
                            <button type="submit" id="publishBtn" name="action" value="publish" class="inline-flex items-center px-4 py-2 bg-[#14213d] hover:bg-[#0f1a2e] text-white font-medium rounded-md transition-colors duration-200">
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
                    <h6 class="text-lg font-semibold text-[#14213d]">Pengaturan Publikasi</h6>
                </div>
                <div class="p-6">
                    <!-- Category -->
                    <div class="mb-6">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2 required">Kategori</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('category') border-red-500 @enderror" 
                                id="category" name="category" form="newsForm" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $key => $value)
                                <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>
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
                                <option value="{{ $key }}" {{ old('status', 'draft') == $key ? 'selected' : '' }}>
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
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" 
                                   id="is_featured" name="is_featured" value="1" 
                                   form="newsForm" {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="ml-2 text-sm text-gray-700" for="is_featured">
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
                               value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}" form="newsForm">
                        <p class="mt-1 text-sm text-gray-500">Kosongkan untuk menggunakan waktu sekarang</p>
                        @error('published_at')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- SEO Settings -->
            <div class="bg-white rounded-lg shadow-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-[#14213d]">Pengaturan SEO</h6>
                </div>
                <div class="p-6">
                    <div class="mb-6">
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="meta_title" name="meta_title" 
                               value="{{ old('meta_title') }}" form="newsForm" maxlength="60">
                        <p class="mt-1 text-sm text-gray-500">Maksimal 60 karakter. Kosongkan untuk menggunakan judul berita</p>
                    </div>

                    <div class="mb-6">
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="meta_description" name="meta_description" 
                                  rows="3" form="newsForm" maxlength="160">{{ old('meta_description') }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">Maksimal 160 karakter. Kosongkan untuk menggunakan ringkasan</p>
                    </div>

                    <div class="mb-6">
                        <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="tags" name="tags" 
                               value="{{ old('tags') }}" form="newsForm" 
                               placeholder="tag1, tag2, tag3">
                        <p class="mt-1 text-sm text-gray-500">Pisahkan dengan koma</p>
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
                        <button type="button" class="w-full inline-flex items-center justify-center px-4 py-2 border border-blue-600 text-blue-600 bg-white hover:bg-blue-50 font-medium rounded-md transition-colors duration-200" onclick="previewNews()">
                            <i class="fas fa-eye mr-2"></i> Preview
                        </button>
                        <button type="button" class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-600 text-gray-600 bg-white hover:bg-gray-50 font-medium rounded-md transition-colors duration-200" onclick="saveAsDraft()">
                            <i class="fas fa-save mr-2"></i> Simpan Draft
                        </button>
                        <a href="{{ route('admin.news.index') }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-red-600 text-red-600 bg-white hover:bg-red-50 font-medium rounded-md transition-colors duration-200">
                            <i class="fas fa-times mr-2"></i> Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Content character counter
$('#content').on('input', function() {
    const content = $(this).val();
    const charCount = content.length;
    $('#contentCounter').text(charCount + ' karakter');
    
    // Update form progress and auto-save
    updateFormProgress();
    hasUnsavedChanges = true;
    clearTimeout(autoSaveTimer);
    autoSaveTimer = setTimeout(autoSaveDraft, 3000);
    
    // Show warning for short content
    const warningElement = $(this).siblings('.content-warning');
    if (charCount > 0 && charCount < 50) {
        if (warningElement.length === 0) {
            $(this).after('<div class="content-warning text-orange-600 text-sm mt-1">⚠ Konten terlalu pendek. Minimal 50 karakter untuk SEO yang baik.</div>');
        }
    } else {
        warningElement.remove();
    }
});

// Initialize character counter on page load
$(document).ready(function() {
    const initialContent = $('#content').val();
    $('#contentCounter').text(initialContent.length + ' karakter');
});

// Auto generate slug from title
$('#title').on('input', function() {
    const title = $(this).val();
    const slug = title.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim('-');
    $('#slug').val(slug);
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
    } else {
        $('#imagePreview').hide();
        $(this).next('.custom-file-label').text('Pilih gambar...');
    }
});

// Gallery images preview
$('#gallery_images').change(function() {
    const files = this.files;
    const galleryGrid = $('#galleryGrid');
    
    if (files.length > 0) {
        galleryGrid.empty();
        $('#galleryPreview').show();
        
        Array.from(files).forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imageDiv = $(`
                        <div class="relative group">
                            <img src="${e.target.result}" alt="Gallery ${index + 1}" class="w-full h-24 object-cover rounded-lg border border-gray-200">
                            <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-200 rounded-lg flex items-center justify-center">
                                <span class="text-white text-xs font-medium">Gambar ${index + 1}</span>
                            </div>
                        </div>
                    `);
                    galleryGrid.append(imageDiv);
                };
                reader.readAsDataURL(file);
            }
        });
    } else {
        $('#galleryPreview').hide();
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

// Auto generate meta title and description
$('#title').on('input', function() {
    if (!$('#meta_title').val()) {
        $('#meta_title').val($(this).val());
    }
});

$('#excerpt').on('input', function() {
    if (!$('#meta_description').val()) {
        $('#meta_description').val($(this).val());
    }
});

// Form validation
$('form').submit(function(e) {
    let isValid = true;
    let errorMessage = '';
    
    // Check required fields
    const requiredFields = ['title', 'content', 'category'];
    const fieldLabels = {
        'title': 'Judul',
        'content': 'Konten',
        'category': 'Kategori'
    };
    
    const missingFields = [];
    
    requiredFields.forEach(function(field) {
        const input = $(`[name="${field}"]`);
        let value = '';
        
        if (field === 'content') {
            // For content field, get value from editor
            value = window.editor ? window.editor.getData() : input.val();
        } else {
            value = input.val();
        }
        
        if (!value || !value.trim()) {
            input.addClass('is-invalid');
            missingFields.push(fieldLabels[field]);
            isValid = false;
        } else {
            input.removeClass('is-invalid');
        }
    });
    
    if (!isValid) {
        e.preventDefault();
        errorMessage = 'Mohon lengkapi field berikut sebelum menyimpan data:\n\n' + missingFields.join('\n');
        alert(errorMessage);
        
        // Focus on first missing field
        const firstMissingField = requiredFields.find(field => {
            const input = $(`[name="${field}"]`);
            let value = field === 'content' ? (window.editor ? window.editor.getData() : input.val()) : input.val();
            return !value || !value.trim();
        });
        
        if (firstMissingField) {
            if (firstMissingField === 'content' && window.editor) {
                window.editor.focus();
            } else {
                $(`[name="${firstMissingField}"]`).focus();
            }
        }
    }
});

// Quick actions
function previewNews() {
    // Get form data
    const title = $('#title').val();
    const content = $('#content').val();
    
    if (!title || !content) {
        alert('Judul dan konten harus diisi untuk preview.');
        return;
    }
    
    // Format content for preview (convert line breaks to <br>)
    const formattedContent = content.replace(/\n/g, '<br>');
    
    // Open preview in new window
    const previewWindow = window.open('', '_blank', 'width=800,height=600');
    previewWindow.document.write(`
        <html>
        <head>
            <title>Preview: ${title}</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                h1 { color: #333; }
                .content { line-height: 1.6; white-space: pre-wrap; }
            </style>
        </head>
        <body>
            <h1>${title}</h1>
            <div class="content">${formattedContent}</div>
        </body>
        </html>
    `);
}

function saveAsDraft() {
    $('#status').val('draft');
    $('form').submit();
}

// Auto-save draft functionality
let autoSaveTimer;
let hasUnsavedChanges = false;

function autoSaveDraft() {
    const title = $('#title').val();
    const content = $('#content').val();
    
    if (title.trim() || content.trim()) {
        // Save to localStorage as backup
        const draftData = {
            title: title,
            slug: $('#slug').val(),
            excerpt: $('#excerpt').val(),
            content: content,
            category: $('#category').val(),
            meta_title: $('#meta_title').val(),
            meta_description: $('#meta_description').val(),
            tags: $('#tags').val(),
            timestamp: new Date().toISOString()
        };
        
        localStorage.setItem('news_draft_backup', JSON.stringify(draftData));
        
        // Show auto-save indicator
        showAutoSaveIndicator();
    }
}

function showAutoSaveIndicator() {
    // Remove existing indicator
    $('.auto-save-indicator').remove();
    
    // Add new indicator
    const indicator = $('<div class="auto-save-indicator fixed top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-md text-sm z-50">Draft tersimpan otomatis</div>');
    $('body').append(indicator);
    
    // Remove after 2 seconds
    setTimeout(() => {
        indicator.fadeOut(300, function() {
            $(this).remove();
        });
    }, 2000);
}

function loadDraftFromBackup() {
    const backup = localStorage.getItem('news_draft_backup');
    if (backup) {
        try {
            const draftData = JSON.parse(backup);
            const backupDate = new Date(draftData.timestamp);
            const now = new Date();
            const hoursDiff = (now - backupDate) / (1000 * 60 * 60);
            
            // Only load if backup is less than 24 hours old
            if (hoursDiff < 24) {
                if (confirm('Ditemukan draft yang tersimpan otomatis. Apakah Anda ingin memulihkannya?')) {
                    $('#title').val(draftData.title);
                    $('#slug').val(draftData.slug);
                    $('#excerpt').val(draftData.excerpt);
                    $('#category').val(draftData.category);
                    $('#meta_title').val(draftData.meta_title);
                    $('#meta_description').val(draftData.meta_description);
                    $('#tags').val(draftData.tags);
                    $('#content').val(draftData.content);
                    
                    // Update character counter
                    $('#contentCounter').text(draftData.content.length + ' karakter');
                }
            }
        } catch (e) {
            console.error('Error loading draft backup:', e);
        }
    }
}

// Set up auto-save
$(document).ready(function() {
    // Load draft backup on page load
    setTimeout(loadDraftFromBackup, 500);
    
    // Initialize progress bar
    setTimeout(updateFormProgress, 1000);
    
    // Track changes and validate
    $('#title, #excerpt, #meta_title, #meta_description').on('input blur', function() {
        validateField($(this));
        hasUnsavedChanges = true;
        clearTimeout(autoSaveTimer);
        autoSaveTimer = setTimeout(autoSaveDraft, 3000);
    });
    
    // Track other field changes
    $('#slug, #category, #tags, #status, #is_featured, #published_at').on('input change', function() {
        updateFormProgress();
        hasUnsavedChanges = true;
        clearTimeout(autoSaveTimer);
        autoSaveTimer = setTimeout(autoSaveDraft, 3000);
    });
    
    // Track file uploads
    $('#featured_image, #gallery_images').on('change', function() {
        updateFormProgress();
        hasUnsavedChanges = true;
    });
    
    // Real-time validation
function validateField(field) {
    const value = field.val().trim();
    const fieldName = field.attr('name');
    const errorElement = field.closest('.form-group').find('.error-message');
    
    // Remove existing error
    errorElement.remove();
    field.removeClass('border-red-500');
    
    let isValid = true;
    let errorMessage = '';
    
    switch(fieldName) {
        case 'title':
            if (!value) {
                isValid = false;
                errorMessage = 'Judul wajib diisi';
            } else if (value.length < 5) {
                isValid = false;
                errorMessage = 'Judul minimal 5 karakter';
            } else if (value.length > 200) {
                isValid = false;
                errorMessage = 'Judul maksimal 200 karakter';
            }
            break;
            
        case 'excerpt':
            if (value && value.length > 500) {
                isValid = false;
                errorMessage = 'Ringkasan maksimal 500 karakter';
            }
            break;
            
        case 'meta_title':
            if (value && value.length > 60) {
                isValid = false;
                errorMessage = 'Meta title maksimal 60 karakter';
            }
            break;
            
        case 'meta_description':
            if (value && value.length > 160) {
                isValid = false;
                errorMessage = 'Meta description maksimal 160 karakter';
            }
            break;
    }
    
    if (!isValid) {
        field.addClass('border-red-500');
        field.closest('.form-group').append(`<div class="error-message text-red-500 text-sm mt-1">${errorMessage}</div>`);
    }
    
    updateFormProgress();
    return isValid;
}

// Form progress indicator
function updateFormProgress() {
    const requiredFields = ['title', 'content', 'category'];
    const optionalFields = ['excerpt', 'featured_image', 'meta_title', 'meta_description'];
    
    let completedRequired = 0;
    let completedOptional = 0;
    
    // Check required fields
    requiredFields.forEach(fieldName => {
        const value = $(`[name="${fieldName}"]`).val();
        
        if (value && value.trim()) {
            completedRequired++;
        }
    });
    
    // Check optional fields
    optionalFields.forEach(fieldName => {
        const value = $(`[name="${fieldName}"]`).val();
        if (value && value.trim()) {
            completedOptional++;
        }
    });
    
    const requiredProgress = (completedRequired / requiredFields.length) * 100;
    const totalProgress = ((completedRequired + completedOptional) / (requiredFields.length + optionalFields.length)) * 100;
    
    // Update progress bar
    updateProgressBar(requiredProgress, totalProgress);
    
    // Update publish button state
    const canPublish = completedRequired === requiredFields.length;
    $('#publishBtn').prop('disabled', !canPublish);
    
    if (canPublish) {
        $('#publishBtn').removeClass('opacity-50 cursor-not-allowed');
    } else {
        $('#publishBtn').addClass('opacity-50 cursor-not-allowed');
    }
}

function updateProgressBar(requiredProgress, totalProgress) {
    // Remove existing progress bar
    $('.form-progress').remove();
    
    // Add progress bar after header
    const progressHtml = `
        <div class="form-progress bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-700">Progress Pengisian Form</span>
                <span class="text-sm text-gray-500">${Math.round(totalProgress)}% selesai</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: ${totalProgress}%"></div>
            </div>
            <div class="flex items-center justify-between text-xs text-gray-500">
                <span>Wajib: ${Math.round(requiredProgress)}%</span>
                <span class="${requiredProgress === 100 ? 'text-green-600' : 'text-orange-600'}">
                    ${requiredProgress === 100 ? '✓ Siap dipublikasikan' : '⚠ Lengkapi field wajib'}
                </span>
            </div>
        </div>
    `;
    
    $('.grid.grid-cols-1.lg\\:grid-cols-3.gap-6').before(progressHtml);
}
    
    // Clear backup on successful submit
    $('form').on('submit', function() {
        localStorage.removeItem('news_draft_backup');
        hasUnsavedChanges = false;
    });
    
    // Warn before leaving page with unsaved changes
    $(window).on('beforeunload', function() {
        if (hasUnsavedChanges) {
            return 'Anda memiliki perubahan yang belum disimpan. Yakin ingin meninggalkan halaman?';
        }
    });
    
    // Keyboard shortcuts
    $(document).on('keydown', function(e) {
        // Ctrl+S or Cmd+S - Save as draft
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            saveAsDraft();
            return false;
        }
        
        // Ctrl+Enter or Cmd+Enter - Publish
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            e.preventDefault();
            const canPublish = !$('#publishBtn').prop('disabled');
            if (canPublish) {
                $('#status').val('published');
                $('form').submit();
            } else {
                alert('Lengkapi field wajib terlebih dahulu sebelum mempublikasikan.');
            }
            return false;
        }
        
        // Ctrl+Shift+P - Preview
        if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.key === 'P') {
            e.preventDefault();
            previewNews();
            return false;
        }
        
        // Escape - Cancel/Go back
        if (e.key === 'Escape') {
            if (confirm('Yakin ingin membatalkan dan kembali? Perubahan yang belum disimpan akan hilang.')) {
                window.location.href = '{{ route("admin.news.index") }}';
            }
        }
    });
    
    // Show keyboard shortcuts help
    function showKeyboardShortcuts() {
        const shortcutsHtml = `
            <div id="shortcutsModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
                <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Keyboard Shortcuts</h3>
                        <button onclick="$('#shortcutsModal').remove()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Simpan sebagai draft</span>
                            <kbd class="px-2 py-1 bg-gray-100 rounded text-xs">Ctrl + S</kbd>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Publikasikan</span>
                            <kbd class="px-2 py-1 bg-gray-100 rounded text-xs">Ctrl + Enter</kbd>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Preview</span>
                            <kbd class="px-2 py-1 bg-gray-100 rounded text-xs">Ctrl + Shift + P</kbd>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Batal/Kembali</span>
                            <kbd class="px-2 py-1 bg-gray-100 rounded text-xs">Esc</kbd>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Bantuan shortcuts</span>
                            <kbd class="px-2 py-1 bg-gray-100 rounded text-xs">Ctrl + /</kbd>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        $('#shortcutsModal').remove();
        $('body').append(shortcutsHtml);
    }
    
    // Ctrl+/ - Show shortcuts help
    $(document).on('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === '/') {
            e.preventDefault();
            showKeyboardShortcuts();
            return false;
        }
    });
    
    // Add shortcuts help button to page
    const shortcutsButton = `
        <button onclick="showKeyboardShortcuts()" class="fixed bottom-4 right-4 bg-gray-600 hover:bg-gray-700 text-white p-3 rounded-full shadow-lg z-40 transition-colors duration-200" title="Keyboard Shortcuts (Ctrl+/)">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
            </svg>
        </button>
    `;
    
    $('body').append(shortcutsButton);
    
    // Make showKeyboardShortcuts globally available
    window.showKeyboardShortcuts = showKeyboardShortcuts;
});
</script>
@endpush

@push('styles')
<style>
.required::after {
    content: ' *';
    color: #ef4444;
}

.char-counter {
    font-size: 0.8em;
}

#content {
    min-height: 300px;
}

#content:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
}

.content-warning {
    animation: fadeIn 0.3s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
</style>
@endpush