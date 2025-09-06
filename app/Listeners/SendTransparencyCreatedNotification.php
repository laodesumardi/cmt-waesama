<?php

namespace App\Listeners;

use App\Events\TransparencyCreated;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendTransparencyCreatedNotification implements ShouldQueue
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
    public function handle(TransparencyCreated $event): void
    {
        $transparency = $event->transparency;
        
        // Kirim notifikasi menggunakan metode baru di NotificationService
        $this->notificationService->sendTransparencyNotification($transparency);
    }
}