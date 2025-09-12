<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Warga') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl mb-8">
                <div class="px-6 py-8 sm:px-8">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Selamat datang, {{ Auth::user()->name }}!</h3>
                        <p class="text-lg text-gray-600 max-w-2xl mx-auto">Akses layanan administrasi kecamatan dengan mudah dan cepat melalui portal digital kami.</p>
                    </div>
                    <!-- Service Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        <!-- Layanan Surat -->
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-8 rounded-xl border border-gray-200 hover:shadow-lg transition-all duration-300 group">
                            <div class="flex items-center mb-6">
                                <div class="w-12 h-12 bg-[#14213d] rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-bold text-[#14213d]">Layanan Surat</h4>
                            </div>
                            <p class="text-gray-600 mb-6 leading-relaxed">Ajukan berbagai jenis surat keterangan secara online dengan proses yang cepat dan mudah</p>
                            <a href="{{ route('services.letters') }}" class="inline-flex items-center bg-[#14213d] text-white px-6 py-3 rounded-lg font-medium hover:bg-[#0f1a2e] transition-colors duration-300 shadow-md hover:shadow-lg">
                                Ajukan Surat
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                        <!-- Pengaduan -->
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-8 rounded-xl border border-gray-200 hover:shadow-lg transition-all duration-300 group">
                            <div class="flex items-center mb-6">
                                <div class="w-12 h-12 bg-[#14213d] rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-bold text-[#14213d]">Pengaduan</h4>
                            </div>
                            <p class="text-gray-600 mb-6 leading-relaxed">Sampaikan keluhan, saran, atau aspirasi Anda untuk perbaikan layanan</p>
                            <a href="#" class="inline-flex items-center bg-[#14213d] text-white px-6 py-3 rounded-lg font-medium hover:bg-[#0f1a2e] transition-colors duration-300 shadow-md hover:shadow-lg">
                                Buat Pengaduan
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                        <!-- Informasi Desa -->
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-8 rounded-xl border border-gray-200 hover:shadow-lg transition-all duration-300 group">
                            <div class="flex items-center mb-6">
                                <div class="w-12 h-12 bg-[#14213d] rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-bold text-[#14213d]">Informasi Desa</h4>
                            </div>
                            <p class="text-gray-600 mb-6 leading-relaxed">Lihat informasi dan berita terbaru dari desa/kelurahan Anda</p>
                            <a href="#" class="inline-flex items-center bg-[#14213d] text-white px-6 py-3 rounded-lg font-medium hover:bg-[#0f1a2e] transition-colors duration-300 shadow-md hover:shadow-lg">
                                Lihat Info
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Status Pengajuan -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl mb-8">
                <div class="px-6 py-8 sm:px-8">
                    <h4 class="text-2xl font-bold text-gray-900 mb-6">Status Pengajuan Terbaru</h4>
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-8 rounded-xl border border-gray-200">
                        <div class="text-center text-gray-500 py-12">
                            <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <h5 class="text-lg font-semibold text-gray-700 mb-2">Belum ada pengajuan</h5>
                            <p class="text-gray-500 mb-6">Mulai ajukan layanan surat untuk melihat status di sini</p>
                            <a href="{{ route('services.letters') }}" class="inline-flex items-center bg-[#14213d] text-white px-6 py-3 rounded-lg font-medium hover:bg-[#0f1a2e] transition-colors duration-300">
                                Mulai Pengajuan
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Quick Stats -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl">
                <div class="px-6 py-8 sm:px-8">
                    <h4 class="text-2xl font-bold text-gray-900 mb-8">Ringkasan Aktivitas</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 p-6 rounded-xl text-center hover:shadow-md transition-shadow duration-300">
                            <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center mx-auto mb-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="text-3xl font-bold text-blue-600 mb-2">0</div>
                            <div class="text-sm font-medium text-blue-700">Pengajuan Aktif</div>
                        </div>
                        <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 p-6 rounded-xl text-center hover:shadow-md transition-shadow duration-300">
                            <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center mx-auto mb-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="text-3xl font-bold text-green-600 mb-2">0</div>
                            <div class="text-sm font-medium text-green-700">Surat Selesai</div>
                        </div>
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 p-6 rounded-xl text-center hover:shadow-md transition-shadow duration-300">
                            <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center mx-auto mb-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                </svg>
                            </div>
                            <div class="text-3xl font-bold text-purple-600 mb-2">0</div>
                            <div class="text-sm font-medium text-purple-700">Pengaduan Dibuat</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
