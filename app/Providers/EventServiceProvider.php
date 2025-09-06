<?php

namespace App\Providers;

use App\Events\ComplaintCreated;
use App\Events\ComplaintUpdated;
use App\Events\TransparencyCreated;
use App\Events\TransparencyUpdated;
use App\Events\NewsCreated;
use App\Events\NewsUpdated;
use App\Events\GalleryCreated;
use App\Events\DocumentRequestCreated;
use App\Events\DocumentRequestUpdated;
use App\Listeners\SendComplaintCreatedNotification;
use App\Listeners\SendComplaintUpdatedNotification;
use App\Listeners\SendTransparencyCreatedNotification;
use App\Listeners\SendTransparencyUpdatedNotification;
use App\Listeners\SendNewsCreatedNotification;
use App\Listeners\SendNewsUpdatedNotification;
use App\Listeners\SendGalleryCreatedNotification;
use App\Listeners\SendDocumentRequestCreatedNotification;
use App\Listeners\SendDocumentRequestUpdatedNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        
        // Complaint Events
        ComplaintCreated::class => [
            SendComplaintCreatedNotification::class,
        ],
        ComplaintUpdated::class => [
            SendComplaintUpdatedNotification::class,
        ],
        
        // Transparency Events
        TransparencyCreated::class => [
            SendTransparencyCreatedNotification::class,
        ],
        TransparencyUpdated::class => [
            SendTransparencyUpdatedNotification::class,
        ],
        
        // News Events
        NewsCreated::class => [
            SendNewsCreatedNotification::class,
        ],
        NewsUpdated::class => [
            SendNewsUpdatedNotification::class,
        ],
        
        // Gallery Events
        GalleryCreated::class => [
            SendGalleryCreatedNotification::class,
        ],
        
        // Document Request Events
        DocumentRequestCreated::class => [
            SendDocumentRequestCreatedNotification::class,
        ],
        DocumentRequestUpdated::class => [
            SendDocumentRequestUpdatedNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}