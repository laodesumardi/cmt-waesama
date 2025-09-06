<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Events\NotificationSent;
use App\Services\NotificationTypeService;

class NotificationService
{
    /**
     * Send notification to user(s)
     */
    public function send($users, $type, $data, $options = [])
    {
        // Handle different input types
        if ($users instanceof \Illuminate\Database\Eloquent\Collection) {
            $users = $users->all();
        } elseif (!is_array($users)) {
            $users = [$users];
        }
        
        $notifications = [];

        foreach ($users as $user) {
            $notification = $this->createNotification($user, $type, $data, $options);
            $notifications[] = $notification;

            // Broadcast for real-time if enabled
            if ($options['broadcast'] ?? false) {
                event(new NotificationSent($notification));
            }

            // Send email if enabled
            if ($options['email'] ?? false) {
                $this->sendEmail($user, $notification);
            }
        }

        return $notifications;
    }

    /**
     * Create notification record
     */
    private function createNotification($user, $type, $data, $options)
    {
        // Ensure $user is a model instance, not a collection
        if ($user instanceof \Illuminate\Database\Eloquent\Collection) {
            throw new \Exception('User parameter cannot be a collection');
        }
        
        return Notification::create([
            'type' => $type,
            'title' => $data['title'] ?? 'Notifikasi Baru',
            'message' => $data['message'] ?? '',
            'notifiable_type' => get_class($user),
            'notifiable_id' => $user->id,
            'data' => json_encode([
                'url' => $data['url'] ?? null,
                'icon' => $data['icon'] ?? 'fas fa-bell',
            ]),
            'action_url' => $data['url'] ?? null,
            'priority' => $options['priority'] ?? 'medium',
        ]);
    }

    /**
     * Send email notification
     */
    private function sendEmail($user, $notification)
    {
        try {
            // Implement email sending logic here
            Log::info('Email notification sent', [
                'user_id' => $user->id,
                'notification_id' => $notification->id
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send email notification', [
                'user_id' => $user->id,
                'notification_id' => $notification->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($notificationId, $userId = null)
    {
        $query = Notification::where('id', $notificationId);
        
        if ($userId) {
            $query->where('notifiable_id', $userId)
                  ->where('notifiable_type', User::class);
        }

        return $query->first()?->markAsRead();
    }

    /**
     * Mark all notifications as read for user
     */
    public function markAllAsRead($userId)
    {
        return Notification::where('notifiable_id', $userId)
            ->where('notifiable_type', User::class)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }

    /**
     * Get unread notifications count for user
     */
    public function getUnreadCount($userId)
    {
        return Notification::where('notifiable_id', $userId)
            ->where('notifiable_type', User::class)
            ->whereNull('read_at')
            ->count();
    }

    /**
     * Get notifications for user
     */
    public function getForUser($userId, $limit = 10, $unreadOnly = false)
    {
        $query = Notification::where('notifiable_id', $userId)
            ->where('notifiable_type', User::class)
            ->orderBy('created_at', 'desc');

        if ($unreadOnly) {
            $query->whereNull('read_at');
        }

        return $query->limit($limit)->get();
    }

    /**
     * Delete old notifications
     */
    public function deleteOld($days = 30)
    {
        return Notification::where('created_at', '<', now()->subDays($days))
            ->delete();
    }

    /**
     * Send notification for new news
     */
    public function sendNewsNotification($news, $users = null)
    {
        if (!$users) {
            $users = User::whereHas('roles', function($q) {
                $q->whereIn('name', ['admin', 'staff']);
            })->get()->all();
        }

        return $this->send($users, 'news', [
            'title' => 'Berita Baru Dipublikasikan',
            'message' => 'Berita "' . $news->title . '" telah dipublikasikan',
            'url' => route('news.show', $news->slug),
            'icon' => 'fas fa-newspaper',
            'news_id' => $news->id,
        ], [
            'priority' => 'medium',
            'broadcast' => true,
        ]);
    }

    /**
     * Send notification for new complaint
     */
    public function sendComplaintNotification($complaint, $users = null)
    {
        if (!$users) {
            $users = User::whereHas('roles', function($q) {
                $q->whereIn('name', ['admin', 'staff']);
            })->get()->all();
        }

        return $this->send($users, 'complaint', [
            'title' => 'Pengaduan Baru',
            'message' => 'Pengaduan baru dari ' . $complaint->name,
            'url' => route('admin.complaints.show', $complaint->id),
            'icon' => 'fas fa-exclamation-triangle',
            'complaint_id' => $complaint->id,
        ], [
            'priority' => 'high',
            'broadcast' => true,
            'email' => true,
        ]);
    }

    /**
     * Send notification for document status update
     */
    public function sendDocumentStatusNotification($document, $user)
    {
        $statusMessages = [
            'pending' => 'Dokumen Anda sedang diproses',
            'approved' => 'Dokumen Anda telah disetujui',
            'rejected' => 'Dokumen Anda ditolak',
            'completed' => 'Dokumen Anda telah selesai',
        ];

        return $this->send([$user], 'document_status', [
            'title' => 'Update Status Dokumen',
            'message' => $statusMessages[$document->status] ?? 'Status dokumen telah diperbarui',
            'url' => route('documents.show', $document->id),
            'icon' => 'fas fa-file-alt',
            'document_id' => $document->id,
            'status' => $document->status,
        ], [
            'priority' => 'medium',
            'broadcast' => true,
            'email' => true,
        ]);
    }

    /**
     * Send notification for new gallery
     */
    public function sendGalleryNotification($gallery, $users = null)
    {
        $typeConfig = NotificationTypeService::getType('gallery', 'created');
        if (!$typeConfig) return;

        if (!$users) {
            $recipients = collect();
            foreach ($typeConfig['target_roles'] as $role) {
                $roleUsers = User::whereHas('roles', function($q) use ($role) {
                    $q->where('name', $role);
                })->get();
                $recipients = $recipients->merge($roleUsers);
            }
            $users = $recipients->all();
        }

        return $this->send($users, 'gallery', [
            'title' => 'Galeri Baru Ditambahkan',
            'message' => 'Galeri "' . $gallery->title . '" telah ditambahkan',
            'url' => route('gallery') . '#gallery-' . $gallery->id,
            'icon' => $typeConfig['icon'],
            'gallery_id' => $gallery->id,
        ], [
            'priority' => $typeConfig['priority'],
            'broadcast' => true,
        ]);
    }

    /**
     * Send notification for new transparency
     */
    public function sendTransparencyNotification($transparency, $users = null)
    {
        $typeConfig = NotificationTypeService::getType('transparency', 'created');
        if (!$typeConfig) return;

        if (!$users) {
            $recipients = collect();
            foreach ($typeConfig['target_roles'] as $role) {
                $roleUsers = User::whereHas('roles', function($q) use ($role) {
                    $q->where('name', $role);
                })->get();
                $recipients = $recipients->merge($roleUsers);
            }
            $users = $recipients->all();
        }

        return $this->send($users, 'transparency', [
            'title' => 'Informasi Keterbukaan Baru',
            'message' => 'Informasi keterbukaan "' . $transparency->title . '" telah ditambahkan',
            'url' => route('transparency.show', $transparency->id),
            'icon' => $typeConfig['icon'],
            'transparency_id' => $transparency->id,
        ], [
            'priority' => $typeConfig['priority'],
            'broadcast' => true,
        ]);
    }

    /**
     * Send notification for transparency status update
     */
    public function sendTransparencyStatusNotification($transparency, $oldStatus, $users = null)
    {
        $typeConfig = NotificationTypeService::getType('transparency', 'status_updated');
        if (!$typeConfig) return;

        if (!$users) {
            $recipients = collect();
            foreach ($typeConfig['target_roles'] as $role) {
                $roleUsers = User::whereHas('roles', function($q) use ($role) {
                    $q->where('name', $role);
                })->get();
                $recipients = $recipients->merge($roleUsers);
            }
            $users = $recipients->all();
        }

        $statusMessages = [
            'draft' => 'Draft',
            'published' => 'Dipublikasikan',
            'archived' => 'Diarsipkan',
        ];

        return $this->send($users, 'transparency_status', [
            'title' => 'Status Keterbukaan Diperbarui',
            'message' => 'Status "' . $transparency->title . '" berubah dari ' . ($statusMessages[$oldStatus] ?? $oldStatus) . ' menjadi ' . ($statusMessages[$transparency->status] ?? $transparency->status),
            'url' => route('transparency.show', $transparency->id),
            'icon' => $typeConfig['icon'],
            'transparency_id' => $transparency->id,
            'old_status' => $oldStatus,
            'new_status' => $transparency->status,
        ], [
            'priority' => $typeConfig['priority'],
            'broadcast' => true,
        ]);
    }

    /**
     * Send notification for new document request
     */
    public function sendDocumentRequestNotification($documentRequest, $users = null)
    {
        $typeConfig = NotificationTypeService::getType('document_request', 'created');
        if (!$typeConfig) return;

        if (!$users) {
            $recipients = collect();
            foreach ($typeConfig['target_roles'] as $role) {
                $roleUsers = User::whereHas('roles', function($q) use ($role) {
                    $q->where('name', $role);
                })->get();
                $recipients = $recipients->merge($roleUsers);
            }
            $users = $recipients->all();
        }

        return $this->send($users, 'document_request', [
            'title' => 'Pengajuan Dokumen Baru',
            'message' => 'Pengajuan ' . $documentRequest->document_type_label . ' dari ' . $documentRequest->name,
            'url' => route('admin.document-requests.show', $documentRequest->id),
            'icon' => $typeConfig['icon'],
            'document_request_id' => $documentRequest->id,
            'document_type' => $documentRequest->document_type,
        ], [
            'priority' => $typeConfig['priority'],
            'broadcast' => true,
            'email' => true,
        ]);
    }

    /**
     * Send notification for document request status update
     */
    public function sendDocumentRequestStatusNotification($documentRequest, $oldStatus)
    {
        $statusMessages = [
            'pending' => 'Menunggu Verifikasi',
            'verified' => 'Terverifikasi',
            'processing' => 'Sedang Diproses',
            'ready' => 'Siap Diambil',
            'completed' => 'Selesai',
            'rejected' => 'Ditolak',
        ];

        // Send to document requester
        $userTypeConfig = NotificationTypeService::getType('document_request', 'status_updated');
        if ($userTypeConfig) {
            $this->send([$documentRequest->user], 'document_request_status', [
                'title' => 'Status Pengajuan Diperbarui',
                'message' => 'Status pengajuan ' . $documentRequest->document_type_label . ' Anda berubah menjadi ' . ($statusMessages[$documentRequest->status] ?? $documentRequest->status),
                'url' => route('documents.show', $documentRequest->id),
                'icon' => $userTypeConfig['icon'],
                'document_request_id' => $documentRequest->id,
                'old_status' => $oldStatus,
                'new_status' => $documentRequest->status,
            ], [
                'priority' => $userTypeConfig['priority'],
                'broadcast' => true,
                'email' => true,
            ]);
        }

        // Send to admin/staff
        $adminTypeConfig = NotificationTypeService::getType('document_request', 'status_updated_admin');
        if ($adminTypeConfig) {
            $recipients = collect();
            foreach ($adminTypeConfig['target_roles'] as $role) {
                $roleUsers = User::whereHas('roles', function($q) use ($role) {
                    $q->where('name', $role);
                })->get();
                $recipients = $recipients->merge($roleUsers);
            }

            return $this->send($recipients->all(), 'document_request_status_admin', [
                'title' => 'Status Dokumen Diperbarui',
                'message' => 'Status pengajuan ' . $documentRequest->document_type_label . ' dari ' . $documentRequest->name . ' berubah menjadi ' . ($statusMessages[$documentRequest->status] ?? $documentRequest->status),
                'url' => route('admin.document-requests.show', $documentRequest->id),
                'icon' => $adminTypeConfig['icon'],
                'document_request_id' => $documentRequest->id,
                'old_status' => $oldStatus,
                'new_status' => $documentRequest->status,
            ], [
                'priority' => $adminTypeConfig['priority'],
                'broadcast' => true,
            ]);
        }
    }

    /**
     * Send notification for complaint status update
     */
    public function sendComplaintStatusNotification($complaint, $oldStatus, $users = null)
    {
        $statusMessages = [
            'pending' => 'Menunggu',
            'in_progress' => 'Sedang Diproses',
            'resolved' => 'Selesai',
            'closed' => 'Ditutup',
        ];

        // Send to complaint submitter if exists
        if ($complaint->user_id) {
            $user = User::find($complaint->user_id);
            if ($user) {
                $userTypeConfig = NotificationTypeService::getType('complaint', 'status_updated');
                if ($userTypeConfig) {
                    $this->send([$user], 'complaint_status', [
                    'title' => 'Status Pengaduan Diperbarui',
                    'message' => 'Status pengaduan Anda berubah menjadi ' . ($statusMessages[$complaint->status] ?? $complaint->status),
                    'url' => route('complaints.show', $complaint->id),
                    'icon' => $userTypeConfig['icon'],
                    'complaint_id' => $complaint->id,
                    'old_status' => $oldStatus,
                    'new_status' => $complaint->status,
                ], [
                    'priority' => $userTypeConfig['priority'],
                    'broadcast' => true,
                    'email' => true,
                ]);
            }
            }
        }

        // Send to admin/staff
        $adminTypeConfig = NotificationTypeService::getType('complaint', 'status_updated_admin');
        if ($adminTypeConfig) {
            if (!$users) {
                $recipients = collect();
                foreach ($adminTypeConfig['target_roles'] as $role) {
                    $roleUsers = User::whereHas('roles', function($q) use ($role) {
                        $q->where('name', $role);
                    })->get();
                    $recipients = $recipients->merge($roleUsers);
                }
                $users = $recipients;
            }

            return $this->send($users->all(), 'complaint_status_admin', [
                'title' => 'Status Pengaduan Diperbarui',
                'message' => 'Status pengaduan dari ' . $complaint->name . ' berubah menjadi ' . ($statusMessages[$complaint->status] ?? $complaint->status),
                'url' => route('admin.complaints.show', $complaint->id),
                'icon' => $adminTypeConfig['icon'],
                'complaint_id' => $complaint->id,
                'old_status' => $oldStatus,
                'new_status' => $complaint->status,
            ], [
                'priority' => $adminTypeConfig['priority'],
                'broadcast' => true,
            ]);
        }
    }
}