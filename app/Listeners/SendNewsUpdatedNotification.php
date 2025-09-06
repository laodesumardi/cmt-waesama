<?php

namespace App\Listeners;

use App\Events\NewsUpdated;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNewsUpdatedNotification implements ShouldQueue
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
    public function handle(NewsUpdated $event): void
    {
        $news = $event->news;
        $oldStatus = $event->oldStatus;
        $newStatus = $event->newStatus;
        
        // Jika status berubah menjadi published, kirim notifikasi ke semua user
        if ($newStatus === 'published' && $oldStatus !== 'published') {
            // Notifikasi ke admin dan staff
            $adminStaffUsers = User::whereHas('roles', function($query) {
                $query->whereIn('name', ['admin', 'staff']);
            })->where('id', '!=', auth()->id())->get();

            foreach ($adminStaffUsers as $user) {
                $this->notificationService->send($user, 'news_published', [
                    'title' => 'Berita Dipublikasi',
                    'message' => "Berita '{$news->title}' telah dipublikasikan",
                    'url' => $user->hasRole('admin') 
                        ? route('admin.news.show', $news->id)
                        : route('staff.news.show', $news->id),
                    'icon' => 'fas fa-globe',
                    'news_id' => $news->id,
                    'news_category' => $news->category,
                ], [
                    'priority' => 'medium',
                    'broadcast' => true,
                    'email' => false,
                ]);
            }

            // Notifikasi ke user biasa jika berita penting atau featured
            if ($news->is_featured || $news->category === 'pengumuman') {
                $regularUsers = User::whereHas('roles', function($query) {
                    $query->where('name', 'user');
                })->get();

                foreach ($regularUsers as $user) {
                    $this->notificationService->send($user, 'important_news_published', [
                        'title' => 'Pengumuman Penting',
                        'message' => "Pengumuman penting: {$news->title}",
                        'url' => route('news.show', $news->slug),
                        'icon' => 'fas fa-bullhorn',
                        'news_id' => $news->id,
                        'news_category' => $news->category,
                    ], [
                        'priority' => 'high',
                        'broadcast' => true,
                        'email' => true,
                    ]);
                }
            }
        }

        // Jika ada perubahan status lainnya
        if ($oldStatus && $newStatus && $oldStatus !== $newStatus) {
            $targetUsers = collect();
            
            // Tentukan target notifikasi berdasarkan role pembuat perubahan
            if (auth()->user() && auth()->user()->hasRole('admin')) {
                // Admin mengubah, kirim ke staff
                $targetUsers = User::whereHas('roles', function($query) {
                    $query->where('name', 'staff');
                })->get();
            } elseif (auth()->user() && auth()->user()->hasRole('staff')) {
                // Staff mengubah, kirim ke admin
                $targetUsers = User::whereHas('roles', function($query) {
                    $query->where('name', 'admin');
                })->get();
            }

            foreach ($targetUsers as $user) {
                $this->notificationService->send($user, 'news_status_updated', [
                    'title' => 'Status Berita Diubah',
                    'message' => "Status berita '{$news->title}' diubah dari {$this->getStatusText($oldStatus)} ke {$this->getStatusText($newStatus)}",
                    'url' => $user->hasRole('admin') 
                        ? route('admin.news.show', $news->id)
                        : route('staff.news.show', $news->id),
                    'icon' => 'fas fa-sync-alt',
                    'news_id' => $news->id,
                    'old_status' => $oldStatus,
                    'new_status' => $newStatus,
                ], [
                    'priority' => 'medium',
                    'broadcast' => true,
                    'email' => false,
                ]);
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