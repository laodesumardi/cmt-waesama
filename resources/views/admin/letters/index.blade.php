@extends('layouts.app')

@section('title', 'Manajemen Pengajuan Surat')

@section('content')
    <x-slot name="header">
        <div class="relative bg-gradient-to-r from-[#14213d] via-[#1a2b4a] to-[#14213d] overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]">
                </div>
            </div>

            <!-- Animated Background Elements -->
            <div class="absolute top-0 left-0 w-32 h-32 bg-white opacity-5 rounded-full animate-pulse"></div>
            <div class="absolute bottom-0 right-0 w-24 h-24 bg-white opacity-5 rounded-full animate-bounce" style="animation-delay: 1s;"></div>

            <div class="relative flex justify-between items-center px-6 py-8">
                <div class="flex items-center space-x-4">
                    <div class="bg-white bg-opacity-20 p-3 rounded-xl backdrop-blur-sm">
                        <i class="fas fa-envelope text-2xl text-white"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-2xl text-white leading-tight mb-1 animate-fade-in">
                            {{ __('Manajemen Pengajuan Surat') }}
                        </h2>
                        <p class="text-blue-100 text-sm opacity-90">Kelola dan pantau semua pengajuan surat masyarakat</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.letters.export', request()->query()) }}"
                       class="group bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-xl text-sm font-semibold transition-all duration-300 backdrop-blur-sm border border-white border-opacity-20 hover:border-opacity-40 transform hover:scale-105 hover:shadow-lg">
                        <i class="fas fa-download mr-2 group-hover:animate-bounce"></i>Export CSV
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
                <div class="stat-card overflow-hidden shadow-lg rounded-xl border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="icon-container w-12 h-12 rounded-xl flex items-center justify-center" style="--icon-from: #3b82f6; --icon-to: #1d4ed8;">
                                    <i class="fas fa-envelope text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Pengajuan</p>
                                <p class="text-3xl font-bold stat-number mt-1" data-target="{{ $stats['total'] ?? 0 }}">0</p>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-3">
                                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-1.5 rounded-full" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stat-card overflow-hidden shadow-lg rounded-xl border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="icon-container w-12 h-12 rounded-xl flex items-center justify-center" style="--icon-from: #f59e0b; --icon-to: #d97706;">
                                    <i class="fas fa-clock text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Menunggu</p>
                                <p class="text-3xl font-bold stat-number mt-1" data-target="{{ $stats['pending'] ?? 0 }}">0</p>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-3">
                                    <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 h-1.5 rounded-full" style="width: {{ $stats['total'] > 0 ? ($stats['pending'] / $stats['total']) * 100 : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stat-card overflow-hidden shadow-lg rounded-xl border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="icon-container w-12 h-12 rounded-xl flex items-center justify-center" style="--icon-from: #8b5cf6; --icon-to: #7c3aed;">
                                    <i class="fas fa-cog text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Diproses</p>
                                <p class="text-3xl font-bold stat-number mt-1" data-target="{{ $stats['processing'] ?? 0 }}">0</p>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-3">
                                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 h-1.5 rounded-full" style="width: {{ $stats['total'] > 0 ? ($stats['processing'] / $stats['total']) * 100 : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stat-card overflow-hidden shadow-lg rounded-xl border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="icon-container w-12 h-12 rounded-xl flex items-center justify-center" style="--icon-from: #10b981; --icon-to: #059669;">
                                    <i class="fas fa-check text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Selesai</p>
                                <p class="text-3xl font-bold stat-number mt-1" data-target="{{ $stats['completed'] ?? 0 }}">0</p>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-3">
                                    <div class="bg-gradient-to-r from-green-500 to-green-600 h-1.5 rounded-full" style="width: {{ $stats['total'] > 0 ? ($stats['completed'] / $stats['total']) * 100 : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stat-card overflow-hidden shadow-lg rounded-xl border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="icon-container w-12 h-12 rounded-xl flex items-center justify-center" style="--icon-from: #ef4444; --icon-to: #dc2626;">
                                    <i class="fas fa-times text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Ditolak</p>
                                <p class="text-3xl font-bold stat-number mt-1" data-target="{{ $stats['rejected'] ?? 0 }}">0</p>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-3">
                                    <div class="bg-gradient-to-r from-red-500 to-red-600 h-1.5 rounded-full" style="width: {{ $stats['total'] > 0 ? ($stats['rejected'] / $stats['total']) * 100 : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters and Search -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 mb-8">
                <div class="p-6">
                    <form method="GET" action="{{ route('admin.letters.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Search -->
                            <div class="md:col-span-2">
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-search mr-1"></i>Cari Pengajuan
                                </label>
                                <input type="text" name="search" id="search" value="{{ request('search') }}"
                                       placeholder="Cari berdasarkan nama, NIK, atau nomor pengajuan..."
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                            </div>

                            <!-- Status Filter -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-filter mr-1"></i>Status
                                </label>
                                <select name="status" id="status" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                                    <option value="">Semua Status</option>
                                    @foreach($statuses as $key => $label)
                                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Letter Type Filter -->
                            <div>
                                <label for="letter_type" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-envelope mr-1"></i>Jenis Surat
                                </label>
                                <select name="letter_type" id="letter_type" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                                    <option value="">Semua Jenis</option>
                                    @foreach($letterTypes as $key => $label)
                                        <option value="{{ $key }}" {{ request('letter_type') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                            <div class="flex space-x-3">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition duration-300 transform hover:scale-105">
                                    <i class="fas fa-search mr-2"></i>Cari
                                </button>
                                <a href="{{ route('admin.letters.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium transition duration-300">
                                    <i class="fas fa-undo mr-2"></i>Reset
                                </a>
                            </div>
                            <div class="text-sm text-gray-600">
                                Menampilkan {{ $requests->firstItem() ?? 0 }} - {{ $requests->lastItem() ?? 0 }} dari {{ $requests->total() }} pengajuan
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Letters Table -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-hashtag mr-1"></i>ID
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-user mr-1"></i>Pemohon
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-envelope mr-1"></i>Jenis Surat
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-calendar mr-1"></i>Tanggal
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-info-circle mr-1"></i>Status
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-user-tie mr-1"></i>Diproses Oleh
                                </th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-cogs mr-1"></i>Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($requests as $letter)
                                <tr class="hover:bg-gray-50 transition duration-300">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            #{{ $letter->request_number ?? 'LTR-' . str_pad($letter->id, 6, '0', STR_PAD_LEFT) }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            ID: {{ $letter->id }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                                                    <span class="text-white font-semibold text-sm">{{ substr($letter->applicant_name, 0, 1) }}</span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $letter->applicant_name }}</div>
                                                <div class="text-sm text-gray-500">{{ $letter->applicant_nik }}</div>
                                                @if($letter->applicant_phone)
                                                    <div class="text-xs text-gray-400">{{ $letter->applicant_phone }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $letter->letter_type_label }}</div>
                                        <div class="text-xs text-gray-500">{{ Str::limit($letter->purpose, 50) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex flex-col">
                                            <span class="font-medium">{{ $letter->created_at->format('d/m/Y') }}</span>
                                            <span class="text-xs text-gray-500">{{ $letter->created_at->format('H:i') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full {{ $letter->status_color }}">
                                            {{ $letter->status_label }}
                                        </span>
                                        @if($letter->processed_at)
                                            <div class="text-xs text-gray-500 mt-1">
                                                {{ $letter->processed_at->format('d/m/Y H:i') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($letter->processor)
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8">
                                                    <div class="h-8 w-8 rounded-full bg-gradient-to-r from-green-500 to-blue-600 flex items-center justify-center">
                                                        <span class="text-white font-semibold text-xs">{{ substr($letter->processor->name, 0, 1) }}</span>
                                                    </div>
                                                </div>
                                                <div class="ml-2">
                                                    <div class="text-sm font-medium text-gray-900">{{ $letter->processor->name }}</div>
                                                    <div class="text-xs text-gray-500">{{ ucfirst($letter->processor->role) }}</div>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-sm">Belum ditugaskan</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('admin.letters.show', $letter) }}" 
                                               class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-2 rounded-lg text-xs font-medium transition duration-300 transform hover:scale-105">
                                                <i class="fas fa-eye mr-1"></i>Detail
                                            </a>
                                            
                                            @if($letter->status !== 'completed' && $letter->status !== 'rejected')
                                                <button onclick="quickUpdateStatus({{ $letter->id }}, 'processing')" 
                                                        class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-2 rounded-lg text-xs font-medium transition duration-300 transform hover:scale-105">
                                                    <i class="fas fa-cog mr-1"></i>Proses
                                                </button>
                                                <button onclick="quickUpdateStatus({{ $letter->id }}, 'completed')" 
                                                        class="bg-green-100 hover:bg-green-200 text-green-700 px-3 py-2 rounded-lg text-xs font-medium transition duration-300 transform hover:scale-105">
                                                    <i class="fas fa-check mr-1"></i>Selesai
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <i class="fas fa-envelope text-gray-300 text-6xl mb-4"></i>
                                            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada pengajuan surat</h3>
                                            <p class="text-gray-500">Belum ada pengajuan surat yang masuk ke sistem.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($requests->hasPages())
                    <div class="bg-white px-6 py-4 border-t border-gray-200">
                        {{ $requests->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Animate statistics numbers
        document.addEventListener('DOMContentLoaded', function() {
            const statNumbers = document.querySelectorAll('.stat-number');
            
            statNumbers.forEach(function(element) {
                const target = parseInt(element.getAttribute('data-target'));
                let current = 0;
                const increment = target / 50;
                
                const timer = setInterval(function() {
                    current += increment;
                    if (current >= target) {
                        element.textContent = target;
                        clearInterval(timer);
                    } else {
                        element.textContent = Math.floor(current);
                    }
                }, 20);
            });
        });

        // Quick status update function
        function quickUpdateStatus(letterId, status) {
            if (!confirm(`Apakah Anda yakin ingin mengubah status menjadi ${status === 'processing' ? 'Diproses' : 'Selesai'}?`)) {
                return;
            }

            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            formData.append('status', status);

            fetch(`/admin/letters/${letterId}/status`, {
                method: 'POST',
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
        }
    </script>

    <style>
        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .icon-container {
            background: linear-gradient(135deg, var(--icon-from), var(--icon-to));
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }
    </style>
@endsection