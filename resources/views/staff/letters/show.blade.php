@extends('layouts.app')

@section('title', 'Detail Pengajuan Surat - Staff')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                Detail Pengajuan Surat #{{ $letter->id }}
            </h1>
            <nav class="flex mt-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('staff.dashboard') }}" class="text-gray-500 hover:text-gray-700">Dashboard</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('admin.letters.index') }}" class="ml-1 text-gray-500 hover:text-gray-700 md:ml-2">Pengajuan Surat</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-gray-500 md:ml-2">Detail #{{ $letter->id }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Request Information -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Informasi Pengajuan
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Pengajuan</label>
                        <p class="text-gray-900 font-mono bg-gray-50 p-2 rounded">{{ $letter->request_number ?? 'LTR-' . str_pad($letter->id, 6, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pengajuan</label>
                        <p class="text-gray-900">{{ $letter->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Surat</label>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $letter->letter_type_label }}
                        </span>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'processing' => 'bg-blue-100 text-blue-800',
                                'completed' => 'bg-green-100 text-green-800',
                                'rejected' => 'bg-red-100 text-red-800'
                            ];
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$letter->status] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ $letter->status_label }}
                        </span>
                    </div>
                </div>
                
                @if($letter->purpose)
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tujuan/Keperluan</label>
                    <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $letter->purpose }}</p>
                </div>
                @endif
            </div>

            <!-- Applicant Information -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Informasi Pemohon
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <p class="text-gray-900 font-semibold">{{ $letter->applicant_name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                        <p class="text-gray-900">{{ $letter->applicant_nik }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                        <p class="text-gray-900">{{ $letter->applicant_phone }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tempat, Tanggal Lahir</label>
                        <p class="text-gray-900">
                            {{ $letter->applicant_birth_place }}@if($letter->applicant_birth_date), {{ \Carbon\Carbon::parse($letter->applicant_birth_date)->format('d F Y') }}@endif
                        </p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                        <p class="text-gray-900">{{ $letter->applicant_gender ?? '-' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                        <p class="text-gray-900">{{ $letter->applicant_religion }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                        <p class="text-gray-900">{{ $letter->applicant_occupation }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kewarganegaraan</label>
                        <p class="text-gray-900">{{ $letter->applicant_nationality }}</p>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $letter->applicant_address }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <p class="text-gray-900">{{ $letter->applicant_email ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Notes Section -->
            @if($letter->notes || $letter->rejection_reason)
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Catatan
                </h2>
                
                @if($letter->notes)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Petugas</label>
                    <p class="text-gray-900 bg-blue-50 p-3 rounded-lg border border-blue-200">{{ $letter->notes }}</p>
                </div>
                @endif
                
                @if($letter->rejection_reason)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alasan Penolakan</label>
                    <p class="text-gray-900 bg-red-50 p-3 rounded-lg border border-red-200">{{ $letter->rejection_reason }}</p>
                </div>
                @endif
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Management -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Kelola Status</h3>
                
                <form action="{{ route('admin.letters.update-status', $letter) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="pending" {{ $letter->status === 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="processing" {{ $letter->status === 'processing' ? 'selected' : '' }}>Diproses</option>
                            <option value="completed" {{ $letter->status === 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="rejected" {{ $letter->status === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    
                    <div id="notes-section">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                        <textarea name="notes" id="notes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Tambahkan catatan...">{{ $letter->notes }}</textarea>
                    </div>
                    
                    <div id="rejection-section" style="display: none;">
                        <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan</label>
                        <textarea name="rejection_reason" id="rejection_reason" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="Jelaskan alasan penolakan...">{{ $letter->rejection_reason }}</textarea>
                    </div>
                    
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                        Update Status
                    </button>
                </form>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
                
                <div class="space-y-3">
                    <a href="{{ route('admin.letters.index') }}" class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300 inline-block text-center">
                        <i class="fas fa-list mr-2"></i>Kembali ke Daftar
                    </a>
                </div>
            </div>

            <!-- Contact Information -->
            @if($letter->user)
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
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
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
// Handle status change to show/hide rejection reason field
document.getElementById('status').addEventListener('change', function() {
    const rejectionSection = document.getElementById('rejection-section');
    const notesSection = document.getElementById('notes-section');
    
    if (this.value === 'rejected') {
        rejectionSection.style.display = 'block';
        notesSection.style.display = 'none';
    } else {
        rejectionSection.style.display = 'none';
        notesSection.style.display = 'block';
    }
});

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.getElementById('status');
    if (statusSelect.value === 'rejected') {
        document.getElementById('rejection-section').style.display = 'block';
        document.getElementById('notes-section').style.display = 'none';
    }
});
</script>
@endsection