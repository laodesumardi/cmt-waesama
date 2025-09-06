<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Display notifications for current user
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $perPage = $request->get('per_page', 15);
        $type = $request->get('type');
        $status = $request->get('status');

        $query = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', User::class)
            ->orderBy('created_at', 'desc');

        if ($type) {
            $query->where('type', $type);
        }

        if ($status === 'unread') {
            $query->whereNull('read_at');
        } elseif ($status === 'read') {
            $query->whereNotNull('read_at');
        }

        $notifications = $query->paginate($perPage);
        $unreadCount = $this->notificationService->getUnreadCount($user->id);

        $stats = [
            'total' => Notification::forUser($user->id)->count(),
            'unread' => $unreadCount,
            'read' => Notification::forUser($user->id)->read()->count(),
            'today' => Notification::forUser($user->id)
                ->whereDate('created_at', today())->count(),
        ];

        return view('admin.notifications.index', compact('notifications', 'stats'));
    }

    /**
     * Get notifications for dropdown/ajax
     */
    public function getNotifications(Request $request)
    {
        $user = Auth::user();
        $limit = $request->get('limit', 10);
        $unreadOnly = $request->boolean('unread_only', false);

        $notifications = $this->notificationService->getForUser(
            $user->id, 
            $limit, 
            $unreadOnly
        );

        $unreadCount = $this->notificationService->getUnreadCount($user->id);

        return response()->json([
            'notifications' => $notifications->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'type' => $notification->type,
                    'data' => $notification->data,
                    'priority' => $notification->priority,
                    'is_read' => $notification->isRead(),
                    'time_ago' => $notification->time_ago,
                    'created_at' => $notification->created_at->toISOString(),
                ];
            }),
            'unread_count' => $unreadCount,
        ]);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead(Request $request, $id)
    {
        $user = Auth::user();
        $success = $this->notificationService->markAsRead($id, $user->id);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => $success,
                'unread_count' => $this->notificationService->getUnreadCount($user->id),
            ]);
        }

        return back()->with('success', 'Notifikasi telah ditandai sebagai dibaca');
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead(Request $request)
    {
        $user = Auth::user();
        $count = $this->notificationService->markAllAsRead($user->id);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'marked_count' => $count,
                'unread_count' => 0,
            ]);
        }

        return back()->with('success', "$count notifikasi telah ditandai sebagai dibaca");
    }

    /**
     * Delete notification
     */
    public function destroy(Request $request, $id)
    {
        $user = Auth::user();
        
        $notification = Notification::where('id', $id)
            ->where('notifiable_id', $user->id)
            ->where('notifiable_type', User::class)
            ->first();

        if (!$notification) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Notifikasi tidak ditemukan'], 404);
            }
            return back()->with('error', 'Notifikasi tidak ditemukan');
        }

        $notification->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'unread_count' => $this->notificationService->getUnreadCount($user->id),
            ]);
        }

        return back()->with('success', 'Notifikasi telah dihapus');
    }

    /**
     * Send test notification (admin only)
     */
    public function sendTest(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'priority' => 'required|in:low,normal,high,urgent',
            'type' => 'required|string',
        ]);

        $user = User::findOrFail($request->user_id);
        
        $notification = $this->notificationService->send($user, $request->type, [
            'title' => $request->title,
            'message' => $request->message,
            'url' => $request->url,
            'icon' => $request->icon ?? 'fas fa-bell',
        ], [
            'priority' => $request->priority,
            'broadcast' => $request->boolean('broadcast', true),
            'email' => $request->boolean('email', false),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi test berhasil dikirim',
            'notification_id' => $notification[0]->id,
        ]);
    }

    /**
     * Get notification statistics (admin only)
     */
    public function getStats()
    {
        $stats = [
            'total_notifications' => Notification::count(),
            'unread_notifications' => Notification::whereNull('read_at')->count(),
            'notifications_today' => Notification::whereDate('created_at', today())->count(),
            'notifications_this_week' => Notification::whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])->count(),
            'by_type' => Notification::selectRaw('type, COUNT(*) as count')
                ->groupBy('type')
                ->pluck('count', 'type'),
            'by_priority' => Notification::selectRaw('priority, COUNT(*) as count')
                ->groupBy('priority')
                ->pluck('count', 'priority'),
        ];

        return response()->json($stats);
    }

    /**
     * Clean old notifications (admin only)
     */
    public function cleanOld(Request $request)
    {
        $days = $request->get('days', 30);
        $count = $this->notificationService->deleteOld($days);

        return response()->json([
            'success' => true,
            'deleted_count' => $count,
            'message' => "$count notifikasi lama telah dihapus",
        ]);
    }
}
