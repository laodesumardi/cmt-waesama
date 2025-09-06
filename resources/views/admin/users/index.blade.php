@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Manajemen User</h1>
            <nav class="flex mt-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="text-gray-500 ml-1 md:ml-2">User</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-6 py-3 bg-[#14213d] hover:bg-[#0f1a2e] text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
            <i class="fas fa-plus mr-2"></i> Tambah User
        </a>
    </div>
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-6 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-blue-500 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-blue-600 uppercase mb-1">Total User</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['total'] }}</div>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-users text-3xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-green-500 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-green-600 uppercase mb-1">Aktif</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['active'] }}</div>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-3xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-red-500 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-red-600 uppercase mb-1">Nonaktif</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['inactive'] }}</div>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-times-circle text-3xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-purple-500 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-purple-600 uppercase mb-1">Admin</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['admins'] }}</div>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-shield-alt text-3xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-yellow-500 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-yellow-600 uppercase mb-1">Staff</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['staff'] }}</div>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-user-tie text-3xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-cyan-500 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-xs font-bold text-cyan-600 uppercase mb-1">User</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['users'] }}</div>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-user text-3xl text-gray-300"></i>
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
            <form method="GET" action="{{ route('admin.users.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="search" name="search" 
                               value="{{ request('search') }}" placeholder="Nama atau email...">
                    </div>
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="role" name="role">
                            <option value="">Semua Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="status" name="status">
                            <option value="">Semua Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                    <div>
                        <label for="sort" class="block text-sm font-medium text-gray-700 mb-2">Urutkan</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="sort" name="sort">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama A-Z</option>
                            <option value="email" {{ request('sort') == 'email' ? 'selected' : '' }}>Email A-Z</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">&nbsp;</label>
                        <div class="flex space-x-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#14213d] hover:bg-[#0f1a2e] text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                                <i class="fas fa-search mr-2"></i> Cari
                            </button>
                            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                                <i class="fas fa-undo mr-2"></i> Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h6 class="text-lg font-semibold text-gray-900">Daftar Pengguna</h6>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.users.export') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                        <i class="fas fa-download mr-2"></i> Export CSV
                    </a>
                    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-[#14213d] hover:bg-[#0f1a2e] text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                        <i class="fas fa-plus mr-2"></i> Tambah User
                    </a>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            @if($users->count() > 0)
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terdaftar</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-[#14213d] rounded-full flex items-center justify-center mr-3">
                                            <span class="text-white font-semibold text-sm">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-500">ID: {{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->roles->isNotEmpty())
                                        @foreach($user->roles as $role)
                                            <span class="@if($role->name == 'admin') bg-purple-100 text-purple-800 @elseif($role->name == 'staff') bg-yellow-100 text-yellow-800 @else bg-indigo-100 text-indigo-800 @endif px-2 py-1 rounded-full text-xs font-medium mr-1">
                                                {{ ucfirst($role->name) }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs font-medium">No Role</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->is_active)
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">Aktif</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('admin.users.show', $user) }}" class="text-blue-600 hover:text-blue-900 transition-colors duration-200" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user) }}" class="text-yellow-600 hover:text-yellow-900 transition-colors duration-200" title="Edit User">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="@if($user->is_active) text-orange-600 hover:text-orange-900 @else text-green-600 hover:text-green-900 @endif transition-colors duration-200" title="@if($user->is_active) Nonaktifkan @else Aktifkan @endif">
                                                @if($user->is_active)
                                                    <i class="fas fa-toggle-on"></i>
                                                @else
                                                    <i class="fas fa-toggle-off"></i>
                                                @endif
                                            </button>
                                        </form>
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 transition-colors duration-200" title="Hapus User">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-users text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak ada user ditemukan</h3>
                    <p class="text-gray-600 mb-6">
                        @if(request()->hasAny(['search', 'role', 'status']))
                            Coba ubah filter pencarian Anda
                        @else
                            Belum ada user yang terdaftar dalam sistem
                        @endif
                    </p>
                    @if(!request()->hasAny(['search', 'role', 'status']))
                        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-[#14213d] hover:bg-[#0f1a2e] text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                            <i class="fas fa-plus mr-2"></i> Tambah User Pertama
                        </a>
                    @else
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                            <i class="fas fa-undo mr-2"></i> Reset Filter
                        </a>
                    @endif
                </div>
            @endif
        </div>
        
        <!-- Pagination -->
        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                <div class="flex justify-between items-center">
                    <div class="text-gray-700 text-sm">
                        Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} user
                    </div>
                    <div class="flex space-x-2">
                        {{ $users->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast-notification" class="fixed top-4 right-4 z-50 hidden">
        <div class="bg-white border-l-4 border-green-500 rounded-lg shadow-lg p-4 max-w-sm">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i id="toast-icon" class="fas fa-check-circle text-green-500"></i>
                </div>
                <div class="ml-3">
                    <p id="toast-message" class="text-sm font-medium text-gray-900"></p>
                </div>
                <div class="ml-auto pl-3">
                    <button onclick="hideToast()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toast notification functions
        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast-notification');
            const icon = document.getElementById('toast-icon');
            const messageEl = document.getElementById('toast-message');
            const toastContainer = toast.querySelector('div');
            
            messageEl.textContent = message;
            
            if (type === 'success') {
                icon.className = 'fas fa-check-circle text-green-500';
                toastContainer.className = 'bg-white border-l-4 border-green-500 rounded-lg shadow-lg p-4 max-w-sm';
            } else if (type === 'error') {
                icon.className = 'fas fa-exclamation-circle text-red-500';
                toastContainer.className = 'bg-white border-l-4 border-red-500 rounded-lg shadow-lg p-4 max-w-sm';
            }
            
            toast.classList.remove('hidden');
            
            // Auto hide after 3 seconds
            setTimeout(() => {
                hideToast();
            }, 3000);
        }
        
        function hideToast() {
            document.getElementById('toast-notification').classList.add('hidden');
        }
        
        // Handle toggle status with AJAX
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners to all toggle status forms
            const toggleForms = document.querySelectorAll('form[action*="toggle-status"]');
            
            toggleForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(form);
                    const button = form.querySelector('button[type="submit"]');
                    const icon = button.querySelector('i');
                    
                    // Disable button during request
                    button.disabled = true;
                    
                    fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update button appearance
                            if (data.is_active) {
                                button.className = 'text-orange-600 hover:text-orange-900 transition-colors duration-200';
                                button.title = 'Nonaktifkan';
                                icon.className = 'fas fa-toggle-on';
                            } else {
                                button.className = 'text-green-600 hover:text-green-900 transition-colors duration-200';
                                button.title = 'Aktifkan';
                                icon.className = 'fas fa-toggle-off';
                            }
                            
                            // Show success notification
                            showToast(data.message, 'success');
                        } else {
                            // Show error notification
                            showToast(data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showToast('Terjadi kesalahan saat mengubah status user.', 'error');
                    })
                    .finally(() => {
                        // Re-enable button
                        button.disabled = false;
                    });
                });
            });
        });
    </script>
@endsection