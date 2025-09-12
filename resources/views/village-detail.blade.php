@extends('layouts.app')

@section('title', 'Detail Desa - Kecamatan Waesama')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-100 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('villages') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Daftar Desa</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ ucfirst($village) }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        @php
            $villageData = [
                'waetawa' => [
                    'name' => 'Desa Waetawa',
                    'head' => 'Firdaus Souwakil',
                    'status' => 'Defenitif',
                    'phone' => '0822 3840 4758',
                    'description' => 'Desa Waetawa merupakan salah satu desa di Kecamatan Waesama yang memiliki potensi wisata alam yang indah. Desa ini dikenal dengan pemandangan alam yang asri dan udara yang sejuk.',
                    'area' => '15.2 km²',
                    'population' => '1,245 jiwa',
                    'villages_count' => '3 dusun',
                    'main_livelihood' => 'Pertanian dan Perikanan',
                    'potential' => ['Wisata Alam', 'Pertanian Organik', 'Perikanan Laut'],
                    'facilities' => ['Puskesmas Pembantu', 'SD Negeri', 'Masjid', 'Balai Desa'],
                    'color' => 'green'
                ],
                'waesili' => [
                    'name' => 'Desa Waesili',
                    'head' => 'Iswan Jampolo, SST',
                    'status' => 'Pj',
                    'phone' => '0822-9947-7810',
                    'description' => 'Desa Waesili adalah desa yang terletak di bagian utara Kecamatan Waesama. Desa ini memiliki potensi pertanian yang sangat baik dengan lahan yang subur.',
                    'area' => '12.8 km²',
                    'population' => '987 jiwa',
                    'villages_count' => '2 dusun',
                    'main_livelihood' => 'Pertanian dan Perkebunan',
                    'potential' => ['Pertanian Padi', 'Perkebunan Kelapa', 'Peternakan'],
                    'facilities' => ['Polindes', 'SD Negeri', 'Musholla', 'Balai Desa'],
                    'color' => 'blue'
                ],
                'simi' => [
                    'name' => 'Desa Simi',
                    'head' => 'Muhamad Fakaubun',
                    'status' => 'Pj',
                    'phone' => '0853-8417-8613',
                    'description' => 'Desa Simi merupakan desa yang memiliki keunikan budaya lokal yang masih terjaga. Masyarakat desa ini masih memegang teguh adat istiadat leluhur.',
                    'area' => '18.5 km²',
                    'population' => '1,456 jiwa',
                    'villages_count' => '4 dusun',
                    'main_livelihood' => 'Pertanian dan Kerajinan',
                    'potential' => ['Wisata Budaya', 'Kerajinan Tangan', 'Pertanian Tradisional'],
                    'facilities' => ['Puskesmas', 'SD dan SMP', 'Masjid', 'Balai Adat'],
                    'color' => 'purple'
                ],
                'lena' => [
                    'name' => 'Desa Lena',
                    'head' => 'Anas Takimpo, S.IP',
                    'status' => 'Pj',
                    'phone' => '0821-9892-1117',
                    'description' => 'Desa Lena terkenal dengan hasil pertaniannya yang melimpah. Desa ini memiliki sistem irigasi yang baik sehingga pertanian dapat berjalan sepanjang tahun.',
                    'area' => '14.3 km²',
                    'population' => '1,123 jiwa',
                    'villages_count' => '3 dusun',
                    'main_livelihood' => 'Pertanian dan Perdagangan',
                    'potential' => ['Pertanian Intensif', 'Perdagangan', 'Agrowisata'],
                    'facilities' => ['Puskesmas Pembantu', 'SD Negeri', 'Masjid', 'Pasar Desa'],
                    'color' => 'yellow'
                ],
                'wamsisi' => [
                    'name' => 'Desa Wamsisi',
                    'head' => 'Bachrudin Yusuf M, S.Tr.IP',
                    'status' => 'Pj',
                    'phone' => '0823-1986-0372',
                    'description' => 'Desa Wamsisi memiliki lokasi strategis yang dekat dengan pusat kecamatan. Desa ini berkembang pesat dalam bidang perdagangan dan jasa.',
                    'area' => '11.7 km²',
                    'population' => '1,678 jiwa',
                    'villages_count' => '4 dusun',
                    'main_livelihood' => 'Perdagangan dan Jasa',
                    'potential' => ['Pusat Perdagangan', 'Jasa Transportasi', 'UMKM'],
                    'facilities' => ['Puskesmas', 'SD dan SMP', 'Masjid', 'Pasar Tradisional'],
                    'color' => 'red'
                ],
                'waelikut' => [
                    'name' => 'Desa Waelikut',
                    'head' => 'Agil Bin Yahya',
                    'status' => 'Pj',
                    'phone' => '0823-9151-4383',
                    'description' => 'Desa Waelikut terletak di daerah perbukitan dengan pemandangan yang indah. Desa ini memiliki potensi wisata alam dan pertanian dataran tinggi.',
                    'area' => '16.9 km²',
                    'population' => '892 jiwa',
                    'villages_count' => '2 dusun',
                    'main_livelihood' => 'Pertanian Dataran Tinggi',
                    'potential' => ['Wisata Alam', 'Pertanian Sayuran', 'Perkebunan Kopi'],
                    'facilities' => ['Polindes', 'SD Negeri', 'Musholla', 'Pos Kamling'],
                    'color' => 'indigo'
                ],
                'waeteba' => [
                    'name' => 'Desa Waeteba',
                    'head' => 'Faeda\'Pelu',
                    'status' => 'Pj',
                    'phone' => '0812-1650-9502',
                    'description' => 'Desa Waeteba memiliki pantai yang indah dengan pasir putih. Desa ini berpotensi untuk dikembangkan sebagai destinasi wisata bahari.',
                    'area' => '13.4 km²',
                    'population' => '1,034 jiwa',
                    'villages_count' => '3 dusun',
                    'main_livelihood' => 'Perikanan dan Pariwisata',
                    'potential' => ['Wisata Bahari', 'Perikanan Laut', 'Budidaya Rumput Laut'],
                    'facilities' => ['Puskesmas Pembantu', 'SD Negeri', 'Masjid', 'Dermaga'],
                    'color' => 'teal'
                ],
                'pohon-batu' => [
                    'name' => 'Desa Pohon Batu',
                    'head' => 'Suaib Umanailo',
                    'status' => 'Pj',
                    'phone' => '0812-4771-1397',
                    'description' => 'Desa Pohon Batu terkenal dengan formasi batu karang yang unik. Desa ini memiliki potensi wisata geologi dan pertambangan.',
                    'area' => '19.2 km²',
                    'population' => '756 jiwa',
                    'villages_count' => '2 dusun',
                    'main_livelihood' => 'Pertambangan dan Pertanian',
                    'potential' => ['Wisata Geologi', 'Pertambangan Batu', 'Pertanian Lahan Kering'],
                    'facilities' => ['Polindes', 'SD Negeri', 'Musholla', 'Balai Desa'],
                    'color' => 'gray'
                ],
                'hotte' => [
                    'name' => 'Desa Hotte',
                    'head' => 'Abukasim Titawael, S.M',
                    'status' => 'Pj',
                    'phone' => '0852-1685-4491',
                    'description' => 'Desa Hotte memiliki hutan yang masih alami dengan keanekaragaman hayati yang tinggi. Desa ini berpotensi untuk ekowisata.',
                    'area' => '22.1 km²',
                    'population' => '634 jiwa',
                    'villages_count' => '2 dusun',
                    'main_livelihood' => 'Kehutanan dan Pertanian',
                    'potential' => ['Ekowisata', 'Hasil Hutan', 'Pertanian Organik'],
                    'facilities' => ['Polindes', 'SD Negeri', 'Musholla', 'Pos Jaga Hutan'],
                    'color' => 'emerald'
                ],
                'waemasing' => [
                    'name' => 'Desa Waemasing',
                    'head' => 'Darusman Booy',
                    'status' => 'Pj',
                    'phone' => '0821 9449 6199',
                    'description' => 'Desa Waemasing terletak di daerah pesisir dengan potensi perikanan yang besar. Masyarakat desa ini sebagian besar bermata pencaharian sebagai nelayan.',
                    'area' => '10.8 km²',
                    'population' => '1,289 jiwa',
                    'villages_count' => '3 dusun',
                    'main_livelihood' => 'Perikanan dan Kelautan',
                    'potential' => ['Perikanan Tangkap', 'Budidaya Ikan', 'Pengolahan Hasil Laut'],
                    'facilities' => ['Puskesmas Pembantu', 'SD Negeri', 'Masjid', 'TPI (Tempat Pelelangan Ikan)'],
                    'color' => 'rose'
                ],
                'batu-kasa' => [
                    'name' => 'Desa Batu Kasa',
                    'head' => 'Gani Namkatu',
                    'status' => 'Pj',
                    'phone' => '0813-6204-6221',
                    'description' => 'Desa Batu Kasa memiliki keunikan berupa formasi batu yang menyerupai rumah. Desa ini berpotensi untuk wisata alam dan spiritual.',
                    'area' => '17.6 km²',
                    'population' => '923 jiwa',
                    'villages_count' => '3 dusun',
                    'main_livelihood' => 'Pertanian dan Pariwisata',
                    'potential' => ['Wisata Spiritual', 'Wisata Alam', 'Pertanian Tradisional'],
                    'facilities' => ['Polindes', 'SD Negeri', 'Masjid', 'Situs Bersejarah'],
                    'color' => 'amber'
                ]
            ];
            
            $data = $villageData[strtolower($village)] ?? null;
        @endphp

        @if($data)
            <!-- Village Header -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-{{ $data['color'] }}-500 to-{{ $data['color'] }}-600 px-8 py-12">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-4xl font-bold text-white mb-2">{{ $data['name'] }}</h1>
                            <p class="text-{{ $data['color'] }}-100 text-lg">Kecamatan Waesama, Kabupaten Manggarai Barat</p>
                        </div>
                        <div class="hidden md:block">
                            <div class="bg-white bg-opacity-20 rounded-full p-6">
                                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Village Information Grid -->
            <div class="grid lg:grid-cols-3 gap-8 mb-8">
                <!-- Main Information -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Description -->
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-{{ $data['color'] }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Tentang Desa
                        </h2>
                        <p class="text-gray-700 leading-relaxed text-lg">{{ $data['description'] }}</p>
                    </div>

                    <!-- Potential & Facilities -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Potential -->
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-{{ $data['color'] }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Potensi Desa
                            </h3>
                            <ul class="space-y-2">
                                @foreach($data['potential'] as $potential)
                                    <li class="flex items-center text-gray-700">
                                        <span class="w-2 h-2 bg-{{ $data['color'] }}-500 rounded-full mr-3"></span>
                                        {{ $potential }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Facilities -->
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-{{ $data['color'] }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m0 0h2M7 7h10M7 11h10M7 15h10"></path>
                                </svg>
                                Fasilitas
                            </h3>
                            <ul class="space-y-2">
                                @foreach($data['facilities'] as $facility)
                                    <li class="flex items-center text-gray-700">
                                        <span class="w-2 h-2 bg-{{ $data['color'] }}-500 rounded-full mr-3"></span>
                                        {{ $facility }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Information -->
                <div class="space-y-6">
                    <!-- Village Head -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-{{ $data['color'] }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Kepala Desa
                        </h3>
                        <div class="bg-{{ $data['color'] }}-50 rounded-lg p-4">
                            <h4 class="font-semibold text-gray-900 text-lg">{{ $data['head'] }}</h4>
                            <p class="text-{{ $data['color'] }}-600 font-medium mb-3">Status: {{ $data['status'] }}</p>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                {{ $data['phone'] }}
                            </div>
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-{{ $data['color'] }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Statistik Desa
                        </h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-gray-600">Luas Wilayah</span>
                                <span class="font-semibold text-gray-900">{{ $data['area'] }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-gray-600">Jumlah Penduduk</span>
                                <span class="font-semibold text-gray-900">{{ $data['population'] }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-gray-600">Jumlah Dusun</span>
                                <span class="font-semibold text-gray-900">{{ $data['villages_count'] }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600">Mata Pencaharian</span>
                                <span class="font-semibold text-gray-900">{{ $data['main_livelihood'] }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-{{ $data['color'] }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Jam Pelayanan
                        </h3>
                        <div class="space-y-2 text-sm text-gray-700">
                            <div class="flex justify-between">
                                <span>Senin - Jumat</span>
                                <span class="font-medium">08:00 - 16:00 WITA</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Sabtu</span>
                                <span class="font-medium">08:00 - 12:00 WITA</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Minggu</span>
                                <span class="font-medium text-red-500">Tutup</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('villages') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Daftar Desa
                </a>
                <a href="{{ route('contact') }}" class="bg-{{ $data['color'] }}-600 hover:bg-{{ $data['color'] }}-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Hubungi Desa
                </a>
            </div>
        @else
            <!-- Village Not Found -->
            <div class="text-center py-16">
                <div class="bg-white rounded-xl shadow-lg p-12">
                    <svg class="w-24 h-24 text-gray-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.29-1.009-5.824-2.562M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Desa Tidak Ditemukan</h2>
                    <p class="text-gray-600 mb-8">Maaf, desa yang Anda cari tidak ditemukan dalam sistem kami.</p>
                    <a href="{{ route('villages') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Daftar Desa
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection