<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Complaint;
use App\Models\Notification;
use App\Events\ComplaintCreated;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;

class NotificationDebugTest extends TestCase
{
    use RefreshDatabase;

    public function test_complaint_created_event_creates_notification()
    {
        // Seed roles and permissions
        $this->artisan('db:seed', ['--class' => 'RolePermissionSeeder']);
        
        // Create admin user
        $admin = User::factory()->create([
            'email' => 'admin@test.com',
            'name' => 'Test Admin'
        ]);
        $admin->assignRole('admin');
        
        // Create complaint
        $complaint = Complaint::create([
            'complainant_name' => 'Test User',
            'complainant_email' => 'test@example.com',
            'complainant_phone' => '081234567890',
            'complainant_address' => 'Test Address',
            'subject' => 'Test Complaint',
            'description' => 'This is a test complaint',
            'category' => 'infrastruktur',
            'priority' => 'medium',
            'status' => 'open'
        ]);
        
        // Fire the event
        event(new ComplaintCreated($complaint));
        
        // Check if notification was created
        $this->assertDatabaseHas('notifications', [
            'notifiable_id' => $admin->id,
            'type' => 'complaint_created'
        ]);
        
        // Check notification count
        $notificationCount = Notification::where('notifiable_id', $admin->id)->count();
        echo "\nNotifications created for admin: {$notificationCount}\n";
        
        // Display notification details
        $notifications = Notification::where('notifiable_id', $admin->id)->get();
        foreach ($notifications as $notification) {
            echo "Notification: {$notification->type} - {$notification->data}\n";
        }
        
        $this->assertTrue($notificationCount > 0, 'No notifications were created');
    }
    
    public function test_notification_service_provider_registered()
    {
        $providers = app()->getLoadedProviders();
        $this->assertArrayHasKey('App\\Providers\\NotificationServiceProvider', $providers);
        echo "\nNotificationServiceProvider is registered\n";
    }
    
    public function test_unread_notification_count()
    {
        // Seed roles and permissions
        $this->artisan('db:seed', ['--class' => 'RolePermissionSeeder']);
        
        // Create admin user
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        
        // Create some notifications
        Notification::create([
            'type' => 'test',
            'title' => 'Test Notification',
            'message' => 'Test message',
            'notifiable_type' => User::class,
            'notifiable_id' => $admin->id,
            'priority' => 'medium',
            'channel' => 'web',
            'data' => json_encode(['test' => true])
        ]);
        
        $notificationService = app(\App\Services\NotificationService::class);
        $unreadCount = $notificationService->getUnreadCount($admin->id);
        
        echo "\nUnread notification count for admin: {$unreadCount}\n";
        
        $this->assertEquals(1, $unreadCount);
    }
}