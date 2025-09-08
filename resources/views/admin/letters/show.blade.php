@extends('layouts.app')

@section('title', 'Manajemen Pengajuan Surat')

@section('content')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.letters.index') }}" class="text-gray-600 hover:text-gray-900 transition duration-300">
                    <i class="fas fa-arrow-left text-lg"></i>
                </a>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Detail Pengajuan #{{ $letter->request_number ?? 'LTR-' . str_pad($letter->id, 6, '0', STR_PAD_LEFT) }}
                </h2>
            </div>
            <div class="flex space-x-2">
                @if($letter->status !== 'completed' && $letter->status !== 'rejected')
                    <button onclick="updateStatus('processing')" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                        <i class="fas fa-cog mr-2"></i>Proses
                    </button>
                    <button onclick="updateStatus('completed')" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                        <i class="fas fa-check mr-2"></i>Selesai
                    </button>
                    <button onclick="updateStatus('rejected')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                        <i class="fas fa-times mr-2"></i>Tolak
                    </button>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Status Card -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Status Pengajuan</h3>
                                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $letter->status_color }}">
                                    {{ $letter->status_label }}
                                </span>
                            </div>

                            <!-- Progress Bar -->
                            <div class="mb-4">
                                <div class="flex justify-between text-sm text-gray-600 mb-2">
                                    <span>Progress</span>
                                    <span>{{ $letter->status === 'pending' ? '25%' : ($letter->status === 'processing' ? '75%' : '100%') }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full transition-all duration-300"
                                         style="width: {{ $letter->status === 'pending' ? '25%' : ($letter->status === 'processing' ? '75%' : '100%') }}"></div>
                                </div>
                            </div>

                            <!-- Timeline -->
                            <div class="space-y-3">
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">Pengajuan Dibuat</p>
                                        <p class="text-xs text-gray-500">{{ $letter->created_at->format('d F Y, H:i') }}</p>
                                    </div>
                                </div>

                                @if($letter->processed_at)
                                    <div class="flex items-center space-x-3">
                                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-900">Sedang Diproses</p>
                                            <p class="text-xs text-gray-500">{{ $letter->processed_at->format('d F Y, H:i') }}</p>
                                            @if($letter->processor)
                                                <p class="text-xs text-gray-500">oleh {{ $letter->processor->name }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if($letter->completed_at)
                                    <div class="flex items-center space-x-3">
                                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-900">Selesai</p>
                                            <p class="text-xs text-gray-500">{{ $letter->completed_at->format('d F Y, H:i') }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if($letter->status === 'rejected')
                                    <div class="flex items-center space-x-3">
                                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-900">Ditolak</p>
                                            <p class="text-xs text-gray-500">{{ $letter->updated_at->format('d F Y, H:i') }}</p>
                                            @if($letter->rejection_reason)
                                                <p class="text-xs text-red-600 mt-1">{{ $letter->rejection_reason }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Letter Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Surat</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Surat</label>
                                    <p class="text-sm text-gray-900">{{ $letter->letter_type_label }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Pengajuan</label>
                                    <p class="text-sm text-gray-900">{{ $letter->request_number ?? 'LTR-' . str_pad($letter->id, 6, '0', STR_PAD_LEFT) }}</p>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tujuan Penggunaan</label>
                                    <p class="text-sm text-gray-900">{{ $letter->purpose }}</p>
                                </div>

                                @if($letter->notes)
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                                        <p class="text-sm text-gray-900">{{ $letter->notes }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Applicant Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Pemohon</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                    <p class="text-sm text-gray-900">{{ $letter->applicant_name }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                                    <p class="text-sm text-gray-900">{{ $letter->applicant_nik }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tempat, Tanggal Lahir</label>
                                    <p class="text-sm text-gray-900">
                                        {{ $letter->applicant_birth_place ?? '-' }}@if($letter->applicant_birth_date), {{ \Carbon\Carbon::parse($letter->applicant_birth_date)->format('d F Y') }}@endif
                                    </p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                    <p class="text-sm text-gray-900">{{ $letter->applicant_gender ?? '-' }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                                    <p class="text-sm text-gray-900">{{ $letter->applicant_religion ? ucfirst($letter->applicant_religion) : '-' }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Perkawinan</label>
                                    <p class="text-sm text-gray-900">{{ $letter->applicant_marital_status ? ucfirst($letter->applicant_marital_status) : '-' }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                                    <p class="text-sm text-gray-900">{{ $letter->applicant_occupation ?? '-' }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Kewarganegaraan</label>
                                    <p class="text-sm text-gray-900">{{ $letter->applicant_nationality ?? '-' }}</p>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                    <p class="text-sm text-gray-900">{{ $letter->applicant_address ?? '-' }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                    <p class="text-sm text-gray-900">{{ $letter->applicant_phone ?? '-' }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <p class="text-sm text-gray-900">{{ $letter->applicant_email ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
                            <div class="space-y-3">
                                @if($letter->status !== 'completed' && $letter->status !== 'rejected')
                                    <button onclick="updateStatus('processing')" class="w-full bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                                        <i class="fas fa-cog mr-2"></i>Proses Surat
                                    </button>
                                    <button onclick="updateStatus('completed')" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                                        <i class="fas fa-check mr-2"></i>Tandai Selesai
                                    </button>
                                    <button onclick="updateStatus('rejected')" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                                        <i class="fas fa-times mr-2"></i>Tolak Pengajuan
                                    </button>
                                @endif
                                
                                <a href="{{ route('admin.letters.index') }}" class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300 inline-block text-center">
                                    <i class="fas fa-list mr-2"></i>Kembali ke Daftar
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    @if($letter->user)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Kontak Pemohon</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center space-x-3">
                                        <i class="fas fa-user text-gray-400"></i>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $letter->user->name }}</p>
                                            <p class="text-xs text-gray-500">Nama Pengguna</p>
                                        </div>
                                    </div>
                                    
                                    @if($letter->user->email)
                                        <div class="flex items-center space-x-3">
                                            <i class="fas fa-envelope text-gray-400"></i>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ $letter->user->email }}</p>
                                                <p class="text-xs text-gray-500">Email</p>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if($letter->applicant_phone)
                                        <div class="flex items-center space-x-3">
                                            <i class="fas fa-phone text-gray-400"></i>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ $letter->applicant_phone }}</p>
                                                <p class="text-xs text-gray-500">Telepon</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Status Update Modal -->
    <div id="statusModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4" id="modalTitle">Update Status</h3>
                <form id="statusForm">
                    @csrf
                    <input type="hidden" id="statusInput" name="status">
                    
                    <div class="mb-4">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                        <textarea id="notes" name="notes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tambahkan catatan (opsional)"></textarea>
                    </div>
                    
                    <div id="rejectionReasonDiv" class="mb-4 hidden">
                        <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan <span class="text-red-500">*</span></label>
                        <textarea id="rejection_reason" name="rejection_reason" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Jelaskan alasan penolakan"></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition duration-300">
                            Batal
                        </button>
                        <button type="submit" id="submitBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateStatus(status) {
            const modal = document.getElementById('statusModal');
            const modalTitle = document.getElementById('modalTitle');
            const statusInput = document.getElementById('statusInput');
            const rejectionDiv = document.getElementById('rejectionReasonDiv');
            const submitBtn = document.getElementById('submitBtn');
            
            statusInput.value = status;
            
            switch(status) {
                case 'processing':
                    modalTitle.textContent = 'Proses Surat';
                    submitBtn.textContent = 'Proses';
                    submitBtn.className = 'px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 transition duration-300';
                    rejectionDiv.classList.add('hidden');
                    break;
                case 'completed':
                    modalTitle.textContent = 'Tandai Selesai';
                    submitBtn.textContent = 'Selesai';
                    submitBtn.className = 'px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-300';
                    rejectionDiv.classList.add('hidden');
                    break;
                case 'rejected':
                    modalTitle.textContent = 'Tolak Pengajuan';
                    submitBtn.textContent = 'Tolak';
                    submitBtn.className = 'px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition duration-300';
                    rejectionDiv.classList.remove('hidden');
                    break;
            }
            
            modal.classList.remove('hidden');
        }
        
        function closeModal() {
            const modal = document.getElementById('statusModal');
            modal.classList.add('hidden');
            
            // Reset form
            document.getElementById('statusForm').reset();
        }
        
        document.getElementById('statusForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const status = formData.get('status');
            
            // Validate rejection reason if status is rejected
            if (status === 'rejected' && !formData.get('rejection_reason').trim()) {
                alert('Alasan penolakan harus diisi');
                return;
            }
            
            fetch(`{{ route('admin.letters.update-status', $letter) }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memperbarui status');
            });
        });
        
        // Close modal when clicking outside
        document.getElementById('statusModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
@endsection