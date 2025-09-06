@extends('layouts.app')

@section('title', 'Edit Data Transparansi')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Edit Data Transparansi</h1>
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
                            <a href="{{ route('admin.transparency.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">
                                Transparansi
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
        <div class="flex space-x-2">
            <a href="{{ route('admin.transparency.show', $transparency) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition-colors duration-200">
                <i class="fas fa-eye mr-2"></i> Lihat
            </a>
            <a href="{{ route('admin.transparency.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-md transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <!-- Main Form -->
            <div class="bg-white rounded-lg shadow-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-[#14213d]">Edit Informasi Data Transparansi</h6>
                </div>
                <div class="p-6">
                    <form id="transparencyForm" method="POST" action="{{ route('admin.transparency.update', $transparency) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Title -->
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2 required">Judul Data Transparansi</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror" 
                                   id="title" name="title" value="{{ old('title', $transparency->title) }}" 
                                   placeholder="Masukkan judul data transparansi..." required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category and Type -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 mb-2 required">Kategori</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('category') border-red-500 @enderror" 
                                        id="category" name="category" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $key => $value)
                                        <option value="{{ $key }}" {{ old('category', $transparency->category) == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-2 required">Tipe</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('type') border-red-500 @enderror" 
                                        id="type" name="type" required>
                                    <option value="">Pilih Tipe</option>
                                    @foreach($types as $key => $value)
                                        <option value="{{ $key }}" {{ old('type', $transparency->type) == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror" 
                                      id="description" name="description" rows="4" 
                                      placeholder="Deskripsi detail tentang data transparansi ini...">{{ old('description', $transparency->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Period -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="period_start" class="block text-sm font-medium text-gray-700 mb-2">Periode Mulai</label>
                                <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('period_start') border-red-500 @enderror" 
                                       id="period_start" name="period_start" 
                                       value="{{ old('period_start', $transparency->period_start?->format('Y-m-d')) }}">
                                @error('period_start')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="period_end" class="block text-sm font-medium text-gray-700 mb-2">Periode Selesai</label>
                                <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('period_end') border-red-500 @enderror" 
                                       id="period_end" name="period_end" 
                                       value="{{ old('period_end', $transparency->period_end?->format('Y-m-d')) }}">
                                @error('period_end')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Amount -->
                        <div class="mb-6">
                            <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Jumlah/Nilai (Rp)</label>
                            <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('amount') border-red-500 @enderror" 
                                   id="amount" name="amount" value="{{ old('amount', $transparency->amount) }}" 
                                   min="0" step="0.01" placeholder="0">
                            <p class="mt-1 text-sm text-gray-500">Opsional. Masukkan nilai dalam rupiah jika relevan.</p>
                            @error('amount')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Current Files -->
                        @if($transparency->files)
                            @php
                                $currentFiles = json_decode($transparency->files, true) ?? [];
                            @endphp
                            @if(count($currentFiles) > 0)
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">File Saat Ini</label>
                                    <div class="border border-gray-300 rounded-md p-4">
                                        @foreach($currentFiles as $index => $file)
                                            <div class="flex justify-between items-center mb-2 p-3 bg-gray-50 rounded-md">
                                                <div class="flex items-center">
                                                    <i class="fas fa-file mr-2 text-gray-500"></i>
                                                    <div>
                                                        <strong class="text-gray-900">{{ $file['name'] }}</strong>
                                                        <small class="text-gray-500 block">({{ number_format($file['size'] / 1024, 2) }} KB)</small>
                                                    </div>
                                                </div>
                                                <div class="flex space-x-2">
                                                    <a href="{{ asset('storage/' . $file['path']) }}" target="_blank" 
                                                       class="inline-flex items-center px-2 py-1 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded transition-colors duration-200">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                    <button type="button" class="inline-flex items-center px-2 py-1 bg-red-500 hover:bg-red-600 text-white text-sm rounded transition-colors duration-200" 
                                                            onclick="markForRemoval({{ $index }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="remove_files[]" value="" id="remove_file_{{ $index }}">
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endif

                        <!-- Files -->
                        <div class="mb-6">
                            <label for="files" class="block text-sm font-medium text-gray-700 mb-2">Tambah File Baru</label>
                            <div class="relative">
                                <input type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('files.*') border-red-500 @enderror" 
                                       id="files" name="files[]" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Maksimal 10MB per file. Format yang didukung: PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG.</p>
                            @error('files.*')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Data JSON -->
                        <div class="mb-6">
                            <label for="data" class="block text-sm font-medium text-gray-700 mb-2">Data JSON</label>
                            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('data') border-red-500 @enderror" 
                                      id="data" name="data" rows="6" 
                                      placeholder='Contoh: {"anggaran": 1000000, "realisasi": 800000}'>{{ old('data', $transparency->data ? json_encode(json_decode($transparency->data), JSON_PRETTY_PRINT) : '') }}</textarea>
                            <p class="mt-1 text-sm text-gray-500">Opsional. Data dalam format JSON untuk informasi terstruktur.</p>
                            @error('data')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status and Featured -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2 required">Status</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror" 
                                        id="status" name="status" required>
                                    <option value="draft" {{ old('status', $transparency->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status', $transparency->status) == 'published' ? 'selected' : '' }}>Dipublikasikan</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pengaturan Lainnya</label>
                                <div class="flex items-center mt-4">
                                    <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" 
                                           id="is_featured" name="is_featured" value="1" {{ old('is_featured', $transparency->is_featured) ? 'checked' : '' }}>
                                    <label class="ml-2 text-sm text-gray-700" for="is_featured">
                                        Jadikan sebagai data unggulan
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('admin.transparency.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-md transition-colors duration-200">
                                <i class="fas fa-times mr-2"></i> Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#14213d] hover:bg-[#0f1a2e] text-white font-medium rounded-md transition-colors duration-200">
                                <i class="fas fa-save mr-2"></i> Update Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <!-- Info Card -->
            <div class="bg-white rounded-lg shadow-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-[#14213d]">Informasi Data</h6>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-700">ID:</span>
                            <span class="text-gray-900">{{ $transparency->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-700">Dibuat:</span>
                            <div class="text-right">
                                <div class="text-gray-900">{{ $transparency->created_at->format('d/m/Y H:i') }}</div>
                                <div class="text-sm text-gray-500">{{ $transparency->creator?->name }}</div>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-700">Diupdate:</span>
                            <div class="text-right">
                                <div class="text-gray-900">{{ $transparency->updated_at->format('d/m/Y H:i') }}</div>
                                <div class="text-sm text-gray-500">{{ $transparency->updater?->name }}</div>
                            </div>
                        </div>
                        @if($transparency->published_at)
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-700">Dipublikasikan:</span>
                                <span class="text-gray-900">{{ $transparency->published_at->format('d/m/Y H:i') }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-700">Views:</span>
                            <span class="text-gray-900">{{ number_format($transparency->views) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-700">Downloads:</span>
                            <span class="text-gray-900">{{ number_format($transparency->downloads) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Help Card -->
            <div class="bg-white rounded-lg shadow-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-[#14213d]">Panduan Edit</h6>
                </div>
                <div class="p-6">
                    <h6 class="font-semibold text-gray-900 mb-2">File Management:</h6>
                    <ul class="text-sm text-gray-600 mb-4 space-y-1">
                        <li>Klik tombol <i class="fas fa-trash text-red-500"></i> untuk menghapus file</li>
                        <li>Upload file baru akan ditambahkan ke file yang ada</li>
                        <li>File yang dihapus tidak dapat dikembalikan</li>
                    </ul>

                    <h6 class="font-semibold text-gray-900 mb-2">Status:</h6>
                    <ul class="text-sm text-gray-600 mb-4 space-y-1">
                        <li><strong>Draft:</strong> Tidak tampil di publik</li>
                        <li><strong>Dipublikasikan:</strong> Tampil di portal transparansi</li>
                    </ul>

                    <h6 class="font-semibold text-gray-900 mb-2">Tips:</h6>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>Pastikan data JSON valid sebelum menyimpan</li>
                        <li>Gunakan preview untuk melihat perubahan</li>
                        <li>Backup file penting sebelum menghapus</li>
                    </ul>
                </div>
            </div>

            <!-- Preview Card -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-[#14213d]">Preview</h6>
                </div>
                <div class="p-6">
                    <div id="preview-content">
                        <!-- Preview will be populated by JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Track files marked for removal
let filesToRemove = [];

function markForRemoval(index) {
    const fileElement = document.querySelector(`#remove_file_${index}`).closest('.d-flex');
    const removeInput = document.getElementById(`remove_file_${index}`);
    
    if (filesToRemove.includes(index)) {
        // Restore file
        filesToRemove = filesToRemove.filter(i => i !== index);
        fileElement.classList.remove('text-muted');
        fileElement.style.opacity = '1';
        removeInput.value = '';
        fileElement.querySelector('.btn-outline-danger').innerHTML = '<i class="fas fa-trash"></i>';
    } else {
        // Mark for removal
        filesToRemove.push(index);
        fileElement.classList.add('text-muted');
        fileElement.style.opacity = '0.5';
        removeInput.value = index;
        fileElement.querySelector('.btn-outline-danger').innerHTML = '<i class="fas fa-undo"></i>';
    }
}

// Real-time preview
function updatePreview() {
    const title = document.getElementById('title').value || 'Judul belum diisi';
    const category = document.getElementById('category');
    const categoryText = category.options[category.selectedIndex]?.text || 'Kategori belum dipilih';
    const type = document.getElementById('type');
    const typeText = type.options[type.selectedIndex]?.text || 'Tipe belum dipilih';
    const description = document.getElementById('description').value || 'Deskripsi belum diisi';
    const status = document.getElementById('status');
    const statusText = status.options[status.selectedIndex]?.text || 'Draft';
    const isFeatured = document.getElementById('is_featured').checked;
    
    const previewContent = document.getElementById('preview-content');
    previewContent.innerHTML = `
        <h6 class="font-weight-bold">${title}</h6>
        <div class="mb-2">
            <span class="badge badge-info badge-sm">${categoryText}</span>
            <span class="badge badge-secondary badge-sm">${typeText}</span>
            ${isFeatured ? '<span class="badge badge-warning badge-sm"><i class="fas fa-star"></i> Unggulan</span>' : ''}
        </div>
        <p class="small text-muted mb-2">${description}</p>
        <div class="small">
            <strong>Status:</strong> 
            <span class="badge badge-${status.value === 'published' ? 'success' : 'warning'} badge-sm">
                ${statusText}
            </span>
        </div>
    `;
}

// Add event listeners for real-time preview
document.getElementById('title').addEventListener('input', updatePreview);
document.getElementById('category').addEventListener('change', updatePreview);
document.getElementById('type').addEventListener('change', updatePreview);
document.getElementById('description').addEventListener('input', updatePreview);
document.getElementById('status').addEventListener('change', updatePreview);
document.getElementById('is_featured').addEventListener('change', updatePreview);

// JSON validation
document.getElementById('data').addEventListener('blur', function() {
    const value = this.value.trim();
    if (value && value !== '') {
        try {
            JSON.parse(value);
            this.classList.remove('is-invalid');
            this.classList.add('is-valid');
        } catch (e) {
            this.classList.remove('is-valid');
            this.classList.add('is-invalid');
            
            // Show error message
            let feedback = this.parentNode.querySelector('.invalid-feedback');
            if (!feedback) {
                feedback = document.createElement('div');
                feedback.className = 'invalid-feedback';
                this.parentNode.appendChild(feedback);
            }
            feedback.textContent = 'Format JSON tidak valid: ' + e.message;
        }
    } else {
        this.classList.remove('is-invalid', 'is-valid');
    }
});

// File preview
document.getElementById('files').addEventListener('change', function() {
    const files = this.files;
    let fileList = '';
    
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const size = (file.size / 1024 / 1024).toFixed(2);
        fileList += `<li class="small">${file.name} (${size} MB)</li>`;
    }
    
    if (fileList) {
        const preview = document.getElementById('preview-content');
        const existingFileList = preview.querySelector('.new-files');
        if (existingFileList) {
            existingFileList.remove();
        }
        
        preview.innerHTML += `
            <div class="mt-3 new-files">
                <strong class="small">File baru yang akan diupload:</strong>
                <ul class="mb-0">${fileList}</ul>
            </div>
        `;
    }
});

// Initialize preview
updatePreview();
</script>
@endpush