<?php

namespace App\Listeners;

use App\Events\ComplaintCreated;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendComplaintCreatedNotification implements ShouldQueue
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
    public function handle(ComplaintCreated $event): void
    {
        $complaint = $event->complaint;
        
        // Kirim notifikasi ke admin dan staff
        $adminStaffUsers = User::whereHas('roles', function($query) {
            $query->whereIn('name', ['admin', 'staff']);
        })->get();

        foreach ($adminStaffUsers as $user) {
            $this->notificationService->send($user, 'complaint_created', [
                'title' => 'Pengaduan Baru Diterima',
                'message' => "Pengaduan baru dari {$complaint->complainant_name} dengan subjek: {$complaint->subject}",
                'url' => $user->hasRole('admin') 
                    ? route('admin.complaints.show', $complaint->id)
                    : route('staff.complaints.show', $complaint->id),
                'icon' => 'fas fa-exclamation-triangle',
                'complaint_id' => $complaint->id,
                'complaint_category' => $complaint->category,
                'complaint_priority' => $complaint->priority,
            ], [
                'priority' => 'high',
                'broadcast' => true,
                'email' => false,
            ]);
        }
    }
}