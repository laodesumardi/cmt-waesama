@extends('layouts.app')

@section('title', 'Kelola Pengaduan Masyarakat')

@section('content')


    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Complaint Details -->
                    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Informasi Pengaduan</h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Tiket</label>
                                    <p class="text-sm text-gray-900 font-mono bg-gray-100 px-3 py-2 rounded">{{ $complaint->ticket_number }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Dibuat</label>
                                    <p class="text-sm text-gray-900">{{ $complaint->created_at->format('d F Y, H:i') }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ ucfirst($complaint->category) }}
                                    </span>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Prioritas</label>
                                    @php
                                        $priorityColors = [
                                            'low' => 'bg-green-100 text-green-800',
                                            'medium' => 'bg-yellow-100 text-yellow-800',
                                            'high' => 'bg-orange-100 text-orange-800',
                                            'urgent' => 'bg-red-100 text-red-800'
                                        ];
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $priorityColors[$complaint->priority] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($complaint->priority) }}
                                    </span>
                                </div>
                            </div>

                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Subjek</label>
                                <p class="text-gray-900 text-lg font-medium">{{ $complaint->subject }}</p>
                            </div>

                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-gray-900 whitespace-pre-wrap">{{ $complaint->description }}</p>
                                </div>
                            </div>

                            @if($complaint->attachment_path)
                                <div class="mt-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Lampiran</label>
                                    <div class="flex items-center space-x-3">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                        </svg>
                                        <a href="{{ Storage::url($complaint->attachment_path) }}" target="_blank"
                                           class="text-blue-600 hover:text-blue-800 font-medium">
                                            Lihat Lampiran
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Complainant Information -->
                    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Informasi Pelapor</h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                    <p class="text-sm text-gray-900">{{ $complaint->complainant_name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <p class="text-sm text-gray-900">{{ $complaint->complainant_email }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                    <p class="text-sm text-gray-900">{{ $complaint->complainant_phone ?? '-' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                                    <p class="text-sm text-gray-900 font-mono">{{ $complaint->complainant_nik ?? '-' }}</p>
                                </div>
                            </div>

                            @if($complaint->complainant_address)
                                <div class="mt-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                    <p class="text-sm text-gray-900">{{ $complaint->complainant_address }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Admin Notes -->
                    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Catatan Staff</h3>
                        </div>
                        <div class="p-6">
                            <form id="notesForm" class="space-y-4">
                                @csrf
                                <div>
                                    <label for="admin_notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan Internal</label>
                                    <textarea id="admin_notes" name="admin_notes" rows="4"
                                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                              placeholder="Tambahkan catatan internal untuk pengaduan ini...">{{ $complaint->admin_notes }}</textarea>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit"
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                        Simpan Catatan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Status Management -->
                    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Kelola Status</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Saat Ini</label>
                                    @php
                                        $statusColors = [
                                            'open' => 'bg-blue-100 text-blue-800',
                                            'in_progress' => 'bg-yellow-100 text-yellow-800',
                                            'resolved' => 'bg-green-100 text-green-800',
                                            'closed' => 'bg-gray-100 text-gray-800'
                                        ];
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusColors[$complaint->status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                                    </span>
                                </div>

                                <form id="statusForm" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Ubah Status</label>
                                        <select id="status" name="status"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="open" {{ $complaint->status == 'open' ? 'selected' : '' }}>Terbuka</option>
                                            <option value="in_progress" {{ $complaint->status == 'in_progress' ? 'selected' : '' }}>Sedang Diproses</option>
                                            <option value="resolved" {{ $complaint->status == 'resolved' ? 'selected' : '' }}>Selesai</option>
                                            <option value="closed" {{ $complaint->status == 'closed' ? 'selected' : '' }}>Ditutup</option>
                                        </select>
                                    </div>

                                    <button type="submit"
                                            class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                        Update Status
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Priority Management -->
                    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Kelola Prioritas</h3>
                        </div>
                        <div class="p-6">
                            <form id="priorityForm" class="space-y-4">
                                @csrf
                                <div>
                                    <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Prioritas</label>
                                    <select id="priority" name="priority"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <option value="low" {{ $complaint->priority == 'low' ? 'selected' : '' }}>Rendah</option>
                                        <option value="medium" {{ $complaint->priority == 'medium' ? 'selected' : '' }}>Sedang</option>
                                        <option value="high" {{ $complaint->priority == 'high' ? 'selected' : '' }}>Tinggi</option>
                                        <option value="urgent" {{ $complaint->priority == 'urgent' ? 'selected' : '' }}>Mendesak</option>
                                    </select>
                                </div>

                                <button type="submit"
                                        class="w-full bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                    Update Prioritas
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Assignment -->
                    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Penugasan</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Ditugaskan Kepada</label>
                                    <p class="text-sm text-gray-900">{{ $complaint->assignedUser?->name ?? 'Belum ditugaskan' }}</p>
                                </div>

                                <form id="assignForm" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="assigned_to" class="block text-sm font-medium text-gray-700 mb-2">Tugaskan Kepada</label>
                                        <select id="assigned_to" name="assigned_to"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="">Pilih Staff</option>
                                            @foreach($staffUsers as $staff)
                                                <option value="{{ $staff->id }}" {{ $complaint->assigned_to == $staff->id ? 'selected' : '' }}>
                                                    {{ $staff->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit"
                                            class="w-full bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                        Update Penugasan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Metadata -->
                    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Informasi Tambahan</h3>
                        </div>
                        <div class="p-6 space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Dibuat:</span>
                                <span class="text-gray-900">{{ $complaint->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Diperbarui:</span>
                                <span class="text-gray-900">{{ $complaint->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                            @if($complaint->updated_by)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Diperbarui oleh:</span>
                                    <span class="text-gray-900">{{ $complaint->updatedBy?->name ?? 'System' }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Status Form
        document.getElementById('statusForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch(`{{ route('staff.complaints.update-status', $complaint) }}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    status: formData.get('status')
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Terjadi kesalahan: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengupdate status');
            });
        });

        // Priority Form
        document.getElementById('priorityForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch(`{{ route('staff.complaints.update-priority', $complaint) }}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    priority: formData.get('priority')
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Terjadi kesalahan: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengupdate prioritas');
            });
        });

        // Assignment Form
        document.getElementById('assignForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch(`{{ route('staff.complaints.assign', $complaint) }}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    assigned_to: formData.get('assigned_to')
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Terjadi kesalahan: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengupdate penugasan');
            });
        });

        // Notes Form
        document.getElementById('notesForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch(`{{ route('staff.complaints.save-notes', $complaint) }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    admin_notes: formData.get('admin_notes')
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Catatan berhasil disimpan');
                } else {
                    alert('Terjadi kesalahan: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan catatan');
            });
        });
    </script>
    @endpush
@endsection
