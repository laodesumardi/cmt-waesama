<x-guest-public-layout>
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Lacak Status Pengajuan</h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Masukkan nomor pengajuan atau NIK untuk melihat status dokumen Anda
                </p>
            </div>

            <!-- Search Form -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                <form method="GET" action="{{ route('services.track') }}" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Request Number -->
                        <div>
                            <label for="request_number" class="block text-sm font-medium text-gray-700 mb-2">Nomor Pengajuan</label>
                            <input type="text" id="request_number" name="request_number" value="{{ request('request_number') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#14213d] focus:border-transparent"
                                   placeholder="Contoh: REQ-2024-001">
                        </div>

                        <!-- NIK -->
                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">NIK Pemohon</label>
                            <input type="text" id="nik" name="nik" value="{{ request('nik') }}"
                                   maxlength="16" pattern="[0-9]{16}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#14213d] focus:border-transparent"
                                   placeholder="Masukkan 16 digit NIK">
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <button type="submit" 
                                class="bg-[#14213d] text-white py-3 px-8 rounded-lg hover:bg-[#0f1a2e] transition duration-300 font-medium">
                            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari Pengajuan
                        </button>
                    </div>
                </form>
            </div>

            @if(isset($documents) && $documents->count() > 0)
                <!-- Search Results -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-bold text-gray-900">Hasil Pencarian</h2>
                    
                    @foreach($documents as $document)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <!-- Header -->
                            <div class="bg-gray-50 px-6 py-4 border-b">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $document->request_number }}</h3>
                                        <p class="text-sm text-gray-600">{{ $document->document_type_label }}</p>
                                    </div>
                                    <div class="mt-2 sm:mt-0">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                            @if($document->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($document->status === 'processing') bg-blue-100 text-blue-800
                                            @elseif($document->status === 'completed') bg-green-100 text-green-800
                                            @elseif($document->status === 'rejected') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            @if($document->status === 'pending')
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                </svg>
                                            @elseif($document->status === 'processing')
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path>
                                                </svg>
                                            @elseif($document->status === 'completed')
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                            @elseif($document->status === 'rejected')
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                                </svg>
                                            @endif
                                            {{ $document->status_label }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Left Column -->
                                    <div class="space-y-4">
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Data Pemohon</h4>
                                            <div class="mt-2 space-y-1">
                                                <p class="text-sm text-gray-900"><span class="font-medium">Nama:</span> {{ $document->applicant_name }}</p>
                                                <p class="text-sm text-gray-900"><span class="font-medium">NIK:</span> {{ $document->applicant_nik }}</p>
                                                <p class="text-sm text-gray-900"><span class="font-medium">Telepon:</span> {{ $document->applicant_phone }}</p>
                                            </div>
                                        </div>

                                        <div>
                                            <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Keperluan</h4>
                                            <p class="mt-2 text-sm text-gray-900">{{ $document->purpose }}</p>
                                        </div>
                                    </div>

                                    <!-- Right Column -->
                                    <div class="space-y-4">
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Timeline</h4>
                                            <div class="mt-2 space-y-2">
                                                <div class="flex items-center text-sm">
                                                    <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                                                    <span class="text-gray-600">Diajukan:</span>
                                                    <span class="ml-2 text-gray-900">{{ $document->created_at->format('d M Y, H:i') }}</span>
                                                </div>
                                                @if($document->processed_at)
                                                    <div class="flex items-center text-sm">
                                                        <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                                                        <span class="text-gray-600">Diproses:</span>
                                                        <span class="ml-2 text-gray-900">{{ $document->processed_at->format('d M Y, H:i') }}</span>
                                                    </div>
                                                @endif
                                                @if($document->completed_at)
                                                    <div class="flex items-center text-sm">
                                                        <div class="w-2 h-2 bg-purple-500 rounded-full mr-3"></div>
                                                        <span class="text-gray-600">Selesai:</span>
                                                        <span class="ml-2 text-gray-900">{{ $document->completed_at->format('d M Y, H:i') }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        @if($document->processor)
                                            <div>
                                                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Petugas</h4>
                                                <p class="mt-2 text-sm text-gray-900">{{ $document->processor->name }}</p>
                                            </div>
                                        @endif

                                        @if($document->notes)
                                            <div>
                                                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Catatan</h4>
                                                <p class="mt-2 text-sm text-gray-900">{{ $document->notes }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Progress Bar -->
                                <div class="mt-6">
                                    <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
                                        <span>Progress</span>
                                        <span>
                                            @if($document->status === 'pending') 25%
                                            @elseif($document->status === 'processing') 50%
                                            @elseif($document->status === 'completed') 100%
                                            @elseif($document->status === 'rejected') 0%
                                            @else 0%
                                            @endif
                                        </span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="h-2 rounded-full transition-all duration-300
                                            @if($document->status === 'pending') bg-yellow-500 w-1/4
                                            @elseif($document->status === 'processing') bg-blue-500 w-1/2
                                            @elseif($document->status === 'completed') bg-green-500 w-full
                                            @elseif($document->status === 'rejected') bg-red-500 w-0
                                            @else bg-gray-500 w-0
                                            @endif"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @elseif(request()->has('request_number') || request()->has('nik'))
                <!-- No Results -->
                <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak Ada Data Ditemukan</h3>
                    <p class="text-gray-600 mb-4">Pengajuan dengan nomor atau NIK yang Anda masukkan tidak ditemukan.</p>
                    <a href="{{ route('services.documents') }}" 
                       class="inline-flex items-center px-4 py-2 bg-[#14213d] text-white rounded-lg hover:bg-[#0f1a2e] transition duration-300">
                        Ajukan Dokumen Baru
                    </a>
                </div>
            @else
                <!-- Instructions -->
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <div class="text-center">
                        <svg class="w-16 h-16 text-[#14213d] mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Cara Melacak Pengajuan</h3>
                        <p class="text-gray-600 mb-6">Masukkan nomor pengajuan atau NIK pada form di atas untuk melihat status dokumen Anda</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left">
                            <div class="bg-blue-50 rounded-lg p-4">
                                <h4 class="font-semibold text-blue-900 mb-2">Nomor Pengajuan</h4>
                                <p class="text-sm text-blue-800">Nomor ini diberikan setelah Anda mengajukan dokumen. Format: REQ-YYYY-XXX</p>
                            </div>
                            <div class="bg-green-50 rounded-lg p-4">
                                <h4 class="font-semibold text-green-900 mb-2">NIK Pemohon</h4>
                                <p class="text-sm text-green-800">Masukkan 16 digit NIK sesuai dengan yang digunakan saat pengajuan</p>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <a href="{{ route('services.documents') }}" 
                               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 font-medium">
                                Ajukan Dokumen Baru
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        // NIK validation
        document.getElementById('nik').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 16);
        });
    </script>
</x-guest-public-layout>