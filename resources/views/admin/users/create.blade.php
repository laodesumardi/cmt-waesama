@extends('layouts.app')

@section('title', 'Tambah User Baru')

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-lg mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Tambah User Baru</h1>
                    <nav class="text-sm text-gray-600 mt-1">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-[#14213d]">Dashboard</a>
                        <span class="mx-2">/</span>
                        <a href="{{ route('admin.users.index') }}" class="hover:text-[#14213d]">Users</a>
                        <span class="mx-2">/</span>
                        <span class="text-gray-900">Tambah Baru</span>
                    </nav>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form Preview -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-gray-900">Preview User</h6>
                </div>
                <div class="p-6">
                    <div class="text-center mb-6">
                        <div class="w-24 h-24 bg-[#14213d] rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-white font-bold text-2xl" id="preview-initials">NU</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900" id="preview-name">Nama User</h3>
                        <p class="text-gray-600" id="preview-email">email@example.com</p>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800" id="preview-status">
                                <i class="fas fa-check-circle mr-2"></i> Aktif
                            </span>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                            <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium" id="preview-role">
                                Pilih Role
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Input -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-gray-900">Form Tambah User</h6>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
                        @csrf
                        
                        <!-- Personal Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                       class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#14213d] focus:border-transparent transition-all duration-300 @error('name') border-red-500 @enderror"
                                       placeholder="Masukkan nama lengkap">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                       class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#14213d] focus:border-transparent transition-all duration-300 @error('email') border-red-500 @enderror"
                                       placeholder="contoh@email.com">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Account Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password *</label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" required
                                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#14213d] focus:border-transparent transition-all duration-300 @error('password') border-red-500 @enderror"
                                           placeholder="Minimal 8 karakter">
                                    <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password *</label>
                                <div class="relative">
                                    <input type="password" id="password_confirmation" name="password_confirmation" required
                                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#14213d] focus:border-transparent transition-all duration-300"
                                           placeholder="Ulangi password">
                                    <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Role -->
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role *</label>
                                <select id="role" name="role" required
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#14213d] focus:border-transparent transition-all duration-300 @error('role') border-red-500 @enderror">
                                    <option value="">Pilih Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Status -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status Akun</label>
                                <div class="flex items-center space-x-4 mt-3">
                                    <label class="flex items-center">
                                        <input type="radio" name="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}
                                               class="w-4 h-4 text-[#14213d] border-gray-300 focus:ring-[#14213d] focus:ring-2">
                                        <span class="ml-2 text-gray-700">Aktif</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="is_active" value="0" {{ old('is_active') == '0' ? 'checked' : '' }}
                                               class="w-4 h-4 text-[#14213d] border-gray-300 focus:ring-[#14213d] focus:ring-2">
                                        <span class="ml-2 text-gray-700">Nonaktif</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Submit Buttons -->
                        <div class="flex flex-col sm:flex-row justify-end gap-4 pt-6">
                            <a href="{{ route('admin.users.index') }}" 
                               class="inline-flex items-center justify-center bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg text-sm font-medium transition-all duration-300 shadow-md hover:shadow-lg">
                                <i class="fas fa-times mr-2"></i> Batal
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center justify-center bg-[#14213d] hover:bg-[#1a2a4a] text-white px-6 py-3 rounded-lg text-sm font-medium transition-all duration-300 shadow-md hover:shadow-lg">
                                <i class="fas fa-save mr-2"></i> Simpan User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const button = field.nextElementSibling.querySelector('i');
    
    if (field.getAttribute('type') === 'password') {
        field.setAttribute('type', 'text');
        button.classList.remove('fa-eye');
        button.classList.add('fa-eye-slash');
    } else {
        field.setAttribute('type', 'password');
        button.classList.remove('fa-eye-slash');
        button.classList.add('fa-eye');
    }
}

// Live preview update
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const roleSelect = document.getElementById('role');
    const statusRadios = document.querySelectorAll('input[name="is_active"]');
    
    const previewName = document.getElementById('preview-name');
    const previewEmail = document.getElementById('preview-email');
    const previewInitials = document.getElementById('preview-initials');
    const previewRole = document.getElementById('preview-role');
    const previewStatus = document.getElementById('preview-status');
    
    function updatePreview() {
        // Update name and initials
        const name = nameInput.value || 'Nama User';
        previewName.textContent = name;
        
        const initials = name.split(' ').map(word => word.charAt(0)).join('').toUpperCase().substring(0, 2) || 'NU';
        previewInitials.textContent = initials;
        
        // Update email
        previewEmail.textContent = emailInput.value || 'email@example.com';
        
        // Update role
        const selectedRole = roleSelect.options[roleSelect.selectedIndex];
        previewRole.textContent = selectedRole.text || 'Pilih Role';
        
        // Update status
        const activeStatus = document.querySelector('input[name="is_active"]:checked');
        if (activeStatus && activeStatus.value === '1') {
            previewStatus.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Aktif';
            previewStatus.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800';
        } else {
            previewStatus.innerHTML = '<i class="fas fa-times-circle mr-2"></i> Nonaktif';
            previewStatus.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800';
        }
    }
    
    nameInput.addEventListener('input', updatePreview);
    emailInput.addEventListener('input', updatePreview);
    roleSelect.addEventListener('change', updatePreview);
    statusRadios.forEach(radio => radio.addEventListener('change', updatePreview));
});
</script>
@endsection