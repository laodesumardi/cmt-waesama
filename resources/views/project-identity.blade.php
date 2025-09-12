@extends('layouts.app')

@section('title', 'Identitas Project - Website Kecamatan Waesama')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <div class="flex justify-center mb-6">
                <img src="{{ asset('images/logo-camat.svg') }}" alt="Logo Kecamatan Waesama" class="h-20 w-20">
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Website Kecamatan Waesama</h1>
            <p class="text-xl text-gray-600">Sistem Informasi dan Pelayanan Digital Kecamatan Waesama</p>
        </div>

        <!-- Project Identity Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
                <h2 class="text-2xl font-bold text-white">Identitas Project</h2>
            </div>
            <div class="p-6">
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Nama Project</h3>
                            <p class="text-lg font-semibold text-gray-900">Website Kecamatan Waesama</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Jenis Aplikasi</h3>
                            <p class="text-lg text-gray-900">Sistem Informasi dan Pelayanan Digital</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Platform</h3>
                            <p class="text-lg text-gray-900">Web Application</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Framework</h3>
                            <p class="text-lg text-gray-900">Laravel 11 + Tailwind CSS</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Versi</h3>
                            <p class="text-lg text-gray-900">1.0.0</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Status</h3>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <span class="w-2 h-2 bg-green-400 rounded-full mr-2"></span>
                                Aktif
                            </span>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Tahun Pengembangan</h3>
                            <p class="text-lg text-gray-900">2025</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Developer</h3>
                            <p class="text-lg text-gray-900">Tim IT Kecamatan Waesama</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Overview -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-green-600 to-teal-600 px-6 py-4">
                <h2 class="text-2xl font-bold text-white">Fitur Utama</h2>
            </div>
            <div class="p-6">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="bg-blue-100 rounded-full p-3 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Berita & Pengumuman</h3>
                        <p class="text-sm text-gray-600">Publikasi informasi terkini dari kecamatan</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-green-100 rounded-full p-3 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Pelayanan Dokumen</h3>
                        <p class="text-sm text-gray-600">Pengajuan dokumen kependudukan online</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-purple-100 rounded-full p-3 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Pengaduan Masyarakat</h3>
                        <p class="text-sm text-gray-600">Sistem pengaduan dan aspirasi warga</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-yellow-100 rounded-full p-3 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Galeri Kegiatan</h3>
                        <p class="text-sm text-gray-600">Dokumentasi kegiatan kecamatan</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-red-100 rounded-full p-3 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Transparansi</h3>
                        <p class="text-sm text-gray-600">Informasi transparansi anggaran dan program</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-indigo-100 rounded-full p-3 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Informasi Desa</h3>
                        <p class="text-sm text-gray-600">Data dan kontak 11 desa di kecamatan</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Technical Specifications -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 px-6 py-4">
                <h2 class="text-2xl font-bold text-white">Spesifikasi Teknis</h2>
            </div>
            <div class="p-6">
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Backend Technology</h3>
                        <ul class="space-y-2">
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-red-500 rounded-full mr-3"></span>
                                <span class="text-gray-700">Laravel 11 (PHP Framework)</span>
                            </li>
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                                <span class="text-gray-700">MySQL Database</span>
                            </li>
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>
                                <span class="text-gray-700">Spatie Laravel Permission</span>
                            </li>
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-yellow-500 rounded-full mr-3"></span>
                                <span class="text-gray-700">Laravel Breeze Authentication</span>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Frontend Technology</h3>
                        <ul class="space-y-2">
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-cyan-500 rounded-full mr-3"></span>
                                <span class="text-gray-700">Tailwind CSS</span>
                            </li>
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>
                                <span class="text-gray-700">Alpine.js</span>
                            </li>
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>
                                <span class="text-gray-700">Blade Templating</span>
                            </li>
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-pink-500 rounded-full mr-3"></span>
                                <span class="text-gray-700">Responsive Design</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection