<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Informasi Desa') }}
            </h2>
            <div class="flex space-x-2">
                <button onclick="openAddModal()" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>Tambah Informasi
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Village Overview -->
            <div class="bg-white shadow-lg rounded-xl mb-8 overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Profil Desa/Kelurahan</h3>
                </div>
                <div class="p-6">
                    @if($village)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Desa/Kelurahan</label>
                                <p class="text-lg font-semibold text-gray-900">{{ $village->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                                <p class="text-sm text-gray-900">{{ $village->district }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kabupaten/Kota</label>
                                <p class="text-sm text-gray-900">{{ $village->regency }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                                <p class="text-sm text-gray-900">{{ $village->province }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                                <p class="text-sm text-gray-900">{{ $village->postal_code ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Luas Wilayah</label>
                                <p class="text-sm text-gray-900">{{ $village->area ? number_format($village->area, 2) . ' km²' : '-' }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-6 flex justify-end">
                            <button onclick="openEditVillageModal()" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                                <i class="fas fa-edit mr-2"></i>Edit Profil Desa
                            </button>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H7m2 0v-5a2 2 0 012-2h2a2 2 0 012 2v5m-6 0V9a2 2 0 012-2h2a2 2 0 012 2v12"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada data desa</h3>
                            <p class="mt-1 text-sm text-gray-500">Silakan tambahkan informasi profil desa terlebih dahulu.</p>
                            <div class="mt-6">
                                <button onclick="openEditVillageModal()" 
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                                    <i class="fas fa-plus mr-2"></i>Tambah Profil Desa
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Village Information List -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Desa</h3>
                </div>
                
                @if($villageInfos->count() > 0)
                    <div class="divide-y divide-gray-200">
                        @foreach($villageInfos as $info)
                            <div class="p-6 hover:bg-gray-50">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-3 mb-2">
                                            <h4 class="text-lg font-medium text-gray-900">{{ $info->title }}</h4>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ ucfirst(str_replace('_', ' ', $info->type)) }}
                                            </span>
                                            @if($info->is_featured)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    <i class="fas fa-star mr-1"></i>Unggulan
                                                </span>
                                            @endif
                                        </div>
                                        
                                        @if($info->description)
                                            <p class="text-gray-600 mb-3 line-clamp-3">{{ Str::limit($info->description, 200) }}</p>
                                        @endif
                                        
                                        @if($info->image_path)
                                            <div class="mb-3">
                                                <img src="{{ Storage::url($info->image_path) }}" alt="{{ $info->title }}" 
                                                     class="w-32 h-24 object-cover rounded-lg">
                                            </div>
                                        @endif
                                        
                                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                                            <span><i class="fas fa-calendar mr-1"></i>{{ $info->created_at->format('d M Y') }}</span>
                                            <span><i class="fas fa-user mr-1"></i>{{ $info->createdBy?->name ?? 'System' }}</span>
                                            @if($info->updated_at != $info->created_at)
                                                <span><i class="fas fa-edit mr-1"></i>Diperbarui {{ $info->updated_at->format('d M Y') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center space-x-2 ml-4">
                                        <button onclick="viewInfo({{ $info->id }})" 
                                                class="text-blue-600 hover:text-blue-900 bg-blue-100 hover:bg-blue-200 px-3 py-1 rounded-lg transition-colors duration-200">
                                            <i class="fas fa-eye mr-1"></i>Lihat
                                        </button>
                                        <button onclick="editInfo({{ $info->id }})" 
                                                class="text-green-600 hover:text-green-900 bg-green-100 hover:bg-green-200 px-3 py-1 rounded-lg transition-colors duration-200">
                                            <i class="fas fa-edit mr-1"></i>Edit
                                        </button>
                                        <button onclick="deleteInfo({{ $info->id }})" 
                                                class="text-red-600 hover:text-red-900 bg-red-100 hover:bg-red-200 px-3 py-1 rounded-lg transition-colors duration-200">
                                            <i class="fas fa-trash mr-1"></i>Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $villageInfos->links() }}
                    </div>
                @else
                    <div class="px-6 py-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada informasi desa</h3>
                        <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan informasi tentang desa/kelurahan.</p>
                        <div class="mt-6">
                            <button onclick="openAddModal()" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                                <i class="fas fa-plus mr-2"></i>Tambah Informasi Pertama
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Add/Edit Village Info Modal -->
    <div id="infoModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Tambah Informasi Desa</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="infoForm" class="space-y-4">
                    @csrf
                    <input type="hidden" id="infoId" name="id">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul *</label>
                            <input type="text" id="title" name="title" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Jenis Informasi *</label>
                            <select id="type" name="type" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Pilih Jenis</option>
                                <option value="sejarah">Sejarah</option>
                                <option value="geografis">Geografis</option>
                                <option value="demografis">Demografis</option>
                                <option value="ekonomi">Ekonomi</option>
                                <option value="sosial_budaya">Sosial & Budaya</option>
                                <option value="fasilitas">Fasilitas</option>
                                <option value="potensi">Potensi Desa</option>
                                <option value="pemerintahan">Pemerintahan</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi *</label>
                        <textarea id="description" name="description" rows="4" required 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  placeholder="Masukkan deskripsi informasi desa..."></textarea>
                    </div>
                    
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                        <input type="file" id="image" name="image" accept="image/*" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB.</p>
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1" 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_featured" class="ml-2 block text-sm text-gray-900">
                            Jadikan informasi unggulan
                        </label>
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeModal()" 
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                            Batal
                        </button>
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                            <span id="submitText">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Village Modal -->
    <div id="villageModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Edit Profil Desa</h3>
                    <button onclick="closeVillageModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="villageForm" class="space-y-4">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="village_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Desa/Kelurahan *</label>
                            <input type="text" id="village_name" name="name" required value="{{ $village->name ?? '' }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="district" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan *</label>
                            <input type="text" id="district" name="district" required value="{{ $village->district ?? '' }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="regency" class="block text-sm font-medium text-gray-700 mb-1">Kabupaten/Kota *</label>
                            <input type="text" id="regency" name="regency" required value="{{ $village->regency ?? '' }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="province" class="block text-sm font-medium text-gray-700 mb-1">Provinsi *</label>
                            <input type="text" id="province" name="province" required value="{{ $village->province ?? '' }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                            <input type="text" id="postal_code" name="postal_code" value="{{ $village->postal_code ?? '' }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="area" class="block text-sm font-medium text-gray-700 mb-1">Luas Wilayah (km²)</label>
                            <input type="number" step="0.01" id="area" name="area" value="{{ $village->area ?? '' }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeVillageModal()" 
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                            Batal
                        </button>
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Info Modal -->
    <div id="viewModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-2/3 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900" id="viewTitle">Detail Informasi</h3>
                    <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <div id="viewContent" class="space-y-4">
                    <!-- Content will be loaded here -->
                </div>
                
                <div class="flex justify-end pt-4">
                    <button onclick="closeViewModal()" 
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function openAddModal() {
            document.getElementById('modalTitle').textContent = 'Tambah Informasi Desa';
            document.getElementById('submitText').textContent = 'Simpan';
            document.getElementById('infoForm').reset();
            document.getElementById('infoId').value = '';
            document.getElementById('infoModal').classList.remove('hidden');
        }

        function editInfo(id) {
            document.getElementById('modalTitle').textContent = 'Edit Informasi Desa';
            document.getElementById('submitText').textContent = 'Update';
            
            // Fetch info data
            fetch(`/staff/village-info/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const info = data.data;
                        document.getElementById('infoId').value = info.id;
                        document.getElementById('title').value = info.title;
                        document.getElementById('type').value = info.type;
                        document.getElementById('description').value = info.description;
                        document.getElementById('is_featured').checked = info.is_featured;
                        document.getElementById('infoModal').classList.remove('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data');
                });
        }

        function viewInfo(id) {
            fetch(`/staff/village-info/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const info = data.data;
                        document.getElementById('viewTitle').textContent = info.title;
                        
                        let content = `
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Informasi</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        ${info.type.replace('_', ' ').toUpperCase()}
                                    </span>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <p class="text-gray-900 whitespace-pre-wrap">${info.description}</p>
                                    </div>
                                </div>
                        `;
                        
                        if (info.image_path) {
                            content += `
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                                    <img src="/storage/${info.image_path}" alt="${info.title}" class="max-w-full h-auto rounded-lg">
                                </div>
                            `;
                        }
                        
                        content += `
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Dibuat</label>
                                        <p class="text-gray-900">${new Date(info.created_at).toLocaleDateString('id-ID')}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Diperbarui</label>
                                        <p class="text-gray-900">${new Date(info.updated_at).toLocaleDateString('id-ID')}</p>
                                    </div>
                                </div>
                            </div>
                        `;
                        
                        document.getElementById('viewContent').innerHTML = content;
                        document.getElementById('viewModal').classList.remove('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data');
                });
        }

        function deleteInfo(id) {
            if (confirm('Apakah Anda yakin ingin menghapus informasi ini?')) {
                fetch(`/staff/village-info/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus data');
                });
            }
        }

        function openEditVillageModal() {
            document.getElementById('villageModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('infoModal').classList.add('hidden');
        }

        function closeVillageModal() {
            document.getElementById('villageModal').classList.add('hidden');
        }

        function closeViewModal() {
            document.getElementById('viewModal').classList.add('hidden');
        }

        // Info Form Submit
        document.getElementById('infoForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const id = formData.get('id');
            const url = id ? `/staff/village-info/${id}` : '/staff/village-info';
            const method = id ? 'PUT' : 'POST';
            
            // Convert FormData to regular object for PUT requests
            if (method === 'PUT') {
                const data = {};
                for (let [key, value] of formData.entries()) {
                    if (key !== 'image' || value.size > 0) {
                        data[key] = value;
                    }
                }
                
                fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan data');
                });
            } else {
                fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan data');
                });
            }
        });

        // Village Form Submit
        document.getElementById('villageForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = {};
            for (let [key, value] of formData.entries()) {
                data[key] = value;
            }
            
            fetch('/staff/village-info/village', {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Terjadi kesalahan: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan data');
            });
        });
    </script>
    @endpush
</x-app-layout>