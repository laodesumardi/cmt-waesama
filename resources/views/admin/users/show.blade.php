@extends('layouts.app')

@section('title', 'Detail User')

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-lg mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Detail User</h1>
                    <nav class="text-sm text-gray-600 mt-1">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-[#14213d]">Dashboard</a>
                        <span class="mx-2">/</span>
                        <a href="{{ route('admin.users.index') }}" class="hover:text-[#14213d]">Users</a>
                        <span class="mx-2">/</span>
                        <span class="text-gray-900">Detail</span>
                    </nav>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                        <i class="fas fa-edit mr-2"></i> Edit User
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold text-sm rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- User Profile -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-gray-900">Profil User</h6>
                </div>
                <div class="p-6">
                    <div class="text-center mb-6">
                        <div class="w-24 h-24 bg-[#14213d] rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-white font-bold text-2xl">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900">{{ $user->name }}</h3>
                        <p class="text-gray-600">{{ $user->email }}</p>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            @if($user->is_active)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-2"></i> Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-2"></i> Nonaktif
                                </span>
                            @endif
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                            <div class="flex flex-wrap gap-2">
                                @if($user->roles->isNotEmpty())
                                    @foreach($user->roles as $role)
                                        <span class="@if($role->name == 'admin') bg-purple-100 text-purple-800 @elseif($role->name == 'staff') bg-yellow-100 text-yellow-800 @else bg-indigo-100 text-indigo-800 @endif px-3 py-1 rounded-full text-sm font-medium">
                                            {{ ucfirst($role->name) }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">No Role</span>
                                @endif
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Terdaftar</label>
                            <p class="text-gray-900">{{ $user->created_at->format('d F Y, H:i') }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Terakhir Update</label>
                            <p class="text-gray-900">{{ $user->updated_at->format('d F Y, H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- User Details -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-gray-900">Informasi Detail</h6>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">ID User</label>
                            <p class="text-gray-900 font-mono bg-gray-50 px-3 py-2 rounded-md">{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <p class="text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $user->name }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <p class="text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $user->email }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Verified</label>
                            @if($user->email_verified_at)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-2"></i> Verified ({{ $user->email_verified_at->format('d M Y') }})
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-2"></i> Not Verified
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Permissions -->
            @if($user->roles->isNotEmpty())
            <div class="bg-white rounded-lg shadow-lg mt-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-gray-900">Permissions</h6>
                </div>
                <div class="p-6">
                    @foreach($user->roles as $role)
                        <div class="mb-4 last:mb-0">
                            <h4 class="font-medium text-gray-900 mb-2">{{ ucfirst($role->name) }} Role</h4>
                            @if($role->permissions->isNotEmpty())
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                                    @foreach($role->permissions as $permission)
                                        <span class="inline-flex items-center px-3 py-1 rounded-md text-sm bg-blue-50 text-blue-700 border border-blue-200">
                                            <i class="fas fa-key mr-2 text-xs"></i>
                                            {{ $permission->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 text-sm">No permissions assigned to this role.</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection