<x-guest-public-layout>
    <x-slot name="title">Galeri</x-slot>

    <!-- Header Section -->
    <section class="relative bg-gradient-to-br from-[#14213d] via-[#1a2a4a] to-[#0f1a2e] text-white py-20 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-300 rounded-full blur-3xl transform translate-x-1/2 translate-y-1/2"></div>
        </div>
        
        <!-- Animated Pattern -->
        <div class="absolute inset-0 opacity-5">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="gallery-grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <circle cx="5" cy="5" r="1" fill="currentColor" class="animate-pulse"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#gallery-grid)"/>
            </svg>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <!-- Icon -->
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white/10 backdrop-blur-sm rounded-2xl mb-8 group">
                    <svg class="w-10 h-10 text-white group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                
                <h1 class="text-4xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-white to-gray-200 bg-clip-text text-transparent">
                    Galeri Foto
                </h1>
                <p class="text-xl md:text-2xl text-gray-200 max-w-3xl mx-auto leading-relaxed">
                    Dokumentasi kegiatan dan momen penting kecamatan dalam koleksi foto yang menginspirasi
                </p>
                
                <!-- Decorative Line -->
                <div class="mt-8 flex items-center justify-center">
                    <div class="h-px bg-gradient-to-r from-transparent via-white/30 to-transparent w-64"></div>
                    <div class="mx-4 w-2 h-2 bg-white/50 rounded-full"></div>
                    <div class="h-px bg-gradient-to-r from-transparent via-white/30 to-transparent w-64"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="relative py-12 bg-gradient-to-br from-gray-50 via-white to-blue-50 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="filter-grid" width="8" height="8" patternUnits="userSpaceOnUse">
                        <circle cx="4" cy="4" r="0.5" fill="currentColor" class="text-[#14213d]"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#filter-grid)"/>
            </svg>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-[#14213d] mb-2">Filter Kategori</h2>
                <p class="text-gray-600">Pilih kategori untuk melihat foto sesuai kebutuhan Anda</p>
            </div>
            
            <div class="flex flex-wrap justify-center gap-4">
                <button class="filter-btn active group relative overflow-hidden bg-gradient-to-r from-[#14213d] to-[#1a2a4a] text-white px-8 py-3 rounded-2xl font-semibold transition-all duration-300 hover:shadow-lg hover:scale-105 backdrop-blur-sm" data-filter="all">
                    <span class="relative z-10">Semua</span>
                    <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </button>
                <button class="filter-btn group relative overflow-hidden bg-white/70 backdrop-blur-sm hover:bg-white/90 text-[#14213d] px-8 py-3 rounded-2xl font-semibold transition-all duration-300 hover:shadow-lg hover:scale-105 border border-gray-200/50" data-filter="kegiatan">
                    <span class="relative z-10">Kegiatan</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-[#14213d]/5 to-[#1a2a4a]/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </button>
                <button class="filter-btn group relative overflow-hidden bg-white/70 backdrop-blur-sm hover:bg-white/90 text-[#14213d] px-8 py-3 rounded-2xl font-semibold transition-all duration-300 hover:shadow-lg hover:scale-105 border border-gray-200/50" data-filter="acara">
                    <span class="relative z-10">Acara</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-[#14213d]/5 to-[#1a2a4a]/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </button>
                <button class="filter-btn group relative overflow-hidden bg-white/70 backdrop-blur-sm hover:bg-white/90 text-[#14213d] px-8 py-3 rounded-2xl font-semibold transition-all duration-300 hover:shadow-lg hover:scale-105 border border-gray-200/50" data-filter="fasilitas">
                    <span class="relative z-10">Fasilitas</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-[#14213d]/5 to-[#1a2a4a]/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </button>
                <button class="filter-btn group relative overflow-hidden bg-white/70 backdrop-blur-sm hover:bg-white/90 text-[#14213d] px-8 py-3 rounded-2xl font-semibold transition-all duration-300 hover:shadow-lg hover:scale-105 border border-gray-200/50" data-filter="pembangunan">
                    <span class="relative z-10">Pembangunan</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-[#14213d]/5 to-[#1a2a4a]/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </button>
            </div>
        </div>
    </section>

    <!-- Gallery Content -->
    <section class="relative py-20 bg-gradient-to-br from-white via-gray-50 to-blue-50 overflow-hidden">
        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-gradient-to-br from-[#14213d]/10 to-blue-500/10 rounded-full blur-xl animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-32 h-32 bg-gradient-to-br from-blue-500/10 to-[#14213d]/10 rounded-full blur-xl animate-pulse" style="animation-delay: 2s;"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($galleries->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8" id="gallery-grid">
                    @foreach($galleries as $gallery)
                    <div class="gallery-item group relative overflow-hidden rounded-2xl bg-white/70 backdrop-blur-sm border border-gray-200/50 shadow-lg hover:shadow-2xl transition-all duration-500 cursor-pointer transform hover:scale-105 hover:-translate-y-2" 
                         data-category="{{ strtolower($gallery->category ?? 'kegiatan') }}"
                         onclick="openModal('{{ asset('storage/' . $gallery->image_path) }}', '{{ $gallery->title }}', '{{ $gallery->description }}', '{{ $gallery->created_at->format('d F Y') }}')">
                        @if($gallery->image_path)
                        <div class="relative overflow-hidden rounded-t-2xl">
                            <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        @else
                        <div class="w-full h-64 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center rounded-t-2xl">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        @endif
                        
                        <!-- Content Section -->
                        <div class="p-4">
                            <h4 class="font-bold text-[#14213d] mb-2 text-lg group-hover:text-blue-600 transition-colors duration-300">{{ $gallery->title }}</h4>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $gallery->description ?? 'Dokumentasi kegiatan kecamatan' }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">{{ $gallery->created_at->format('d M Y') }}</span>
                                <div class="flex items-center text-[#14213d] group-hover:text-blue-600 transition-colors duration-300">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    <span class="text-xs font-medium">Lihat</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Category Badge -->
                        @if($gallery->category)
                        <div class="absolute top-3 left-3">
                            <span class="inline-block bg-gradient-to-r from-[#14213d] to-[#1a2a4a] text-white text-xs px-3 py-1 rounded-full font-medium shadow-lg backdrop-blur-sm">
                                {{ ucfirst($gallery->category) }}
                            </span>
                        </div>
                        @endif
                        
                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-[#14213d]/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-16 flex justify-center">
                    <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-4 border border-gray-200/50 shadow-lg">
                        {{ $galleries->links() }}
                    </div>
                </div>
            @else
                <div class="text-center py-20">
                    <div class="bg-white/70 backdrop-blur-sm rounded-3xl p-12 border border-gray-200/50 shadow-lg max-w-md mx-auto">
                        <div class="w-20 h-20 bg-gradient-to-br from-[#14213d]/10 to-blue-500/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-[#14213d] mb-3">Belum Ada Foto</h3>
                        <p class="text-gray-600 leading-relaxed">Galeri foto akan ditampilkan di sini ketika sudah tersedia. Silakan kembali lagi nanti.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Modal for Image Preview -->
    <div id="imageModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="relative max-w-5xl max-h-full bg-white/95 backdrop-blur-md rounded-3xl overflow-hidden shadow-2xl border border-white/20 transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
            <!-- Close Button -->
            <button onclick="closeModal()" class="absolute top-6 right-6 z-20 bg-black/20 backdrop-blur-sm text-white rounded-full p-3 hover:bg-black/40 transition-all duration-300 group">
                <svg class="w-6 h-6 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            
            <!-- Image Container -->
            <div class="relative">
                <img id="modalImage" src="" alt="" class="w-full h-auto max-h-[70vh] object-contain">
                <!-- Gradient Overlay -->
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/50 via-transparent to-transparent h-32"></div>
            </div>
            
            <!-- Image Info -->
            <div class="p-8 bg-gradient-to-r from-white/90 to-gray-50/90 backdrop-blur-sm">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h3 id="modalTitle" class="text-2xl font-bold text-[#14213d] mb-3"></h3>
                        <p id="modalDescription" class="text-gray-600 mb-4 leading-relaxed"></p>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p id="modalDate" class="text-sm text-gray-500 font-medium"></p>
                        </div>
                    </div>
                    <div class="ml-6">
                        <button onclick="downloadImage()" class="bg-gradient-to-r from-[#14213d] to-[#1a2a4a] text-white px-6 py-3 rounded-2xl font-semibold hover:shadow-lg transition-all duration-300 flex items-center group">
                            <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Modal and Filter -->
    <script>
        let currentImageSrc = '';
        
        // Modal functions
        function openModal(imageSrc, title, description, date) {
            currentImageSrc = imageSrc;
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('modalDescription').textContent = description || 'Dokumentasi kegiatan kecamatan';
            document.getElementById('modalDate').textContent = date;
            
            const modal = document.getElementById('imageModal');
            const modalContent = document.getElementById('modalContent');
            
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            // Animate modal appearance
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }
        
        function closeModal() {
            const modal = document.getElementById('imageModal');
            const modalContent = document.getElementById('modalContent');
            
            // Animate modal disappearance
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 300);
        }
        
        function downloadImage() {
            if (currentImageSrc) {
                const link = document.createElement('a');
                link.href = currentImageSrc;
                link.download = 'gallery-image.jpg';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }
        
        // Close modal when clicking outside
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
        
        // Filter functionality with animations
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtns = document.querySelectorAll('.filter-btn');
            const galleryItems = document.querySelectorAll('.gallery-item');
            
            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const filter = this.getAttribute('data-filter');
                    
                    // Update active button with modern styling
                    filterBtns.forEach(b => {
                        b.classList.remove('active');
                        b.classList.remove('bg-gradient-to-r', 'from-[#14213d]', 'to-[#1a2a4a]', 'text-white');
                        b.classList.add('bg-white/70', 'text-[#14213d]', 'border', 'border-gray-200/50');
                    });
                    
                    this.classList.add('active');
                    this.classList.add('bg-gradient-to-r', 'from-[#14213d]', 'to-[#1a2a4a]', 'text-white');
                    this.classList.remove('bg-white/70', 'text-[#14213d]', 'border', 'border-gray-200/50');
                    
                    // Filter items with fade animation
                    galleryItems.forEach(item => {
                        if (filter === 'all' || item.getAttribute('data-category') === filter) {
                            item.style.display = 'block';
                            item.style.opacity = '0';
                            item.style.transform = 'translateY(20px)';
                            
                            setTimeout(() => {
                                item.style.transition = 'all 0.5s ease';
                                item.style.opacity = '1';
                                item.style.transform = 'translateY(0)';
                            }, 100);
                        } else {
                            item.style.transition = 'all 0.3s ease';
                            item.style.opacity = '0';
                            item.style.transform = 'translateY(-20px)';
                            
                            setTimeout(() => {
                                item.style.display = 'none';
                            }, 300);
                        }
                    });
                });
            });
            
            // Add stagger animation on page load
            galleryItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(30px)';
                
                setTimeout(() => {
                    item.style.transition = 'all 0.6s ease';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</x-guest-public-layout>