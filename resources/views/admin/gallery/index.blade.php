@extends('layouts.app')

@section('title', 'Manajemen Galeri')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Manajemen Galeri</h1>
            <nav class="flex mt-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="text-gray-500 ml-1 md:ml-2">Galeri</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.gallery.create') }}" class="inline-flex items-center px-6 py-3 bg-[#14213d] hover:bg-[#0f1a2e] text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
            <i class="fas fa-plus mr-2"></i> Tambah Galeri
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-blue-500 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-blue-600 uppercase mb-1">Total Galeri</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['total'] }}</div>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-images text-3xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-green-500 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-green-600 uppercase mb-1">Featured</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['featured'] }}</div>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-star text-3xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-yellow-500 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-yellow-600 uppercase mb-1">Bulan Ini</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['this_month'] }}</div>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-calendar text-3xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-cyan-500 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-cyan-600 uppercase mb-1">Views Total</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['total_views'] ?? 0 }}</div>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-eye text-3xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-purple-500 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-purple-600 uppercase mb-1">Kategori</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['categories'] ?? 0 }}</div>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-tags text-3xl text-gray-300"></i>
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
            <form method="GET" action="{{ route('admin.gallery.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="search" name="search"
                               value="{{ request('search') }}" placeholder="Judul atau deskripsi...">
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
                        <label for="featured" class="block text-sm font-medium text-gray-700 mb-2">Status Featured</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="featured" name="featured">
                            <option value="">Semua Status</option>
                            <option value="1" {{ request('featured') == '1' ? 'selected' : '' }}>Featured</option>
                            <option value="0" {{ request('featured') == '0' ? 'selected' : '' }}>Non-Featured</option>
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
                            <a href="{{ route('admin.gallery.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                                <i class="fas fa-undo mr-2"></i> Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Gallery Table -->
    <div class="bg-white rounded-lg shadow-lg mb-6">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h6 class="text-lg font-semibold text-gray-900">Daftar Galeri</h6>
            <div class="flex space-x-2">
                <button type="button" class="inline-flex items-center px-4 py-2 bg-cyan-600 hover:bg-cyan-700 text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg" onclick="openBulkModal()">
                    <i class="fas fa-edit mr-2"></i> Bulk Update
                </button>
                <a href="{{ route('admin.gallery.export') }}?{{ http_build_query(request()->all()) }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                    <i class="fas fa-download mr-2"></i> Export CSV
                </a>
            </div>
        </div>
        <div class="p-6">
            @if($galleries->count() > 0)
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
                            @foreach($galleries as $gallery)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" name="selected_galleries[]" value="{{ $gallery->id }}">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex-shrink-0 h-16 w-16">
                                            <img class="h-16 w-16 rounded-lg object-cover shadow-sm" src="{{ $gallery->image_url }}" alt="{{ $gallery->title }}">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900 max-w-xs truncate">{{ $gallery->title }}</div>
                                                @if($gallery->is_featured)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 mt-1">
                                                        <i class="fas fa-star mr-1"></i> Featured
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $categories[$gallery->category] ?? $gallery->category }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($gallery->is_featured)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i> Featured
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                <i class="fas fa-circle mr-1"></i> Normal
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $gallery->user->name ?? 'Admin' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center">
                                            <i class="fas fa-eye text-gray-400 mr-1"></i>
                                            {{ $gallery->views ?? 0 }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div>{{ $gallery->created_at->format('d M Y') }}</div>
                                        <div class="text-xs text-gray-400">{{ $gallery->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('admin.gallery.show', $gallery) }}" class="text-cyan-600 hover:text-cyan-900 transition-colors duration-200" title="Lihat">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.gallery.edit', $gallery) }}" class="text-blue-600 hover:text-blue-900 transition-colors duration-200" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button onclick="deleteGallery({{ $gallery->id }})" class="text-red-600 hover:text-red-900 transition-colors duration-200" title="Hapus">
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
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Menampilkan {{ $galleries->firstItem() ?? 0 }} - {{ $galleries->lastItem() ?? 0 }} dari {{ $galleries->total() }} galeri
                        </div>
                        <div>
                            {{ $galleries->links() }}
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-16">
                    <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-images text-gray-400 text-3xl"></i>
                    </div>
                    <h5 class="text-xl font-semibold text-gray-900 mb-2">Belum ada galeri</h5>
                    <p class="text-gray-500 mb-6 max-w-md mx-auto">Mulai dengan menambahkan galeri pertama Anda untuk menampilkan konten visual yang menarik.</p>
                    <a href="{{ route('admin.gallery.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                        <i class="fas fa-plus mr-2"></i> Tambah Galeri Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Form -->
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@push('scripts')
<script>
// Select all checkboxes
document.getElementById('select-all').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('input[name="selected_galleries[]"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});

// Delete gallery
function deleteGallery(id) {
    if (confirm('Apakah Anda yakin ingin menghapus galeri ini?')) {
        const form = document.getElementById('deleteForm');
        form.action = `/admin/gallery/${id}`;
        form.submit();
    }
}

// Bulk modal functions
function openBulkModal() {
    const checkedBoxes = document.querySelectorAll('input[name="selected_galleries[]"]:checked');

    if (checkedBoxes.length === 0) {
        alert('Pilih minimal satu galeri untuk diupdate');
        return;
    }

    // Add bulk modal functionality here
    alert('Bulk update functionality will be implemented');
}
</script>
@endpush
@endsection
