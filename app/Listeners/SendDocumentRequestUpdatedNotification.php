<?php

namespace App\Listeners;

use App\Events\DocumentRequestUpdated;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendDocumentRequestUpdatedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    protected $notificationService;

    /**
     * Create the event listener.
     */
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the event.
     */
    public function handle(DocumentRequestUpdated $event): void
    {
        $documentRequest = $event->documentRequest;
        $oldStatus = $event->oldStatus;
        
        // Hanya kirim notifikasi jika status berubah
        if ($oldStatus !== $documentRequest->status) {
            // Kirim notifikasi menggunakan metode baru di NotificationService
            $this->notificationService->sendDocumentRequestStatusNotification($documentRequest, $oldStatus);

            // Kirim email khusus jika status menjadi ready atau completed
            if (in_array($documentRequest->status, ['ready', 'completed']) && $documentRequest->user_id) {
                $this->notificationService->send($documentRequest->user, 'document_ready_notification', [
                    'title' => $documentRequest->status === 'ready' ? 'Dokumen Siap Diambil' : 'Dokumen Selesai',
                    'message' => $documentRequest->status === 'ready' 
                        ? "Dokumen {$documentRequest->document_type_label} Anda sudah siap diambil di kantor kecamatan"
                        : "Dokumen {$documentRequest->document_type_label} Anda telah selesai diproses",
                    'url' => route('documents.show', $documentRequest->id),
                    'icon' => 'fas fa-check-circle',
                    'document_request_id' => $documentRequest->id,
                ], [
                    'priority' => 'high',
                    'broadcast' => true,
                    'email' => true,
                ]);
            }
        }
    }

    private function getStatusMessage($status)
    {
        return match($status) {
            'pending' => 'Menunggu diproses',
            'processing' => 'Sedang diproses',
            'completed' => 'Selesai dan siap diambil',
            'rejected' => 'Ditolak, silakan periksa catatan penolakan',
            default => 'Status tidak diketahui'
        };
    }

    private function getStatusPriority($status)
    {
        return match($status) {
            'completed' => 'high',
            'rejected' => 'high',
            'processing' => 'medium',
            'pending' => 'low',
            default => 'low'
        };
    }

    private function getStatusIcon($status)
    {
        return match($status) {
            'pending' => 'fas fa-clock',
            'processing' => 'fas fa-spinner',
            'completed' => 'fas fa-check-circle',
            'rejected' => 'fas fa-times-circle',
            default => 'fas fa-file-alt'
        };
    }

    private function getStatusText($status)
    {
        return match($status) {
            'pending' => 'Menunggu',
            'processing' => 'Diproses',
            'completed' => 'Selesai',
            'rejected' => 'Ditolak',
            default => $status
        };
    }
}