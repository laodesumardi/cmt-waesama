@extends('layouts.app')

@section('title', 'Detail Galeri - ' . $gallery->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Detail Galeri</h1>
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
                            <a href="{{ route('admin.gallery.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">
                                Galeri
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
            <a href="{{ route('admin.gallery.edit', $gallery->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition-colors duration-200">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <a href="{{ route('admin.gallery.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-md transition-colors duration-200">
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
                        <h6 class="text-lg font-semibold text-[#14213d]">Informasi Galeri</h6>
                        @if($gallery->is_featured)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-star mr-1"></i> Featured
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                <i class="fas fa-circle mr-1"></i> Normal
                            </span>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    <!-- Title -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul Galeri</label>
                        <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-900">
                            {{ $gallery->title }}
                        </div>
                    </div>

                    <!-- Description -->
                    @if($gallery->description)
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-700 min-h-[80px]">
                            {{ $gallery->description }}
                        </div>
                    </div>
                    @endif

                    <!-- Location -->
                    @if($gallery->location)
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                        <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-900">
                            <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                            {{ $gallery->location }}
                        </div>
                    </div>
                    @endif

                    <!-- Event Date -->
                    @if($gallery->event_date)
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Event</label>
                        <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-900">
                            <i class="fas fa-calendar text-blue-500 mr-2"></i>
                            {{ $gallery->event_date->format('d F Y') }}
                        </div>
                    </div>
                    @endif

                    <!-- Gallery Image -->
                    @if($gallery->image_path)
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Galeri</label>
                        <div class="relative cursor-pointer" onclick="viewFullImage('{{ asset('storage/' . $gallery->image_path) }}')">
                            <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}" class="rounded-lg border border-gray-200 max-w-md hover:shadow-lg transition-shadow duration-200">
                            <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center rounded-lg">
                                <i class="fas fa-search-plus text-white text-xl opacity-0 hover:opacity-100 transition-opacity duration-300"></i>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <!-- Gallery Information -->
            <div class="bg-white rounded-lg shadow-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-[#14213d]">Informasi Publikasi</h6>
                </div>
                <div class="p-6">
                    <!-- Category -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-900">
                            @php
                                $categories = [
                                    'kegiatan' => 'Kegiatan',
                                    'acara' => 'Acara',
                                    'infrastruktur' => 'Infrastruktur',
                                    'lingkungan' => 'Lingkungan',
                                    'masyarakat' => 'Masyarakat',
                                    'pemerintahan' => 'Pemerintahan',
                                    'lainnya' => 'Lainnya',
                                ];
                            @endphp
                            {{ $categories[$gallery->category] ?? $gallery->category }}
                        </div>
                    </div>

                    <!-- Author -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Penulis</label>
                        <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-900">
                            <i class="fas fa-user text-gray-500 mr-2"></i>
                            {{ $gallery->uploader->name ?? 'Admin' }}
                        </div>
                    </div>

                    <!-- Views -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Total Views</label>
                        <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-900">
                            <i class="fas fa-eye text-gray-500 mr-2"></i>
                            {{ $gallery->views ?? 0 }} kali dilihat
                        </div>
                    </div>

                    <!-- Created Date -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Dibuat</label>
                        <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-900">
                            <i class="fas fa-clock text-gray-500 mr-2"></i>
                            {{ $gallery->created_at->format('d F Y, H:i') }} WIB
                        </div>
                    </div>

                    <!-- Updated Date -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Terakhir Diupdate</label>
                        <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-900">
                            <i class="fas fa-edit text-gray-500 mr-2"></i>
                            {{ $gallery->updated_at->format('d F Y, H:i') }} WIB
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-[#14213d]">Aksi</h6>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <a href="{{ route('admin.gallery.edit', $gallery->id) }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition-colors duration-200">
                            <i class="fas fa-edit mr-2"></i> Edit Galeri
                        </a>
                        
                        <button type="button" onclick="toggleFeatured({{ $gallery->id }})" class="w-full inline-flex items-center justify-center px-4 py-2 {{ $gallery->is_featured ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-700' }} text-white font-medium rounded-md transition-colors duration-200">
                            <i class="fas fa-star mr-2"></i> 
                            {{ $gallery->is_featured ? 'Hapus Featured' : 'Jadikan Featured' }}
                        </button>
                        
                        <button type="button" onclick="deleteGallery({{ $gallery->id }})" class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-md transition-colors duration-200">
                            <i class="fas fa-trash mr-2"></i> Hapus Galeri
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden flex items-center justify-center p-4">
    <div class="relative max-w-4xl max-h-full">
        <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white hover:text-gray-300 text-2xl z-10">
            <i class="fas fa-times"></i>
        </button>
        <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg">
    </div>
</div>
@endsection

@push('scripts')
<script>
// View full image
function viewFullImage(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModal').classList.remove('hidden');
}

// Close image modal
function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImageModal();
    }
});

// Toggle featured status
function toggleFeatured(galleryId) {
    if (confirm('Apakah Anda yakin ingin mengubah status featured galeri ini?')) {
        fetch(`/admin/gallery/${galleryId}/toggle-featured`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Terjadi kesalahan: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengubah status featured.');
        });
    }
}

// Delete gallery
function deleteGallery(galleryId) {
    if (confirm('Apakah Anda yakin ingin menghapus galeri ini? Tindakan ini tidak dapat dibatalkan.')) {
        fetch(`/admin/gallery/${galleryId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '{{ route("admin.gallery.index") }}';
            } else {
                alert('Terjadi kesalahan: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus galeri.');
        });
    }
}
</script>
@endpush