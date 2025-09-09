@extends('layouts.app')

@section('title', 'Tambah Data Transparansi')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Tambah Data Transparansi</h1>
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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Tambah</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.transparency.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-md transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <!-- Main Form -->
            <div class="bg-white rounded-lg shadow-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-[#14213d]">Informasi Data Transparansi</h6>
                </div>
                <div class="p-6">
                    <form id="transparencyForm" method="POST" action="{{ route('admin.transparency.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Title -->
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2 required">Judul Data Transparansi</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" 
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
                                        <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>
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
                                        <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>
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
                                      placeholder="Deskripsi detail tentang data transparansi ini...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Period -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="period_start" class="block text-sm font-medium text-gray-700 mb-2">Periode Mulai</label>
                                <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('period_start') border-red-500 @enderror" 
                                       id="period_start" name="period_start" value="{{ old('period_start') }}">
                                @error('period_start')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="period_end" class="block text-sm font-medium text-gray-700 mb-2">Periode Selesai</label>
                                <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('period_end') border-red-500 @enderror" 
                                       id="period_end" name="period_end" value="{{ old('period_end') }}">
                                @error('period_end')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Amount -->
                        <div class="mb-6">
                            <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Jumlah/Nilai (Rp)</label>
                            <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('amount') border-red-500 @enderror" 
                                   id="amount" name="amount" value="{{ old('amount') }}" 
                                   min="0" step="0.01" placeholder="0">
                            <p class="mt-1 text-sm text-gray-500">Opsional. Masukkan nilai dalam rupiah jika relevan.</p>
                            @error('amount')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Files -->
                        <div class="mb-6">
                            <label for="files" class="block text-sm font-medium text-gray-700 mb-2">File Dokumen</label>
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
                                      placeholder='Contoh: {"anggaran": 1000000, "realisasi": 800000}'>{{ old('data') }}</textarea>
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
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Dipublikasikan</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pengaturan Lainnya</label>
                                <div class="flex items-center mt-4">
                                    <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" 
                                           id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                    <label class="ml-2 text-sm text-gray-700" for="is_featured">
                                        Jadikan sebagai data unggulan
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-md transition-colors duration-200" onclick="history.back()">
                                <i class="fas fa-times mr-2"></i> Batal
                            </button>
                            <button type="submit" name="action" value="draft" class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-md transition-colors duration-200">
                                <i class="fas fa-save mr-2"></i> Simpan sebagai Draft
                            </button>
                            <button type="submit" name="action" value="publish" class="inline-flex items-center px-4 py-2 bg-[#14213d] hover:bg-[#0f1a2e] text-white font-medium rounded-md transition-colors duration-200">
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
                    <!-- Quick Actions -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Aksi Cepat</label>
                        <div class="space-y-2">
                            <button type="button" class="w-full text-left px-3 py-2 text-sm bg-gray-50 hover:bg-gray-100 rounded-md transition-colors duration-200" onclick="document.getElementById('status').value='draft'">
                                <i class="fas fa-save mr-2 text-yellow-600"></i> Simpan sebagai Draft
                            </button>
                            <button type="button" class="w-full text-left px-3 py-2 text-sm bg-gray-50 hover:bg-gray-100 rounded-md transition-colors duration-200" onclick="document.getElementById('status').value='published'">
                                <i class="fas fa-paper-plane mr-2 text-green-600"></i> Publikasikan Langsung
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Help Card -->
            <div class="bg-white rounded-lg shadow-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-[#14213d]">Panduan Pengisian</h6>
                </div>
                <div class="p-6">
                    <h6 class="font-semibold text-gray-900 mb-2">Kategori:</h6>
                    <ul class="text-sm text-gray-600 mb-4 space-y-1">
                        <li><strong>Anggaran:</strong> Data APBD, RAB, dll</li>
                        <li><strong>Pengadaan:</strong> Tender, kontrak, dll</li>
                        <li><strong>Proyek:</strong> Pembangunan, program, dll</li>
                        <li><strong>Regulasi:</strong> Peraturan, SK, dll</li>
                        <li><strong>Laporan:</strong> LPJ, monitoring, dll</li>
                    </ul>

                    <h6 class="font-semibold text-gray-900 mb-2">Tipe:</h6>
                    <ul class="text-sm text-gray-600 mb-4 space-y-1">
                        <li><strong>Dokumen:</strong> File PDF, Word, dll</li>
                        <li><strong>Data:</strong> Informasi terstruktur</li>
                        <li><strong>Pengumuman:</strong> Informasi publik</li>
                    </ul>

                    <h6 class="font-semibold text-gray-900 mb-2">Tips:</h6>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>Gunakan judul yang jelas dan deskriptif</li>
                        <li>Isi periode untuk data yang memiliki rentang waktu</li>
                        <li>Upload file dalam format yang mudah diakses</li>
                        <li>Gunakan data JSON untuk informasi terstruktur</li>
                        <li>Centang "unggulan" untuk data penting</li>
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
                        <h5 id="preview-title" class="text-xl font-semibold text-gray-800 mb-3">Judul akan muncul di sini...</h5>
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span id="preview-category" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Kategori</span>
                            <span id="preview-type" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Tipe</span>
                        </div>
                        <p id="preview-description" class="text-gray-600 mb-4">Deskripsi akan muncul di sini...</p>
                        <div class="space-y-2 text-sm text-gray-500">
                            <div id="preview-period">Periode: -</div>
                            <div id="preview-amount">Jumlah: -</div>
                        </div>
                        <div id="preview-status" class="mt-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Draft</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Real-time preview
function updatePreview() {
    const title = document.getElementById('title').value || 'Judul akan muncul di sini...';
    const category = document.getElementById('category');
    const categoryText = category.options[category.selectedIndex]?.text || 'Kategori';
    const type = document.getElementById('type');
    const typeText = type.options[type.selectedIndex]?.text || 'Tipe';
    const description = document.getElementById('description').value || 'Deskripsi akan muncul di sini...';
    const startPeriod = document.getElementById('period_start').value;
    const endPeriod = document.getElementById('period_end').value;
    const amount = document.getElementById('amount').value;
    const status = document.getElementById('status');
    const statusText = status.options[status.selectedIndex]?.text || 'Draft';
    const isFeatured = document.getElementById('is_featured').checked;
    
    // Update preview elements
    document.getElementById('preview-title').textContent = title;
    document.getElementById('preview-category').textContent = categoryText;
    document.getElementById('preview-type').textContent = typeText;
    document.getElementById('preview-description').textContent = description;
    
    // Update period
    let periodText = 'Periode: -';
    if (startPeriod && endPeriod) {
        periodText = `Periode: ${startPeriod} - ${endPeriod}`;
    } else if (startPeriod) {
        periodText = `Periode: ${startPeriod}`;
    }
    document.getElementById('preview-period').textContent = periodText;
    
    // Update amount
    let amountText = 'Jumlah: -';
    if (amount) {
        const formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });
        amountText = `Jumlah: ${formatter.format(amount)}`;
    }
    document.getElementById('preview-amount').textContent = amountText;
    
    // Update status badge
    const statusBadge = document.querySelector('#preview-status span');
    if (status.value === 'published') {
        statusBadge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800';
        statusBadge.textContent = 'Published';
    } else {
        statusBadge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800';
        statusBadge.textContent = 'Draft';
    }
    
    // Update featured badge
    const categoryBadge = document.getElementById('preview-category');
    if (isFeatured) {
        categoryBadge.innerHTML = `<i class="fas fa-star mr-1"></i>${categoryText}`;
        categoryBadge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800';
    } else {
        categoryBadge.textContent = categoryText;
        categoryBadge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800';
    }
}

// Add event listeners for real-time preview
document.getElementById('title').addEventListener('input', updatePreview);
document.getElementById('category').addEventListener('change', updatePreview);
document.getElementById('type').addEventListener('change', updatePreview);
document.getElementById('description').addEventListener('input', updatePreview);
document.getElementById('period_start').addEventListener('change', updatePreview);
document.getElementById('period_end').addEventListener('change', updatePreview);
document.getElementById('amount').addEventListener('input', updatePreview);
document.getElementById('status').addEventListener('change', updatePreview);
document.getElementById('is_featured').addEventListener('change', updatePreview);

// JSON validation
document.getElementById('data').addEventListener('blur', function() {
    const value = this.value.trim();
    if (value && value !== '') {
        try {
            JSON.parse(value);
            this.classList.remove('border-red-300', 'text-red-900', 'placeholder-red-300', 'focus:ring-red-500', 'focus:border-red-500');
            this.classList.add('border-green-300', 'text-green-900', 'placeholder-green-300', 'focus:ring-green-500', 'focus:border-green-500');
            
            // Remove error message
            const feedback = this.parentNode.querySelector('.text-red-600');
            if (feedback) {
                feedback.remove();
            }
        } catch (e) {
            this.classList.remove('border-green-300', 'text-green-900', 'placeholder-green-300', 'focus:ring-green-500', 'focus:border-green-500');
            this.classList.add('border-red-300', 'text-red-900', 'placeholder-red-300', 'focus:ring-red-500', 'focus:border-red-500');
            
            // Show error message
            let feedback = this.parentNode.querySelector('.text-red-600');
            if (!feedback) {
                feedback = document.createElement('p');
                feedback.className = 'mt-2 text-sm text-red-600';
                this.parentNode.appendChild(feedback);
            }
            feedback.textContent = 'Format JSON tidak valid: ' + e.message;
        }
    } else {
        this.classList.remove('border-red-300', 'text-red-900', 'placeholder-red-300', 'focus:ring-red-500', 'focus:border-red-500', 'border-green-300', 'text-green-900', 'placeholder-green-300', 'focus:ring-green-500', 'focus:border-green-500');
        
        // Remove error message
        const feedback = this.parentNode.querySelector('.text-red-600');
        if (feedback) {
            feedback.remove();
        }
    }
});

// File preview
document.getElementById('files').addEventListener('change', function() {
    const files = this.files;
    
    // Remove existing file preview
    const existingPreview = document.getElementById('file-preview');
    if (existingPreview) {
        existingPreview.remove();
    }
    
    if (files.length > 0) {
        let fileList = '';
        
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const size = (file.size / 1024 / 1024).toFixed(2);
            const fileType = file.type.includes('image') ? 'text-blue-600' : file.type.includes('pdf') ? 'text-red-600' : 'text-gray-600';
            const icon = file.type.includes('image') ? 'fas fa-image' : file.type.includes('pdf') ? 'fas fa-file-pdf' : 'fas fa-file';
            
            fileList += `
                <div class="flex items-center justify-between p-2 bg-gray-50 rounded-md">
                    <div class="flex items-center">
                        <i class="${icon} ${fileType} mr-2"></i>
                        <span class="text-sm font-medium text-gray-900">${file.name}</span>
                    </div>
                    <span class="text-xs text-gray-500">${size} MB</span>
                </div>
            `;
        }
        
        const previewContent = document.getElementById('preview-content');
        const filePreview = document.createElement('div');
        filePreview.id = 'file-preview';
        filePreview.className = 'mt-4 pt-4 border-t border-gray-200';
        filePreview.innerHTML = `
            <h6 class="text-sm font-semibold text-gray-900 mb-2">File yang akan diupload:</h6>
            <div class="space-y-2">${fileList}</div>
        `;
        previewContent.appendChild(filePreview);
    }
});

// Initialize preview
updatePreview();
</script>
@endpush