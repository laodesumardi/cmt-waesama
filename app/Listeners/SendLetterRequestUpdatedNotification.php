<?php

namespace App\Listeners;

use App\Events\LetterRequestUpdated;
use App\Services\NotificationService;

class SendLetterRequestUpdatedNotification
{

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
    public function handle(LetterRequestUpdated $event): void
    {
        $letterRequest = $event->letterRequest;
        $oldStatus = $event->oldStatus;
        
        // Use the centralized notification service method
        $this->notificationService->sendLetterRequestStatusNotification($letterRequest, $oldStatus);
    }
}