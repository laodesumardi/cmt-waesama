@extends('layouts.app')

@section('title', 'Manajemen Pengajuan Dokumen')

@section('content')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.documents.index') }}" class="text-gray-600 hover:text-gray-900 transition duration-300">
                    <i class="fas fa-arrow-left text-lg"></i>
                </a>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Detail Pengajuan #{{ $document->request_number ?? 'DOC-' . str_pad($document->id, 6, '0', STR_PAD_LEFT) }}
                </h2>
            </div>
            <div class="flex space-x-2">
                @if($document->status !== 'completed' && $document->status !== 'rejected')
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
                                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $document->status_color }}">
                                    {{ $document->status_label }}
                                </span>
                            </div>

                            <!-- Progress Bar -->
                            <div class="mb-4">
                                <div class="flex justify-between text-sm text-gray-600 mb-2">
                                    <span>Progress</span>
                                    <span>{{ $document->status === 'pending' ? '25%' : ($document->status === 'processing' ? '75%' : '100%') }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full transition-all duration-300"
                                         style="width: {{ $document->status === 'pending' ? '25%' : ($document->status === 'processing' ? '75%' : '100%') }}"></div>
                                </div>
                            </div>

                            <!-- Timeline -->
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-blue-600 rounded-full mr-3"></div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">Pengajuan Diterima</p>
                                        <p class="text-xs text-gray-500">{{ $document->created_at ? $document->created_at->format('d M Y, H:i') : '-' }}</p>
                                    </div>
                                </div>

                                @if($document->status !== 'pending')
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 {{ $document->status === 'processing' ? 'bg-yellow-600' : 'bg-blue-600' }} rounded-full mr-3"></div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-900">Sedang Diproses</p>
                                            <p class="text-xs text-gray-500">{{ $document->updated_at ? $document->updated_at->format('d M Y, H:i') : '-' }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if($document->status === 'completed')
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 bg-green-600 rounded-full mr-3"></div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-900">Dokumen Selesai</p>
                                            <p class="text-xs text-gray-500">{{ $document->updated_at ? $document->updated_at->format('d M Y, H:i') : '-' }}</p>
                                        </div>
                                    </div>
                                @elseif($document->status === 'rejected')
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 bg-red-600 rounded-full mr-3"></div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-900">Pengajuan Ditolak</p>
                                            <p class="text-xs text-gray-500">{{ $document->updated_at ? $document->updated_at->format('d M Y, H:i') : '-' }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Document Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Dokumen</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Dokumen</label>
                                    <p class="text-sm text-gray-900">{{ $document->document_type_label }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Keperluan</label>
                                    <p class="text-sm text-gray-900">{{ $document->purpose }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pengajuan</label>
                                    <p class="text-sm text-gray-900">{{ $document->created_at ? $document->created_at->format('d F Y, H:i') : '-' }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Estimasi Selesai</label>
                                    <p class="text-sm text-gray-900">{{ $document->created_at ? $document->created_at->addDays(3)->format('d F Y') : '-' }}</p>
                                </div>
                            </div>

                            @if($document->notes)
                                <div class="mt-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan</label>
                                    <p class="text-sm text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $document->notes }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- System Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Sistem</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">ID Pengajuan</label>
                                    <p class="text-sm text-gray-900 font-mono">{{ $document->id }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Pengajuan</label>
                                    <p class="text-sm text-gray-900 font-mono">{{ $document->request_number ?? 'DOC-' . str_pad($document->id, 6, '0', STR_PAD_LEFT) }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Dibuat</label>
                                    <p class="text-sm text-gray-900">{{ $document->created_at ? $document->created_at->format('d/m/Y H:i') : '-' }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Terakhir Update</label>
                                    <p class="text-sm text-gray-900">{{ $document->updated_at ? $document->updated_at->format('d/m/Y H:i') : '-' }}</p>
                                </div>
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
                                    <p class="text-sm text-gray-900">{{ $document->applicant_name }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                                    <p class="text-sm text-gray-900">{{ $document->applicant_nik }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tempat, Tanggal Lahir</label>
                                    <p class="text-sm text-gray-900">
                                        {{ $document->applicant_birth_place ?? '-' }}@if($document->applicant_birth_date), {{ \Carbon\Carbon::parse($document->applicant_birth_date)->format('d F Y') }}@endif
                                    </p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                    <p class="text-sm text-gray-900">{{ $document->applicant_gender ?? '-' }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                                    <p class="text-sm text-gray-900">{{ $document->applicant_religion ? ucfirst($document->applicant_religion) : '-' }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Perkawinan</label>
                                    <p class="text-sm text-gray-900">{{ $document->applicant_marital_status ? ucfirst($document->applicant_marital_status) : '-' }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                                    <p class="text-sm text-gray-900">{{ $document->applicant_occupation ?? '-' }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Kewarganegaraan</label>
                                    <p class="text-sm text-gray-900">{{ $document->applicant_nationality ?? '-' }}</p>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                    <p class="text-sm text-gray-900">{{ $document->applicant_address ?? '-' }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                    <p class="text-sm text-gray-900">{{ $document->applicant_phone ?? '-' }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <p class="text-sm text-gray-900">{{ $document->applicant_email ?? '-' }}</p>
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
                                @if($document->user)
                                    <a href="mailto:{{ $document->user->email }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300 flex items-center justify-center">
                                        <i class="fas fa-envelope mr-2"></i>Email Pemohon
                                    </a>
                                @endif

                                <a href="tel:{{ $document->phone }}" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300 flex items-center justify-center">
                                    <i class="fas fa-phone mr-2"></i>Telepon
                                </a>

                                <button onclick="printDocument()" class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300 flex items-center justify-center">
                                    <i class="fas fa-print mr-2"></i>Cetak Detail
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Processing Notes -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Catatan Pemrosesan</h3>
                            <form id="notes-form" onsubmit="saveNotes(event)">
                                <textarea name="processing_notes" id="processing_notes" rows="4"
                                          class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                          placeholder="Tambahkan catatan pemrosesan...">{{ $document->processing_notes }}</textarea>
                                <button type="submit" class="mt-3 w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                                    <i class="fas fa-save mr-2"></i>Simpan Catatan
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Document Info -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Sistem</h3>
                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">ID Pengajuan:</span>
                                    <span class="font-medium">{{ $document->id }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Nomor Pengajuan:</span>
                                    <span class="font-medium">{{ $document->request_number }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Dibuat:</span>
                                    <span class="font-medium">{{ $document->created_at ? $document->created_at->format('d/m/Y H:i') : '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Terakhir Update:</span>
                                    <span class="font-medium">{{ $document->updated_at ? $document->updated_at->format('d/m/Y H:i') : '-' }}</span>
                                </div>
                                @if($document->processor)
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Diproses oleh:</span>
                                        <span class="font-medium">{{ $document->processor->name }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function updateStatus(status) {
            let message = '';
            switch(status) {
                case 'processing':
                    message = 'Apakah Anda yakin ingin memproses pengajuan ini?';
                    break;
                case 'completed':
                    message = 'Apakah Anda yakin pengajuan ini sudah selesai?';
                    break;
                case 'rejected':
                    message = 'Apakah Anda yakin ingin menolak pengajuan ini?';
                    break;
            }

            if (confirm(message)) {
                fetch(`{{ route('admin.documents.updateStatus', $document) }}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ status: status })
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
                    alert('Terjadi kesalahan saat mengupdate status');
                });
            }
        }

        function saveNotes(event) {
            event.preventDefault();
            const notes = document.getElementById('processing_notes').value;

            fetch(`{{ route('admin.documents.updateStatus', $document) }}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ processing_notes: notes })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Catatan berhasil disimpan');
                } else {
                    alert('Terjadi kesalahan: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan catatan');
            });
        }

        function printDocument() {
            window.print();
        }
    </script>
    @endpush

    @push('styles')
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
    @endpush
@endsection
