@extends('layouts.app')

@section('title', 'detail Pengajuan Dokumen')

@section('content')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Pengaduan') }} - {{ $complaint->ticket_number }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.complaints.index') }}" class="inline-flex items-center px-3 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
                @if(auth()->user()->role === 'admin')
                    <button onclick="deleteComplaint()" class="inline-flex items-center px-3 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus
                    </button>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Complaint Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Informasi Pengaduan</h3>
                                <div class="flex space-x-2">
                                    {!! $complaint->status_badge !!}
                                    {!! $complaint->priority_badge !!}
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nomor Tiket</label>
                                    <p class="mt-1 text-sm text-gray-900 font-mono">{{ $complaint->ticket_number }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tanggal Dibuat</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $complaint->created_at->format('d F Y, H:i') }} WIB</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ App\Http\Controllers\ComplaintController::getCategories()[$complaint->category] ?? $complaint->category }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Ditugaskan ke</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $complaint->assignedUser->name ?? 'Belum ditugaskan' }}</p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700">Subjek</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $complaint->subject }}</p>
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <div class="mt-1 text-sm text-gray-900 whitespace-pre-wrap bg-gray-50 p-3 rounded-md">{{ $complaint->description }}</div>
                            </div>

                            @if($complaint->location)
                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $complaint->location }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Complainant Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Data Pengadu</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $complaint->complainant_name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Email</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $complaint->complainant_email }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $complaint->complainant_phone }}</p>
                                </div>
                                @if($complaint->user_id)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">User Terdaftar</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $complaint->user->name ?? 'N/A' }}</p>
                                    </div>
                                @endif
                            </div>

                            @if($complaint->complainant_address)
                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700">Alamat</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $complaint->complainant_address }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Attachments -->
                    @if($complaint->attachments && count($complaint->attachments) > 0)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Lampiran</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach($complaint->attachments as $attachment)
                                        <div class="border rounded-lg p-3">
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                                </svg>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $attachment['name'] ?? basename($attachment['path']) }}</p>
                                                    <p class="text-xs text-gray-500">{{ number_format(($attachment['size'] ?? Storage::size('public/' . $attachment['path'])) / 1024, 1) }} KB</p>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <a href="{{ Storage::url($attachment['path']) }}" target="_blank" class="text-xs text-indigo-600 hover:text-indigo-500">Lihat File</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Staff Notes -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Catatan Petugas</h3>

                            @if($complaint->staff_notes)
                                <div class="mb-4 p-3 bg-blue-50 rounded-md">
                                    <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $complaint->staff_notes }}</p>
                                    @if($complaint->updated_at != $complaint->created_at)
                                        <p class="text-xs text-gray-500 mt-2">Terakhir diperbarui: {{ $complaint->updated_at->format('d F Y, H:i') }} WIB</p>
                                    @endif
                                </div>
                            @endif

                            <form method="POST" action="{{ route('admin.complaints.save-notes', $complaint) }}">
                                @csrf
                                <div class="mb-4">
                                    <label for="staff_notes" class="block text-sm font-medium text-gray-700">Tambah/Edit Catatan</label>
                                    <textarea name="staff_notes" id="staff_notes" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Masukkan catatan untuk pengaduan ini...">{{ old('staff_notes', $complaint->staff_notes) }}</textarea>
                                </div>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                    </svg>
                                    Simpan Catatan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Aksi Cepat</h3>

                            <!-- Update Status -->
                            <form method="POST" action="{{ route('admin.complaints.update-status', $complaint) }}" class="mb-4">
                                @csrf
                                @method('PUT')
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Ubah Status</label>
                                <div class="flex space-x-2">
                                    <select name="status" id="status" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        @foreach(App\Http\Controllers\ComplaintController::getStatuses() as $key => $value)
                                            <option value="{{ $key }}" {{ $complaint->status == $key ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="inline-flex items-center px-3 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Update
                                    </button>
                                </div>
                            </form>

                            <!-- Update Priority -->
                            <form method="POST" action="{{ route('admin.complaints.update-priority', $complaint) }}" class="mb-4">
                                @csrf
                                @method('PUT')
                                <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Ubah Prioritas</label>
                                <div class="flex space-x-2">
                                    <select name="priority" id="priority" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        @foreach(App\Http\Controllers\ComplaintController::getPriorities() as $key => $value)
                                            <option value="{{ $key }}" {{ $complaint->priority == $key ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="inline-flex items-center px-3 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-700 focus:bg-orange-700 active:bg-orange-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Update
                                    </button>
                                </div>
                            </form>

                            <!-- Assign to Staff -->
                            <form method="POST" action="{{ route('admin.complaints.assign', $complaint) }}">
                                @csrf
                                @method('PUT')
                                <label for="assigned_to" class="block text-sm font-medium text-gray-700 mb-2">Tugaskan ke</label>
                                <div class="flex space-x-2">
                                    <select name="assigned_to" id="assigned_to" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="">Pilih Staff</option>
                                        @foreach($staffUsers as $user)
                                            <option value="{{ $user->id }}" {{ $complaint->assigned_to == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="inline-flex items-center px-3 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Assign
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Status Timeline -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Timeline Status</h3>

                            <div class="flow-root">
                                <ul class="-mb-8">
                                    <li>
                                        <div class="relative pb-8">
                                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                            <div class="relative flex space-x-3">
                                                <div>
                                                    <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="min-w-0 flex-1 pt-1.5">
                                                    <div>
                                                        <p class="text-sm text-gray-500">Pengaduan dibuat</p>
                                                        <p class="text-xs text-gray-400">{{ $complaint->created_at->format('d F Y, H:i') }} WIB</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    @if($complaint->status != 'open')
                                        <li>
                                            <div class="relative pb-8">
                                                @if($complaint->status != 'resolved' && $complaint->status != 'closed')
                                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                                @endif
                                                <div class="relative flex space-x-3">
                                                    <div>
                                                        <span class="h-8 w-8 rounded-full {{ $complaint->status == 'in_progress' ? 'bg-blue-500' : 'bg-green-500' }} flex items-center justify-center ring-8 ring-white">
                                                            @if($complaint->status == 'in_progress')
                                                                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                                </svg>
                                                            @else
                                                                <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                                </svg>
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="min-w-0 flex-1 pt-1.5">
                                                        <div>
                                                            <p class="text-sm text-gray-500">Status: {{ App\Http\Controllers\ComplaintController::getStatuses()[$complaint->status] }}</p>
                                                            <p class="text-xs text-gray-400">{{ $complaint->updated_at->format('d F Y, H:i') }} WIB</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endif

                                    @if($complaint->assigned_to)
                                        <li>
                                            <div class="relative">
                                                <div class="relative flex space-x-3">
                                                    <div>
                                                        <span class="h-8 w-8 rounded-full bg-purple-500 flex items-center justify-center ring-8 ring-white">
                                                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <div class="min-w-0 flex-1 pt-1.5">
                                                        <div>
                                                            <p class="text-sm text-gray-500">Ditugaskan ke {{ $complaint->assignedUser->name }}</p>
                                                            <p class="text-xs text-gray-400">{{ $complaint->updated_at->format('d F Y, H:i') }} WIB</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Kontak Pengadu</h3>

                            <div class="space-y-3">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <a href="mailto:{{ $complaint->complainant_email }}" class="text-sm text-indigo-600 hover:text-indigo-500">{{ $complaint->complainant_email }}</a>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <a href="tel:{{ $complaint->complainant_phone }}" class="text-sm text-indigo-600 hover:text-indigo-500">{{ $complaint->complainant_phone }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mt-2">Hapus Pengaduan</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus pengaduan ini? Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="confirm-delete" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-24 mr-2 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                        Hapus
                    </button>
                    <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-24 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
    <script>
        function deleteComplaint() {
            document.getElementById('delete-modal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('delete-modal').classList.add('hidden');
        }

        document.getElementById('confirm-delete').addEventListener('click', function() {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("admin.complaints.destroy", $complaint) }}';

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';

            form.appendChild(csrfToken);
            form.appendChild(methodInput);
            document.body.appendChild(form);
            form.submit();
        });

        // Close modal when clicking outside
        document.getElementById('delete-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>
    @endpush
@endsection