@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-bell mr-2"></i>Notifikasi
        </h1>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-primary btn-sm" onclick="markAllAsRead()">
                <i class="fas fa-check-double"></i> Tandai Semua Dibaca
            </button>
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#testNotificationModal">
                <i class="fas fa-paper-plane"></i> Kirim Test
            </button>
            <button type="button" class="btn btn-warning btn-sm" onclick="cleanOldNotifications()">
                <i class="fas fa-trash"></i> Bersihkan Lama
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow-lg h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Notifikasi
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bell fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow-lg h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Belum Dibaca
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['unread'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow-lg h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Sudah Dibaca
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['read'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow-lg h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Hari Ini
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['today'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card shadow-lg mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Notifikasi</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.notifications.index') }}" class="row">
                <div class="col-md-3">
                    <label for="type">Tipe:</label>
                    <select name="type" id="type" class="form-control">
                        <option value="">Semua Tipe</option>
                        <option value="news" {{ request('type') == 'news' ? 'selected' : '' }}>Berita</option>
                        <option value="complaint" {{ request('type') == 'complaint' ? 'selected' : '' }}>Pengaduan</option>
                        <option value="document_status" {{ request('type') == 'document_status' ? 'selected' : '' }}>Status Dokumen</option>
                        <option value="system" {{ request('type') == 'system' ? 'selected' : '' }}>Sistem</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="status">Status:</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">Semua Status</option>
                        <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
                        <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="per_page">Per Halaman:</label>
                    <select name="per_page" id="per_page" class="form-control">
                        <option value="15" {{ request('per_page') == '15' ? 'selected' : '' }}>15</option>
                        <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary mr-2">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.notifications.index') }}" class="btn btn-secondary">
                        <i class="fas fa-undo"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Notifications List -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Notifikasi</h6>
        </div>
        <div class="card-body">
            @if($notifications->count() > 0)
                <div class="list-group">
                    @foreach($notifications as $notification)
                        <div class="list-group-item {{ $notification->isUnread() ? 'list-group-item-warning' : '' }}" id="notification-{{ $notification->id }}">
                            <div class="d-flex w-100 justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="{{ $notification->data['icon'] ?? 'fas fa-bell' }} mr-2 text-{{ $notification->priority == 'high' ? 'danger' : ($notification->priority == 'urgent' ? 'purple' : 'primary') }}"></i>
                                        <h6 class="mb-0 font-weight-bold">{{ $notification->data['title'] ?? 'Notifikasi' }}</h6>
                                        @if($notification->isUnread())
                                            <span class="badge badge-warning ml-2">Baru</span>
                                        @endif
                                        <span class="badge badge-{{ $notification->priority == 'high' ? 'danger' : ($notification->priority == 'urgent' ? 'purple' : 'secondary') }} ml-2">
                                            {{ ucfirst($notification->priority) }}
                                        </span>
                                    </div>
                                    <p class="mb-2 text-gray-700">{{ $notification->data['message'] ?? '' }}</p>
                                    <small class="text-muted">
                                        <i class="fas fa-clock mr-1"></i>{{ $notification->time_ago }}
                                        <span class="mx-2">•</span>
                                        <i class="fas fa-tag mr-1"></i>{{ ucfirst($notification->type) }}
                                    </small>
                                </div>
                                <div class="ml-3">
                                    <div class="btn-group" role="group">
                                        @if(isset($notification->data['url']))
                                            <a href="{{ $notification->data['url'] }}" class="btn btn-sm btn-outline-primary" onclick="markAsRead({{ $notification->id }})">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        @endif
                                        @if($notification->isUnread())
                                            <button type="button" class="btn btn-sm btn-outline-success" onclick="markAsRead({{ $notification->id }})" title="Tandai Dibaca">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        @endif
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteNotification({{ $notification->id }})" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $notifications->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-bell-slash fa-3x text-gray-300 mb-3"></i>
                    <h5 class="text-gray-500">Tidak ada notifikasi</h5>
                    <p class="text-gray-400">Notifikasi akan muncul di sini ketika ada aktivitas baru</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Test Notification Modal -->
<div class="modal fade" id="testNotificationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kirim Test Notifikasi</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="testNotificationForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="test_user_id">User:</label>
                        <select name="user_id" id="test_user_id" class="form-control" required>
                            <option value="{{ auth()->id() }}">{{ auth()->user()->name }} (Saya)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="test_title">Judul:</label>
                        <input type="text" name="title" id="test_title" class="form-control" value="Test Notifikasi" required>
                    </div>
                    <div class="form-group">
                        <label for="test_message">Pesan:</label>
                        <textarea name="message" id="test_message" class="form-control" rows="3" required>Ini adalah test notifikasi dari sistem.</textarea>
                    </div>
                    <div class="form-group">
                        <label for="test_type">Tipe:</label>
                        <input type="text" name="type" id="test_type" class="form-control" value="test" required>
                    </div>
                    <div class="form-group">
                        <label for="test_priority">Prioritas:</label>
                        <select name="priority" id="test_priority" class="form-control" required>
                            <option value="low">Rendah</option>
                            <option value="normal" selected>Normal</option>
                            <option value="high">Tinggi</option>
                            <option value="urgent">Mendesak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="test_url">URL (opsional):</label>
                        <input type="url" name="url" id="test_url" class="form-control">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="broadcast" id="test_broadcast" class="form-check-input" checked>
                        <label class="form-check-label" for="test_broadcast">
                            Broadcast Real-time
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="email" id="test_email" class="form-check-input">
                        <label class="form-check-label" for="test_email">
                            Kirim Email
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Mark notification as read
function markAsRead(notificationId) {
    fetch(`/admin/notifications/${notificationId}/read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const notificationElement = document.getElementById(`notification-${notificationId}`);
            notificationElement.classList.remove('list-group-item-warning');
            const badge = notificationElement.querySelector('.badge-warning');
            if (badge) badge.remove();
            
            // Update unread count if exists
            updateUnreadCount(data.unread_count);
        }
    })
    .catch(error => console.error('Error:', error));
}

// Mark all notifications as read
function markAllAsRead() {
    if (!confirm('Tandai semua notifikasi sebagai dibaca?')) return;
    
    fetch('/admin/notifications/read-all', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}

// Delete notification
function deleteNotification(notificationId) {
    if (!confirm('Hapus notifikasi ini?')) return;
    
    fetch(`/admin/notifications/${notificationId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`notification-${notificationId}`).remove();
            updateUnreadCount(data.unread_count);
        }
    })
    .catch(error => console.error('Error:', error));
}

// Clean old notifications
function cleanOldNotifications() {
    const days = prompt('Hapus notifikasi yang lebih lama dari berapa hari?', '30');
    if (!days || isNaN(days)) return;
    
    fetch('/admin/notifications/clean-old', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ days: parseInt(days) })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}

// Send test notification
document.getElementById('testNotificationForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    data.broadcast = formData.has('broadcast');
    data.email = formData.has('email');
    
    fetch('/admin/notifications/send-test', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Test notifikasi berhasil dikirim!');
            $('#testNotificationModal').modal('hide');
            location.reload();
        } else {
            alert('Gagal mengirim test notifikasi');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan');
    });
});

// Update unread count in UI
function updateUnreadCount(count) {
    // Update any unread count displays
    const unreadElements = document.querySelectorAll('.unread-count');
    unreadElements.forEach(el => {
        el.textContent = count;
        el.style.display = count > 0 ? 'inline' : 'none';
    });
}
</script>
@endpush

@push('styles')
<style>
.badge-purple {
    color: #fff;
    background-color: #6f42c1;
}

.text-purple {
    color: #6f42c1 !important;
}

.list-group-item-warning {
    background-color: #fff3cd;
    border-color: #ffeaa7;
}

.notification-item:hover {
    background-color: #f8f9fa;
}

.btn-group .btn {
    margin-left: 2px;
}
</style>
@endpush