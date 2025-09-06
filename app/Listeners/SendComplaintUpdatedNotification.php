<?php

namespace App\Listeners;

use App\Events\ComplaintUpdated;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendComplaintUpdatedNotification implements ShouldQueue
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
    public function handle(ComplaintUpdated $event): void
    {
        $complaint = $event->complaint;
        $oldStatus = $event->oldStatus;
        
        // Hanya kirim notifikasi jika status berubah
        if ($oldStatus !== $complaint->status) {
            // Kirim notifikasi menggunakan metode baru di NotificationService
            $this->notificationService->sendComplaintStatusNotification($complaint, $oldStatus);
        }
    }

    private function getStatusText($status)
    {
        $statusMap = [
            'open' => 'Terbuka',
            'in_progress' => 'Sedang Diproses',
            'resolved' => 'Selesai',
            'closed' => 'Ditutup',
        ];

        return $statusMap[$status] ?? $status;
    }

    private function isImportantStatusChange($oldStatus, $newStatus)
    {
        $importantChanges = [
            'open' => ['in_progress', 'resolved', 'closed'],
            'in_progress' => ['resolved', 'closed'],
        ];

        return isset($importantChanges[$oldStatus]) && in_array($newStatus, $importantChanges[$oldStatus]);
    }
}