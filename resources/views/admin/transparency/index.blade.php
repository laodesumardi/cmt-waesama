@extends('layouts.app')

@section('title', 'Manajemen Transparansi')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Manajemen Transparansi</h1>
            <nav class="flex mt-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="text-gray-500 ml-1 md:ml-2">Transparansi</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.transparency.create') }}" class="inline-flex items-center px-6 py-3 bg-[#14213d] hover:bg-[#0f1a2e] text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
            <i class="fas fa-plus mr-2"></i> Tambah Data
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-6 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-blue-500 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-blue-600 uppercase mb-1">Total Data</div>
                    <div class="text-2xl font-bold text-gray-800">{{ number_format($stats['total']) }}</div>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-file-alt text-3xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-green-500 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-green-600 uppercase mb-1">Dipublikasikan</div>
                    <div class="text-2xl font-bold text-gray-800">{{ number_format($stats['published']) }}</div>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-3xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-yellow-500 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-yellow-600 uppercase mb-1">Draft</div>
                    <div class="text-2xl font-bold text-gray-800">{{ number_format($stats['draft']) }}</div>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-edit text-3xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-purple-500 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-purple-600 uppercase mb-1">Unggulan</div>
                    <div class="text-2xl font-bold text-gray-800">{{ number_format($stats['featured']) }}</div>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-star text-3xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-cyan-500 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-cyan-600 uppercase mb-1">Total Views</div>
                    <div class="text-2xl font-bold text-gray-800">{{ number_format($stats['total_views']) }}</div>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-eye text-3xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-indigo-500 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-indigo-600 uppercase mb-1">Total Downloads</div>
                    <div class="text-2xl font-bold text-gray-800">{{ number_format($stats['total_downloads'] ?? 0) }}</div>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-download text-3xl text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-lg mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h6 class="text-lg font-semibold text-gray-900">Filter & Pencarian</h6>
        </div>
        <div class="p-6">
            <form method="GET" action="{{ route('admin.transparency.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="search" name="search" 
                               value="{{ request('search') }}" placeholder="Cari judul atau deskripsi...">
                    </div>
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="category" name="category">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $key => $value)
                                <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Tipe</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="type" name="type">
                            <option value="">Semua Tipe</option>
                            @foreach($types as $key => $value)
                                <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="status" name="status">
                            <option value="">Semua Status</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Dipublikasikan</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="year" name="year">
                            <option value="">Semua Tahun</option>
                            @for($year = date('Y'); $year >= 2020; $year--)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">&nbsp;</label>
                        <div class="flex space-x-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#14213d] hover:bg-[#0f1a2e] text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                                <i class="fas fa-search mr-2"></i> Cari
                            </button>
                            <a href="{{ route('admin.transparency.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                                <i class="fas fa-undo mr-2"></i> Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h6 class="text-lg font-semibold text-gray-900">Daftar Data Transparansi</h6>
            <div class="flex space-x-2">
                <button type="button" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg" onclick="toggleBulkActions()">
                    <i class="fas fa-tasks mr-2"></i> Aksi Massal
                </button>
            </div>
        </div>
        <div class="p-6">
            <!-- Bulk Actions -->
            <div id="bulk-actions" class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6" style="display: none;">
                <form id="bulk-form" method="POST" action="{{ route('admin.transparency.bulk-update') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <div>
                            <select name="action" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                <option value="">Pilih Aksi</option>
                                <option value="publish">Publikasikan</option>
                                <option value="unpublish">Jadikan Draft</option>
                                <option value="feature">Jadikan Unggulan</option>
                                <option value="unfeature">Hapus dari Unggulan</option>
                                <option value="delete">Hapus</option>
                            </select>
                        </div>
                        <div class="flex space-x-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                                <i class="fas fa-check mr-2"></i> Jalankan
                            </button>
                            <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg" onclick="toggleBulkActions()">
                                <i class="fas fa-times mr-2"></i> Batal
                            </button>
                        </div>
                        <div>
                            <small class="text-gray-600">Pilih item dengan checkbox, lalu pilih aksi yang ingin dilakukan.</small>
                        </div>
                    </div>
                </form>
            </div>

            @if($transparencies->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-12">
                                    <input type="checkbox" id="select-all" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Views</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Downloads</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dibuat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-40">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($transparencies as $transparency)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" name="selected_items[]" value="{{ $transparency->id }}" class="item-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $transparency->title }}</div>
                                                @if($transparency->is_featured)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 mt-1">
                                                        <i class="fas fa-star mr-1"></i> Unggulan
                                                    </span>
                                                @endif
                                                @if($transparency->description)
                                                    <div class="text-sm text-gray-500 mt-1">{{ Str::limit($transparency->description, 100) }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ $transparency->category_display }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">{{ $transparency->type_display }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($transparency->period_start || $transparency->period_end)
                                            <div class="text-sm text-gray-900">
                                                {{ $transparency->period_start?->format('d/m/Y') ?? '-' }} - 
                                                {{ $transparency->period_end?->format('d/m/Y') ?? '-' }}
                                            </div>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($transparency->status === 'published')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i> Dipublikasikan
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-1"></i> Draft
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">{{ number_format($transparency->views) }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">{{ number_format($transparency->downloads) }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="text-sm text-gray-900">{{ $transparency->created_at->format('d/m/Y H:i') }}</div>
                                        <div class="text-sm text-gray-500">{{ $transparency->creator?->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.transparency.show', $transparency) }}" 
                                               class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-md transition-colors duration-200" title="Lihat">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.transparency.edit', $transparency) }}" 
                                               class="inline-flex items-center px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-medium rounded-md transition-colors duration-200" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-md transition-colors duration-200" 
                                                    onclick="deleteItem({{ $transparency->id }})" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="flex justify-between items-center mt-6">
                    <div>
                        <p class="text-sm text-gray-700">
                            Menampilkan {{ $transparencies->firstItem() }} - {{ $transparencies->lastItem() }} 
                            dari {{ $transparencies->total() }} data
                        </p>
                    </div>
                    <div>
                        {{ $transparencies->appends(request()->query())->links() }}
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <div class="mx-auto h-24 w-24 text-gray-300 mb-4">
                        <i class="fas fa-file-alt text-6xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada data transparansi</h3>
                    <p class="text-gray-500 mb-6">Belum ada data transparansi yang ditambahkan.</p>
                    <a href="{{ route('admin.transparency.create') }}" class="inline-flex items-center px-4 py-2 bg-[#14213d] hover:bg-[#0f1a2e] text-white font-semibold rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                        <i class="fas fa-plus mr-2"></i> Tambah Data Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Konfirmasi Hapus</h3>
                <button type="button" class="text-gray-400 hover:text-gray-600" onclick="closeDeleteModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="mb-4">
                <p class="text-sm text-gray-700 mb-2">Apakah Anda yakin ingin menghapus data transparansi ini?</p>
                <p class="text-sm text-red-600">Tindakan ini tidak dapat dibatalkan dan akan menghapus semua file terkait.</p>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-lg transition-colors duration-200" onclick="closeDeleteModal()">Batal</button>
                <form id="delete-form" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-colors duration-200">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleBulkActions() {
    const bulkActions = document.getElementById('bulk-actions');
    const isVisible = bulkActions.style.display !== 'none';
    bulkActions.style.display = isVisible ? 'none' : 'block';
    
    // Reset checkboxes if hiding
    if (isVisible) {
        document.querySelectorAll('.item-checkbox').forEach(cb => cb.checked = false);
        document.getElementById('select-all').checked = false;
    }
}

function deleteItem(id) {
    const form = document.getElementById('delete-form');
    form.action = `/admin/transparency/${id}`;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});

// Select all functionality
document.getElementById('select-all').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.item-checkbox');
    checkboxes.forEach(cb => cb.checked = this.checked);
});

// Bulk form submission
document.getElementById('bulk-form').addEventListener('submit', function(e) {
    const selectedItems = document.querySelectorAll('.item-checkbox:checked');
    if (selectedItems.length === 0) {
        e.preventDefault();
        alert('Pilih minimal satu item untuk diproses.');
        return;
    }
    
    const action = this.querySelector('[name="action"]').value;
    if (action === 'delete') {
        if (!confirm('Apakah Anda yakin ingin menghapus item yang dipilih?')) {
            e.preventDefault();
            return;
        }
    }
    
    // Add selected items to form
    selectedItems.forEach(cb => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'selected_items[]';
        input.value = cb.value;
        this.appendChild(input);
    });
});

// Toast notification function
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300 transform translate-x-full ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    }`;
    toast.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} mr-2"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(toast);
    
    // Show toast
    setTimeout(() => {
        toast.classList.remove('translate-x-full');
    }, 100);
    
    // Hide toast after 3 seconds
    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 3000);
}

// Show success message if exists
@if(session('success'))
    showToast('{{ session('success') }}', 'success');
@endif

// Show error message if exists
@if(session('error'))
    showToast('{{ session('error') }}', 'error');
@endif
</script>
@endpush