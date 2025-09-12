<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Permohonan') }} - {{ $documentRequest->request_number }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('staff.services.index') }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Request Details -->
                    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Informasi Permohonan</h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Permohonan</label>
                                    <p class="text-sm text-gray-900 font-mono bg-gray-100 px-3 py-2 rounded">{{ $documentRequest->request_number }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Permohonan</label>
                                    <p class="text-sm text-gray-900">{{ $documentRequest->created_at->format('d F Y, H:i') }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Dokumen</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ strtoupper(str_replace('_', ' ', $documentRequest->document_type)) }}
                                    </span>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Metode Pengambilan</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ ucfirst($documentRequest->pickup_method) }}
                                    </span>
                                </div>
                            </div>
                            
                            @if($documentRequest->purpose)
                                <div class="mt-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Keperluan</label>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <p class="text-gray-900">{{ $documentRequest->purpose }}</p>
                                    </div>
                                </div>
                            @endif
                            
                            @if($documentRequest->notes)
                                <div class="mt-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Tambahan</label>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <p class="text-gray-900 whitespace-pre-wrap">{{ $documentRequest->notes }}</p>
                                    </div>
                                </div>
                            @endif
                            
                            @if($documentRequest->supporting_documents)
                                <div class="mt-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Dokumen Pendukung</label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @foreach(json_decode($documentRequest->supporting_documents, true) as $document)
                                            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                                </svg>
                                                <div class="flex-1">
                                                    <p class="text-sm font-medium text-gray-900">{{ $document['name'] ?? 'Dokumen' }}</p>
                                                    <a href="{{ Storage::url($document['path']) }}" target="_blank" 
                                                       class="text-xs text-blue-600 hover:text-blue-800">
                                                        Lihat Dokumen
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Applicant Information -->
                    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Informasi Pemohon</h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                    <p class="text-sm text-gray-900">{{ $documentRequest->applicant_name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                                    <p class="text-sm text-gray-900 font-mono">{{ $documentRequest->applicant_nik }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <p class="text-sm text-gray-900">{{ $documentRequest->applicant_email }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                    <p class="text-sm text-gray-900">{{ $documentRequest->applicant_phone ?? '-' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                                    <p class="text-sm text-gray-900">{{ $documentRequest->birth_place ?? '-' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                    <p class="text-sm text-gray-900">{{ $documentRequest->birth_date ? \Carbon\Carbon::parse($documentRequest->birth_date)->format('d F Y') : '-' }}</p>
                                </div>
                            </div>
                            
                            @if($documentRequest->applicant_address)
                                <div class="mt-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                    <p class="text-sm text-gray-900">{{ $documentRequest->applicant_address }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Processing Notes -->
                    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Catatan Pemrosesan</h3>
                        </div>
                        <div class="p-6">
                            <form id="notesForm" class="space-y-4">
                                @csrf
                                <div>
                                    <label for="processing_notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan Internal</label>
                                    <textarea id="processing_notes" name="processing_notes" rows="4" 
                                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                              placeholder="Tambahkan catatan pemrosesan untuk permohonan ini...">{{ $documentRequest->processing_notes }}</textarea>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" 
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                        Simpan Catatan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Status Management -->
                    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Kelola Status</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Saat Ini</label>
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'processing' => 'bg-blue-100 text-blue-800',
                                            'completed' => 'bg-green-100 text-green-800',
                                            'rejected' => 'bg-red-100 text-red-800'
                                        ];
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusColors[$documentRequest->status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($documentRequest->status) }}
                                    </span>
                                </div>
                                
                                <form id="statusForm" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Ubah Status</label>
                                        <select id="status" name="status" 
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="pending" {{ $documentRequest->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                            <option value="processing" {{ $documentRequest->status == 'processing' ? 'selected' : '' }}>Diproses</option>
                                            <option value="completed" {{ $documentRequest->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                            <option value="rejected" {{ $documentRequest->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                    </div>
                                    
                                    <div id="rejectionReasonDiv" style="display: {{ $documentRequest->status == 'rejected' ? 'block' : 'none' }};">
                                        <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan</label>
                                        <textarea id="rejection_reason" name="rejection_reason" rows="3" 
                                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                  placeholder="Jelaskan alasan penolakan...">{{ $documentRequest->rejection_reason }}</textarea>
                                    </div>
                                    
                                    <button type="submit" 
                                            class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                        Update Status
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Document Generation -->
                    @if($documentRequest->status == 'completed')
                        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900">Dokumen</h3>
                            </div>
                            <div class="p-6">
                                <div class="space-y-4">
                                    @if($documentRequest->generated_document_path)
                                        <div class="flex items-center space-x-3 p-3 bg-green-50 rounded-lg">
                                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-green-900">Dokumen Siap</p>
                                                <a href="{{ Storage::url($documentRequest->generated_document_path) }}" target="_blank" 
                                                   class="text-xs text-green-700 hover:text-green-900">
                                                    Download Dokumen
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <button onclick="generateDocument()" 
                                                class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                            <i class="fas fa-file-pdf mr-2"></i>Generate Dokumen
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Pickup Information -->
                    @if($documentRequest->pickup_method == 'pickup' && $documentRequest->status == 'completed')
                        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900">Informasi Pengambilan</h3>
                            </div>
                            <div class="p-6">
                                <div class="space-y-3">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Metode:</span>
                                        <span class="text-gray-900">Ambil di Kantor</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Status Pengambilan:</span>
                                        <span class="text-gray-900">{{ $documentRequest->pickup_status ?? 'Belum Diambil' }}</span>
                                    </div>
                                    @if(!$documentRequest->pickup_date)
                                        <button onclick="markAsPickedUp()" 
                                                class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                            <i class="fas fa-check mr-2"></i>Tandai Sudah Diambil
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Metadata -->
                    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Informasi Tambahan</h3>
                        </div>
                        <div class="p-6 space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Dibuat:</span>
                                <span class="text-gray-900">{{ $documentRequest->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Diperbarui:</span>
                                <span class="text-gray-900">{{ $documentRequest->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                            @if($documentRequest->processed_by)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Diproses oleh:</span>
                                    <span class="text-gray-900">{{ $documentRequest->processedBy?->name ?? 'System' }}</span>
                                </div>
                            @endif
                            @if($documentRequest->completed_at)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Selesai pada:</span>
                                    <span class="text-gray-900">{{ \Carbon\Carbon::parse($documentRequest->completed_at)->format('d/m/Y H:i') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Status Form
        document.getElementById('statusForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const status = formData.get('status');
            const rejectionReason = formData.get('rejection_reason');
            
            const requestData = { status };
            if (status === 'rejected' && rejectionReason) {
                requestData.rejection_reason = rejectionReason;
            }
            
            fetch(`{{ route('staff.services.updateStatus', $documentRequest) }}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(requestData)
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
                alert('Terjadi kesalahan saat mengupdate status');
            });
        });

        // Notes Form
        document.getElementById('notesForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch(`{{ route('staff.services.save-notes', $documentRequest) }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    processing_notes: formData.get('processing_notes')
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Catatan berhasil disimpan');
                } else {
                    alert('Terjadi kesalahan: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan catatan');
            });
        });

        // Show/hide rejection reason
        document.getElementById('status').addEventListener('change', function() {
            const rejectionDiv = document.getElementById('rejectionReasonDiv');
            if (this.value === 'rejected') {
                rejectionDiv.style.display = 'block';
            } else {
                rejectionDiv.style.display = 'none';
            }
        });

        function generateDocument() {
            if (confirm('Generate dokumen untuk permohonan ini?')) {
                fetch(`{{ route('staff.services.generate-document', $documentRequest) }}`, {
                    method: 'POST',
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
                    alert('Terjadi kesalahan saat generate dokumen');
                });
            }
        }

        function markAsPickedUp() {
            if (confirm('Tandai dokumen sudah diambil?')) {
                fetch(`{{ route('staff.services.mark-picked-up', $documentRequest) }}`, {
                    method: 'POST',
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
                    alert('Terjadi kesalahan saat menandai pengambilan');
                });
            }
        }
    </script>
    @endpush
</x-app-layout>