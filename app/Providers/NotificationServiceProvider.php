<?php

namespace App\Providers;

use App\Services\NotificationService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(NotificationService::class, function ($app) {
            return new NotificationService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share unread notification count with all views
        View::composer('*', function ($view) {
            try {
                if (Auth::check()) {
                    $notificationService = app(NotificationService::class);
                    $unreadCount = $notificationService->getUnreadCount(Auth::id());
                    $view->with('unreadNotificationCount', $unreadCount);
                } else {
                    // Provide default value for guests
                    $view->with('unreadNotificationCount', 0);
                }
            } catch (\Exception $e) {
                // Fallback to 0 if there's any error
                $view->with('unreadNotificationCount', 0);
            }
        });
    }
}
