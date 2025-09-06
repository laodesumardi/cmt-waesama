<?php

namespace App\Listeners;

use App\Events\GalleryCreated;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendGalleryCreatedNotification implements ShouldQueue
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
    public function handle(GalleryCreated $event): void
    {
        $gallery = $event->gallery;
        
        // Kirim notifikasi menggunakan metode baru di NotificationService
        $this->notificationService->sendGalleryNotification($gallery);
        
        // Jika galeri featured, kirim notifikasi khusus
        if ($gallery->is_featured) {
            $adminStaffUsers = User::whereHas('roles', function($query) {
                $query->whereIn('name', ['admin', 'staff']);
            })->where('id', '!=', auth()->id())->get();

            foreach ($adminStaffUsers as $user) {
                $this->notificationService->send($user, 'featured_gallery_created', [
                    'title' => 'Galeri Featured Baru',
                    'message' => "Galeri featured '{$gallery->title}' telah ditambahkan",
                    'url' => $user->hasRole('admin') 
                        ? route('admin.gallery.show', $gallery->id)
                        : route('staff.gallery.show', $gallery->id),
                    'icon' => 'fas fa-star',
                    'gallery_id' => $gallery->id,
                    'gallery_category' => $gallery->category,
                ], [
                    'priority' => 'medium',
                    'broadcast' => true,
                    'email' => false,
                ]);
            }
        }
    }
}