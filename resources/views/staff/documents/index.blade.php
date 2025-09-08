@extends('layouts.app')

@section('title', 'Manajemen Dokumen - Staff')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                Manajemen Dokumen
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
                            <span class="text-gray-500 ml-1">Manajemen Dokumen</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-blue-600 uppercase mb-1">Total Pengajuan</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['total'] }}</div>
                </div>
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-yellow-600 uppercase mb-1">Menunggu</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['pending'] }}</div>
                </div>
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-orange-600 uppercase mb-1">Diproses</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['processing'] }}</div>
                </div>
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-green-600 uppercase mb-1">Selesai</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['completed'] }}</div>
                </div>
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border border-gray-100">
        <form method="GET" action="{{ route('staff.documents.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                           placeholder="Nama pemohon atau NIK..." 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Semua Status</option>
                        @foreach($statuses as $value => $label)
                            <option value="{{ $value }}" {{ request('status') == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="document_type" class="block text-sm font-medium text-gray-700 mb-2">Jenis Dokumen</label>
                    <select name="document_type" id="document_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Semua Jenis</option>
                        @foreach($documentTypes as $value => $label)
                            <option value="{{ $value }}" {{ request('document_type') == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="flex items-end space-x-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Filter
                    </button>
                    <a href="{{ route('staff.documents.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Documents Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Daftar Pengajuan Dokumen</h3>
        </div>
        
        @if($requests->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pengajuan
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pemohon
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jenis Dokumen
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($requests as $request)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">#{{ $request->id }}</div>
                                    <div class="text-sm text-gray-500">
                                        @if($request->created_at)
                                            {{ $request->created_at->format('d/m/Y H:i') }}
                                        @else
                                            Tanggal tidak tersedia
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $request->applicant_name }}</div>
                                    <div class="text-sm text-gray-500">NIK: {{ $request->applicant_nik }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $documentTypes[$request->document_type] ?? $request->document_type }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusClasses = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'processing' => 'bg-blue-100 text-blue-800',
                                            'completed' => 'bg-green-100 text-green-800',
                                            'rejected' => 'bg-red-100 text-red-800'
                                        ];
                                    @endphp
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusClasses[$request->status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ $statuses[$request->status] ?? $request->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($request->created_at)
                                        {{ $request->created_at->format('d/m/Y') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('staff.documents.show', $request) }}" 
                                           class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs transition-colors duration-200">
                                            Lihat Detail
                                        </a>
                                        
                                        @if($request->status === 'pending')
                                            <button onclick="updateStatus({{ $request->id }}, 'processing')" 
                                                    class="bg-orange-600 hover:bg-orange-700 text-white px-3 py-1 rounded text-xs transition-colors duration-200">
                                                Proses
                                            </button>
                                        @endif
                                        
                                        @if($request->status === 'processing')
                                            <button onclick="updateStatus({{ $request->id }}, 'completed')" 
                                                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs transition-colors duration-200">
                                                Selesai
                                            </button>
                                            <button onclick="updateStatus({{ $request->id }}, 'rejected')" 
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs transition-colors duration-200">
                                                Tolak
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $requests->appends(request()->query())->links() }}
            </div>
        @else
            <div class="px-6 py-12 text-center">
                <div class="flex flex-col items-center justify-center space-y-4">
                    <div class="bg-gray-100 p-6 rounded-full">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="space-y-2">
                        <p class="text-xl font-bold text-gray-700">Tidak ada pengajuan dokumen</p>
                        <p class="text-sm text-gray-500 max-w-md">Belum ada pengajuan dokumen yang masuk. Data akan muncul di sini setelah ada pengajuan baru.</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Loading Overlay -->
<div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
        <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
        <span class="text-gray-700">Memproses...</span>
    </div>
</div>

<!-- Notification -->
<div id="notification" class="fixed top-4 right-4 z-50 hidden">
    <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        <span id="notification-message"></span>
    </div>
</div>

<script>
function showLoading() {
    document.getElementById('loading-overlay').classList.remove('hidden');
}

function hideLoading() {
    document.getElementById('loading-overlay').classList.add('hidden');
}

function showNotification(message, type = 'success') {
    const notification = document.getElementById('notification');
    const messageEl = document.getElementById('notification-message');
    
    messageEl.textContent = message;
    
    // Update colors based on type
    const notificationDiv = notification.querySelector('div');
    if (type === 'success') {
        notificationDiv.className = 'bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2';
    } else if (type === 'error') {
        notificationDiv.className = 'bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2';
    }
    
    notification.classList.remove('hidden');
    
    setTimeout(() => {
        notification.classList.add('hidden');
    }, 3000);
}

function updateStatus(documentId, status) {
    if (status === 'rejected') {
        // For rejection, show prompt for reason
        const reason = prompt('Masukkan alasan penolakan:');
        if (!reason || reason.trim() === '') {
            showNotification('Alasan penolakan harus diisi', 'error');
            return;
        }
        
        if (!confirm('Apakah Anda yakin ingin menolak dokumen ini?')) {
            return;
        }
        
        showLoading();
        
        fetch(`/staff/documents/${documentId}/status`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                status: status,
                rejection_reason: reason.trim()
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            hideLoading();
            
            if (data.success) {
                showNotification(data.message || 'Status berhasil diubah', 'success');
                // Reload page to update the table
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                showNotification(data.message || 'Terjadi kesalahan', 'error');
            }
        })
        .catch(error => {
            hideLoading();
            console.error('Error:', error);
            showNotification('Terjadi kesalahan saat memproses permintaan. Silakan coba lagi.', 'error');
        });
    } else {
        // For other status changes
        if (!confirm('Apakah Anda yakin ingin mengubah status dokumen ini?')) {
            return;
        }
        
        showLoading();
        
        fetch(`/staff/documents/${documentId}/status`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                status: status
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            hideLoading();
            
            if (data.success) {
                showNotification(data.message || 'Status berhasil diubah', 'success');
                // Reload page to update the table
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                showNotification(data.message || 'Terjadi kesalahan', 'error');
            }
        })
        .catch(error => {
            hideLoading();
            console.error('Error:', error);
            showNotification('Terjadi kesalahan saat memproses permintaan. Silakan coba lagi.', 'error');
        });
    }
}
</script>
@endsection