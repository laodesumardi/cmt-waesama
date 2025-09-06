<?php

namespace App\Listeners;

use App\Events\TransparencyUpdated;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendTransparencyUpdatedNotification implements ShouldQueue
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
    public function handle(TransparencyUpdated $event): void
    {
        $transparency = $event->transparency;
        $oldStatus = $event->oldStatus;
        $newStatus = $event->newStatus;
        
        // Hanya kirim notifikasi jika status berubah
        if ($oldStatus && $newStatus && $oldStatus !== $newStatus) {
            // Kirim notifikasi menggunakan metode baru di NotificationService
            $this->notificationService->sendTransparencyStatusNotification($transparency, $oldStatus);

            // Jika status menjadi published, kirim notifikasi khusus ke semua admin dan staff
            if ($newStatus === 'published' && $oldStatus !== 'published') {
                $adminStaffUsers = User::whereHas('roles', function($query) {
                    $query->whereIn('name', ['admin', 'staff']);
                })->where('id', '!=', auth()->id())->get();

                foreach ($adminStaffUsers as $user) {
                    $this->notificationService->send($user, 'transparency_published', [
                        'title' => 'Transparansi Dipublikasikan',
                        'message' => "Transparansi '{$transparency->title}' telah dipublikasikan",
                        'url' => $user->hasRole('admin') 
                            ? route('admin.transparency.show', $transparency->id)
                            : route('staff.transparency.show', $transparency->id),
                        'icon' => 'fas fa-globe',
                        'transparency_id' => $transparency->id,
                    ], [
                        'priority' => 'medium',
                        'broadcast' => true,
                        'email' => false,
                    ]);
                }
            }
        }
    }

    private function getStatusText($status)
    {
        $statusMap = [
            'draft' => 'Draft',
            'published' => 'Dipublikasi',
            'archived' => 'Diarsipkan',
        ];

        return $statusMap[$status] ?? $status;
    }
}