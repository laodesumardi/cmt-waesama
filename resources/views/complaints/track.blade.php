<x-guest-public-layout>
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Lacak Status Pengaduan</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Masukkan nomor tiket pengaduan Anda untuk melihat status dan perkembangan terkini.
                </p>
            </div>

            <!-- Search Form -->
            <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
                <form action="{{ route('complaints.track.search') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <label for="ticket_number" class="block text-sm font-medium text-gray-700 mb-2">
                                Nomor Tiket Pengaduan
                            </label>
                            <input type="text" id="ticket_number" name="ticket_number" 
                                   value="{{ request('ticket_number') }}" 
                                   placeholder="Contoh: COMP-2024-001"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="flex items-end">
                            <button type="submit" 
                                    class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <div class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    Lacak
                                </div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(request('ticket_number') && !$complaint)
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800">
                                Pengaduan dengan nomor tiket "{{ request('ticket_number') }}" tidak ditemukan.
                            </p>
                            <p class="text-sm text-red-700 mt-1">
                                Pastikan nomor tiket yang Anda masukkan sudah benar.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Complaint Details -->
            @if($complaint)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-xl font-bold text-white">{{ $complaint->subject }}</h2>
                                <p class="text-blue-100">Tiket: {{ $complaint->ticket_number }}</p>
                            </div>
                            <div class="text-right">
                                {!! $complaint->status_badge !!}
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Status Progress -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Status Pengaduan</h3>
                            <div class="relative">
                                <div class="flex items-center justify-between">
                                    @php
                                        $statuses = ['open' => 'Diterima', 'in_progress' => 'Diproses', 'resolved' => 'Selesai'];
                                        $currentIndex = array_search($complaint->status, array_keys($statuses));
                                    @endphp
                                    
                                    @foreach($statuses as $key => $label)
                                        @php
                                            $index = array_search($key, array_keys($statuses));
                                            $isActive = $index <= $currentIndex;
                                            $isCurrent = $key === $complaint->status;
                                        @endphp
                                        
                                        <div class="flex flex-col items-center relative {{ $loop->last ? '' : 'flex-1' }}">
                                            <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $isActive ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-500' }}">
                                                @if($isActive)
                                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                @else
                                                    <span class="text-sm font-medium">{{ $index + 1 }}</span>
                                                @endif
                                            </div>
                                            <span class="text-sm font-medium text-gray-900 mt-2">{{ $label }}</span>
                                            @if($isCurrent)
                                                <span class="text-xs text-blue-600 mt-1">Saat ini</span>
                                            @endif
                                            
                                            @if(!$loop->last)
                                                <div class="absolute top-5 left-10 w-full h-0.5 {{ $index < $currentIndex ? 'bg-blue-600' : 'bg-gray-200' }}"></div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Complaint Info -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900 mb-3">Informasi Pengaduan</h4>
                                    <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Kategori:</span>
                                            <span class="text-sm font-medium text-gray-900">{{ ucfirst($complaint->category) }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Prioritas:</span>
                                            <span>{!! $complaint->priority_badge !!}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Tanggal Dibuat:</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $complaint->created_at->format('d M Y, H:i') }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Terakhir Update:</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $complaint->updated_at->format('d M Y, H:i') }}</span>
                                        </div>
                                        @if($complaint->assignedUser)
                                            <div class="flex justify-between">
                                                <span class="text-sm text-gray-600">Ditangani oleh:</span>
                                                <span class="text-sm font-medium text-gray-900">{{ $complaint->assignedUser->name }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-900 mb-3">Data Pengadu</h4>
                                    <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Nama:</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $complaint->complainant_name }}</span>
                                        </div>
                                        @if($complaint->complainant_email)
                                            <div class="flex justify-between">
                                                <span class="text-sm text-gray-600">Email:</span>
                                                <span class="text-sm font-medium text-gray-900">{{ $complaint->complainant_email }}</span>
                                            </div>
                                        @endif
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Telepon:</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $complaint->complainant_phone }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900 mb-3">Deskripsi Pengaduan</h4>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <p class="text-sm text-gray-700 leading-relaxed">{{ $complaint->description }}</p>
                                    </div>
                                </div>

                                @if($complaint->admin_notes)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900 mb-3">Catatan Petugas</h4>
                                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                            <p class="text-sm text-blue-800 leading-relaxed">{{ $complaint->admin_notes }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if($complaint->attachments && count($complaint->attachments) > 0)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900 mb-3">Lampiran</h4>
                                        <div class="space-y-2">
                                            @foreach($complaint->attachments as $attachment)
                                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                                    <div class="w-8 h-8 bg-blue-100 rounded flex items-center justify-center mr-3">
                                                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                                                        </svg>
                                                    </div>
                                                    <div class="flex-1">
                                                        <p class="text-sm font-medium text-gray-900">{{ $attachment['name'] }}</p>
                                                        <p class="text-xs text-gray-500">{{ number_format($attachment['size'] / 1024, 2) }} KB</p>
                                                    </div>
                                                    <a href="{{ Storage::url($attachment['path']) }}" target="_blank"
                                                       class="text-blue-600 hover:text-blue-800">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Help Section -->
            @if(!$complaint || !request('ticket_number'))
                <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-800">Bantuan</h3>
                            <div class="mt-2 text-sm text-blue-700">
                                <ul class="list-disc list-inside space-y-1">
                                    <li>Nomor tiket diberikan setelah Anda mengajukan pengaduan</li>
                                    <li>Format nomor tiket: COMP-YYYY-XXX (contoh: COMP-2024-001)</li>
                                    <li>Simpan nomor tiket untuk melacak status pengaduan</li>
                                    <li>Jika mengalami kesulitan, hubungi kami melalui halaman kontak</li>
                                </ul>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('services.complaints') }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium">
                                    Ajukan Pengaduan Baru →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-guest-public-layout>