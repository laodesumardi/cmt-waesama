<?php

namespace App\Listeners;

use App\Events\NewsCreated;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNewsCreatedNotification implements ShouldQueue
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
    public function handle(NewsCreated $event): void
    {
        $news = $event->news;
        
        // Kirim notifikasi ke admin jika dibuat oleh staff
        if (auth()->user() && auth()->user()->hasRole('staff')) {
            $adminUsers = User::whereHas('roles', function($query) {
                $query->where('name', 'admin');
            })->get();

            foreach ($adminUsers as $user) {
                $this->notificationService->send($user, 'news_created', [
                    'title' => 'Berita Baru Dibuat',
                    'message' => "Berita baru '{$news->title}' telah dibuat oleh staff dan menunggu review",
                    'url' => route('admin.news.show', $news->id),
                    'icon' => 'fas fa-newspaper',
                    'news_id' => $news->id,
                    'news_category' => $news->category,
                    'news_status' => $news->status,
                ], [
                    'priority' => 'medium',
                    'broadcast' => true,
                    'email' => false,
                ]);
            }
        }

        // Kirim notifikasi ke staff lain jika dibuat oleh admin
        if (auth()->user() && auth()->user()->hasRole('admin')) {
            $staffUsers = User::whereHas('roles', function($query) {
                $query->where('name', 'staff');
            })->where('id', '!=', auth()->id())->get();

            foreach ($staffUsers as $user) {
                $this->notificationService->send($user, 'news_created', [
                    'title' => 'Berita Baru Ditambahkan',
                    'message' => "Berita baru '{$news->title}' telah ditambahkan",
                    'url' => route('staff.news.show', $news->id),
                    'icon' => 'fas fa-newspaper',
                    'news_id' => $news->id,
                    'news_category' => $news->category,
                    'news_status' => $news->status,
                ], [
                    'priority' => 'low',
                    'broadcast' => true,
                    'email' => false,
                ]);
            }
        }
    }
}