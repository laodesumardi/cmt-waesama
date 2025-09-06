@extends('layouts.app')

@section('title', 'Manajemen Berita')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Manajemen Berita</h1>
            <nav class="flex mt-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="text-gray-500 ml-1 md:ml-2">Berita</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.news.create') }}" class="inline-flex items-center px-6 py-3 bg-[#14213d] hover:bg-[#0f1a2e] text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
            <i class="fas fa-plus mr-2"></i> Tambah Berita
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-blue-500 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-blue-600 uppercase mb-1">Total Berita</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['total'] }}</div>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-newspaper text-3xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-green-500 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-green-600 uppercase mb-1">Published</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['published'] }}</div>
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
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['draft'] }}</div>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-edit text-3xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-cyan-500 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-cyan-600 uppercase mb-1">Bulan Ini</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['this_month'] }}</div>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-calendar text-3xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-purple-500 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-purple-600 uppercase mb-1">Featured</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['featured'] }}</div>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-star text-3xl text-gray-300"></i>
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
            <form method="GET" action="{{ route('admin.news.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="search" name="search" 
                               value="{{ request('search') }}" placeholder="Judul atau konten...">
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
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="status" name="status">
                            <option value="">Semua Status</option>
                            @foreach($statuses as $key => $value)
                                <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="sort" class="block text-sm font-medium text-gray-700 mb-2">Urutkan</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="sort" name="sort">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Judul A-Z</option>
                            <option value="views" {{ request('sort') == 'views' ? 'selected' : '' }}>Paling Dilihat</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">&nbsp;</label>
                        <div class="flex space-x-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#14213d] hover:bg-[#0f1a2e] text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                                <i class="fas fa-search mr-2"></i> Cari
                            </button>
                            <a href="{{ route('admin.news.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                                <i class="fas fa-undo mr-2"></i> Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- News Table -->
    <div class="bg-white rounded-lg shadow-lg mb-6">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h6 class="text-lg font-semibold text-gray-900">Daftar Berita</h6>
            <div class="flex space-x-2">
                <button type="button" class="inline-flex items-center px-4 py-2 bg-cyan-600 hover:bg-cyan-700 text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg" onclick="openBulkModal()">
                    <i class="fas fa-edit mr-2"></i> Bulk Update
                </button>
                <a href="{{ route('admin.news.export') }}?{{ http_build_query(request()->all()) }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                    <i class="fas fa-download mr-2"></i> Export CSV
                </a>
            </div>
        </div>
        <div class="p-6">
            @if($news->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="dataTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-8">
                                    <input type="checkbox" id="select-all" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penulis</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Views</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($news as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="news-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="{{ $item->id }}">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($item->featured_image)
                                            <img src="{{ asset('storage/' . $item->featured_image) }}" 
                                                 alt="{{ $item->title }}" class="w-15 h-10 object-cover rounded border border-gray-200">
                                        @else
                                            <div class="w-15 h-10 bg-gray-100 flex items-center justify-center rounded border border-gray-200">
                                                <i class="fas fa-image text-gray-400"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-900">{{ Str::limit($item->title, 50) }}</div>
                                        @if($item->is_featured)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 mt-1">Featured</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">{{ $categories[$item->category] ?? $item->category }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($item->status == 'published')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Published</span>
                                        @elseif($item->status == 'draft')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Draft</span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Archived</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->author->name ?? 'Unknown' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ number_format($item->views) }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">
                                            {{ $item->created_at->format('d/m/Y') }}<br>
                                            {{ $item->created_at->format('H:i') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-1">
                                            <a href="{{ route('admin.news.show', $item) }}" class="inline-flex items-center p-2 bg-cyan-600 hover:bg-cyan-700 text-white rounded-md transition-colors duration-200" title="Lihat">
                                                <i class="fas fa-eye text-xs"></i>
                                            </a>
                                            <a href="{{ route('admin.news.edit', $item) }}" class="inline-flex items-center p-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-md transition-colors duration-200" title="Edit">
                                                <i class="fas fa-edit text-xs"></i>
                                            </a>
                                            <button type="button" class="inline-flex items-center p-2 bg-red-600 hover:bg-red-700 text-white rounded-md transition-colors duration-200" 
                                                    onclick="deleteNews({{ $item->id }})" title="Hapus">
                                                <i class="fas fa-trash text-xs"></i>
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
                        <p class="text-sm text-gray-500">
                            Menampilkan {{ $news->firstItem() }} sampai {{ $news->lastItem() }} 
                            dari {{ $news->total() }} berita
                        </p>
                    </div>
                    <div>
                        {{ $news->appends(request()->query())->links() }}
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-newspaper text-5xl text-gray-400 mb-4"></i>
                    <h5 class="text-xl font-medium text-gray-500 mb-2">Belum ada berita</h5>
                    <p class="text-gray-500 mb-6">Mulai dengan menambahkan berita pertama Anda.</p>
                    <a href="{{ route('admin.news.create') }}" class="inline-flex items-center px-4 py-2 bg-[#14213d] hover:bg-[#0f1a2e] text-white font-medium rounded-md transition-colors duration-200">
                        <i class="fas fa-plus mr-2"></i> Tambah Berita
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Bulk Update Modal -->
<div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" id="bulkUpdateModal">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Bulk Update Berita</h3>
                <button type="button" class="text-gray-400 hover:text-gray-600" onclick="closeBulkModal()">
                    <span class="sr-only">Close</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form id="bulkUpdateForm" method="POST" action="{{ route('admin.news.bulk-update') }}">
                @csrf
                <div class="space-y-4">
                    <input type="hidden" id="selected_ids" name="selected_ids">
                    
                    <div>
                        <label for="bulk_status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="bulk_status" name="status">
                            <option value="">Tidak diubah</option>
                            @foreach($statuses as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label for="bulk_category" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="bulk_category" name="category">
                            <option value="">Tidak diubah</option>
                            @foreach($categories as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <div class="flex items-center">
                            <input class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" type="checkbox" id="bulk_featured" name="is_featured" value="1">
                            <label class="ml-2 text-sm text-gray-700" for="bulk_featured">
                                Set sebagai Featured
                            </label>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-md transition-colors duration-200" onclick="closeBulkModal()">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-[#14213d] hover:bg-[#0f1a2e] text-white font-medium rounded-md transition-colors duration-200">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Form -->
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
// Select all checkbox
document.getElementById('select-all').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.news-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});

// Update select all when individual checkboxes change
document.querySelectorAll('.news-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const allCheckboxes = document.querySelectorAll('.news-checkbox');
        const checkedCheckboxes = document.querySelectorAll('.news-checkbox:checked');
        const selectAllCheckbox = document.getElementById('select-all');
        
        if (checkedCheckboxes.length === allCheckboxes.length) {
            selectAllCheckbox.checked = true;
        } else {
            selectAllCheckbox.checked = false;
        }
    });
});

// Bulk update form
document.getElementById('bulkUpdateForm').addEventListener('submit', function(e) {
    const selectedIds = Array.from(document.querySelectorAll('.news-checkbox:checked')).map(cb => cb.value);
    
    if (selectedIds.length === 0) {
        e.preventDefault();
        alert('Pilih minimal satu berita untuk diupdate.');
        return;
    }
    
    document.getElementById('selected_ids').value = selectedIds.join(',');
});

// Bulk update modal functions
function openBulkModal() {
    const checkedBoxes = document.querySelectorAll('.news-checkbox:checked');
    if (checkedBoxes.length === 0) {
        alert('Pilih minimal satu berita untuk diupdate');
        return;
    }
    document.getElementById('bulkUpdateModal').classList.remove('hidden');
}

function closeBulkModal() {
    document.getElementById('bulkUpdateModal').classList.add('hidden');
}

// Delete news function
function deleteNews(id) {
    if (confirm('Apakah Anda yakin ingin menghapus berita ini?')) {
        const form = document.getElementById('deleteForm');
        form.action = `/admin/news/${id}`;
        form.submit();
    }
}
</script>
@endpush

@push('styles')
<style>
.w-15 {
    width: 60px;
}

.h-10 {
    height: 40px;
}
</style>
@endpush