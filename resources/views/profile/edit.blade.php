@extends('layouts.app')

@section('title', 'Detail Pengajuan')

@section('content')


    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Profile Header -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl mb-8">
                <div class="px-6 py-8 sm:px-8">
                    <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
                        <!-- Avatar -->
                        <div class="flex-shrink-0">
                            <div class="w-32 h-32 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg">
                                <span class="text-white font-bold text-4xl">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                            </div>
                        </div>

                        <!-- User Info -->
                        <div class="flex-1 text-center md:text-left">
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $user->name }}</h1>
                            <p class="text-lg text-gray-600 mb-4">{{ $user->email }}</p>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <div class="text-gray-500 font-medium">Status Akun</div>
                                    <div class="text-green-600 font-semibold">Aktif</div>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <div class="text-gray-500 font-medium">Bergabung</div>
                                    <div class="text-gray-900 font-semibold">{{ $user->created_at->format('d M Y') }}</div>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <div class="text-gray-500 font-medium">Role</div>
                                    <div class="text-blue-600 font-semibold capitalize">{{ $user->roles->first()->name ?? 'User' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Profile Information -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Update Profile Information -->
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Informasi Profil</h3>
                            <p class="text-sm text-gray-600 mt-1">Perbarui informasi profil dan alamat email Anda.</p>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Update Password -->
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Ubah Password</h3>
                            <p class="text-sm text-gray-600 mt-1">Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.</p>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <!-- Delete Account -->
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-red-600">Hapus Akun</h3>
                            <p class="text-sm text-gray-600 mt-1">Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen.</p>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>

                <!-- Profile Statistics -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Quick Stats -->
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Statistik Aktivitas</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700">Total Dokumen</span>
                                </div>
                                <span class="text-lg font-bold text-blue-600">{{ $user->documentRequests()->count() }}</span>
                            </div>

                            <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700">Dokumen Selesai</span>
                                </div>
                                <span class="text-lg font-bold text-green-600">{{ $user->documentRequests()->where('status', 'completed')->count() }}</span>
                            </div>

                            <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-red-500 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700">Total Pengaduan</span>
                                </div>
                                <span class="text-lg font-bold text-red-600">{{ $user->complaints()->count() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h3>
                        </div>
                        <div class="p-6">
                            @php
                                $recentDocuments = $user->documentRequests()->latest()->limit(3)->get();
                                $recentComplaints = $user->complaints()->latest()->limit(3)->get();
                            @endphp

                            @if($recentDocuments->count() > 0 || $recentComplaints->count() > 0)
                                <div class="space-y-3">
                                    @foreach($recentDocuments as $document)
                                    <div class="flex items-center space-x-3 text-sm">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                        <div class="flex-1">
                                            <p class="text-gray-900">Dokumen {{ $document->document_type_label ?? 'Surat' }}</p>
                                            <p class="text-gray-500 text-xs">{{ $document->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    @endforeach

                                    @foreach($recentComplaints as $complaint)
                                    <div class="flex items-center space-x-3 text-sm">
                                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                        <div class="flex-1">
                                            <p class="text-gray-900">{{ Str::limit($complaint->subject, 30) }}</p>
                                            <p class="text-gray-500 text-xs">{{ $complaint->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 text-sm">Belum ada aktivitas terbaru</p>
                            @endif
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Aksi Cepat</h3>
                        </div>
                        <div class="p-6 space-y-3">
                            <a href="{{ route('documents.create') }}" class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-200">
                                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-blue-700">Ajukan Dokumen Baru</span>
                            </a>

                            <a href="{{ route('complaints.create') }}" class="flex items-center p-3 bg-red-50 hover:bg-red-100 rounded-lg transition-colors duration-200">
                                <div class="w-8 h-8 bg-red-500 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-red-700">Buat Pengaduan Baru</span>
                            </a>

                            @if(auth()->user()->hasRole('user'))
                                <a href="{{ route('user.dashboard') }}" class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                            @elseif(auth()->user()->hasRole('staff'))
                                <a href="{{ route('staff.dashboard') }}" class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                            @else
                                <a href="{{ route('dashboard') }}" class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                            @endif
                                <div class="w-8 h-8 bg-gray-500 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-700">Kembali ke Dashboard</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
