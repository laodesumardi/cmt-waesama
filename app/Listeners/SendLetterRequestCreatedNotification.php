<?php

namespace App\Listeners;

use App\Events\LetterRequestCreated;
use App\Services\NotificationService;

class SendLetterRequestCreatedNotification
{

    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function handle(LetterRequestCreated $event)
    {
        $letterRequest = $event->letterRequest;
        
        // Use the centralized notification service method
        $this->notificationService->sendLetterRequestNotification($letterRequest);
    }
}