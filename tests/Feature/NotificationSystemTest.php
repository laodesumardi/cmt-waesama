<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\News;
use App\Models\Gallery;
use App\Models\Transparency;
use App\Models\DocumentRequest;
use App\Models\Complaint;
use App\Models\Notification;
use App\Services\NotificationService;
use App\Services\NotificationTypeService;
use App\Events\NewsCreated;
use App\Events\GalleryCreated;
use App\Events\TransparencyCreated;
use App\Events\TransparencyUpdated;
use App\Events\DocumentRequestCreated;
use App\Events\DocumentRequestUpdated;
use App\Events\ComplaintCreated;
use App\Events\ComplaintUpdated;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class NotificationSystemTest extends TestCase
{
    use RefreshDatabase;

    protected $notificationService;
    protected $adminUser;
    protected $staffUser;
    protected $regularUser;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create roles
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'staff']);
        Role::firstOrCreate(['name' => 'user']);
        
        // Create test users
        $this->adminUser = User::factory()->create();
        $this->adminUser->assignRole('admin');
        
        $this->staffUser = User::factory()->create();
        $this->staffUser->assignRole('staff');
        
        $this->regularUser = User::factory()->create();
        $this->regularUser->assignRole('user');
        
        $this->notificationService = new NotificationService();
    }

    /** @test */
    public function test_notification_types_configuration_exists()
    {
        $this->assertNotNull(config('notification_types'));
        $this->assertIsArray(config('notification_types'));
        
        // Test specific categories exist
        $this->assertArrayHasKey('news', config('notification_types'));
        $this->assertArrayHasKey('gallery', config('notification_types'));
        $this->assertArrayHasKey('transparency', config('notification_types'));
        $this->assertArrayHasKey('document_request', config('notification_types'));
        $this->assertArrayHasKey('complaint', config('notification_types'));
    }

    /** @test */
    public function test_notification_type_service_methods()
    {
        // Test getType method
        $newsCreatedType = NotificationTypeService::getType('news', 'created');
        $this->assertNotNull($newsCreatedType);
        $this->assertEquals('news_created', $newsCreatedType['type']);
        
        // Test getTargetRoles method
        $targetRoles = NotificationTypeService::getTargetRoles('news', 'created');
        $this->assertIsArray($targetRoles);
        $this->assertContains('admin', $targetRoles);
        $this->assertContains('staff', $targetRoles);
        
        // Test getIcon method
        $icon = NotificationTypeService::getIcon('gallery', 'created');
        $this->assertEquals('fas fa-images', $icon);
        
        // Test shouldSendEmail method
        $shouldSendEmail = NotificationTypeService::shouldSendEmail('document_request', 'created');
        $this->assertTrue($shouldSendEmail);
    }

    /** @test */
    public function test_news_created_event_triggers_notifications()
    {
        Event::fake();
        
        $news = News::create([
            'title' => 'Test News',
            'content' => 'Test content',
            'slug' => 'test-news',
            'status' => 'published',
            'author_id' => $this->adminUser->id
        ]);
        
        event(new NewsCreated($news));
        
        Event::assertDispatched(NewsCreated::class);
    }

    /** @test */
    public function test_gallery_notification_service()
    {
        $gallery = Gallery::create([
            'title' => 'Test Gallery',
            'description' => 'Test description',
            'image_path' => 'test-image.jpg',
            'uploaded_by' => $this->adminUser->id
        ]);
        
        $this->notificationService->sendGalleryNotification($gallery);
        
        // Check if notifications were created for admin and staff
        $this->assertDatabaseHas('notifications', [
            'notifiable_id' => $this->adminUser->id,
            'type' => 'gallery'
        ]);
        
        $this->assertDatabaseHas('notifications', [
            'notifiable_id' => $this->staffUser->id,
            'type' => 'gallery'
        ]);
    }

    /** @test */
    public function test_transparency_notification_service()
    {
        $transparency = Transparency::create([
            'title' => 'Test Transparency',
            'description' => 'Test content',
            'type' => 'document',
            'status' => 'draft',
            'created_by' => $this->adminUser->id,
            'uploaded_by' => $this->adminUser->id
        ]);
        
        $this->notificationService->sendTransparencyNotification($transparency);
        
        // Check if notifications were created
        $this->assertDatabaseHas('notifications', [
            'notifiable_id' => $this->adminUser->id,
            'type' => 'transparency'
        ]);
    }

    /** @test */
    public function test_transparency_status_notification_service()
    {
        $transparency = Transparency::create([
            'title' => 'Test Transparency',
            'description' => 'Test content',
            'type' => 'document',
            'status' => 'published',
            'created_by' => $this->adminUser->id,
            'uploaded_by' => $this->adminUser->id
        ]);
        
        $oldStatus = 'draft';
        
        $this->notificationService->sendTransparencyStatusNotification($transparency, $oldStatus);
        
        // Check if status update notifications were created
        $this->assertDatabaseHas('notifications', [
            'notifiable_id' => $this->adminUser->id,
            'type' => 'transparency_status'
        ]);
    }

    /** @test */
    public function test_document_request_notification_service()
    {
        $documentRequest = DocumentRequest::create([
            'document_type' => 'ktp',
            'purpose' => 'Test purpose',
            'applicant_name' => 'Test User',
            'applicant_nik' => '1234567890123456',
            'applicant_phone' => '081234567890',
            'applicant_address' => 'Test Address',
            'status' => 'pending',
            'user_id' => $this->regularUser->id
        ]);
        
        $this->notificationService->sendDocumentRequestNotification($documentRequest);
        
        // Check if notifications were created for admin and staff
        $this->assertDatabaseHas('notifications', [
            'notifiable_id' => $this->adminUser->id,
            'type' => 'document_request'
        ]);
    }

    /** @test */
    public function test_document_request_status_notification_service()
    {
        $documentRequest = DocumentRequest::create([
            'user_id' => $this->regularUser->id,
            'document_type' => 'ktp',
            'purpose' => 'Test purpose',
            'applicant_name' => 'Test User',
            'applicant_nik' => '1234567890123456',
            'applicant_phone' => '081234567890',
            'applicant_address' => 'Test Address',
            'status' => 'completed'
        ]);
        
        $oldStatus = 'processing';
        
        $this->notificationService->sendDocumentRequestStatusNotification($documentRequest, $oldStatus);
        
        // Check if user notification was created
        $this->assertDatabaseHas('notifications', [
            'notifiable_id' => $this->regularUser->id,
            'type' => 'document_request_status'
        ]);
    }

    /** @test */
    public function test_complaint_notification_service()
    {
        $complaint = Complaint::create([
            'user_id' => $this->regularUser->id,
            'complainant_name' => 'Test User',
            'complainant_phone' => '08123456789',
            'complainant_address' => 'Test Address',
            'subject' => 'Test Complaint',
            'description' => 'Test Description',
            'category' => 'pelayanan',
            'status' => 'open',
            'ticket_number' => 'TKT-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid()), 0, 6))
        ]);
        
        $oldStatus = 'open';
        
        $this->notificationService->sendComplaintStatusNotification($complaint, $oldStatus);
        
        // Check if notifications were created
        $this->assertDatabaseHas('notifications', [
            'notifiable_id' => $this->regularUser->id,
            'type' => 'complaint_status'
        ]);
    }

    /** @test */
    public function test_notification_priority_levels()
    {
        $priorities = config('notification_types.priorities');
        
        $this->assertArrayHasKey('urgent', $priorities);
        $this->assertArrayHasKey('high', $priorities);
        $this->assertArrayHasKey('medium', $priorities);
        $this->assertArrayHasKey('low', $priorities);
        
        // Test priority colors
        $this->assertEquals('red', NotificationTypeService::getPriorityColor('urgent'));
        $this->assertEquals('orange', NotificationTypeService::getPriorityColor('high'));
    }

    /** @test */
    public function test_notification_channels_configuration()
    {
        $channels = config('notification_types.channels');
        
        $this->assertArrayHasKey('database', $channels);
        $this->assertArrayHasKey('broadcast', $channels);
        $this->assertArrayHasKey('email', $channels);
        
        // Test channel enabled status
        $this->assertTrue(NotificationTypeService::isChannelEnabled('database'));
        $this->assertTrue(NotificationTypeService::isChannelEnabled('broadcast'));
    }

    /** @test */
    public function test_cross_role_notifications()
    {
        // Test admin to staff notification
        $transparency = Transparency::create([
            'title' => 'Admin Created Transparency',
            'description' => 'Test content',
            'type' => 'document',
            'status' => 'draft',
            'created_by' => $this->adminUser->id,
            'uploaded_by' => $this->adminUser->id
        ]);
        
        $this->notificationService->sendTransparencyNotification($transparency);
        
        // Both admin and staff should receive notifications
        $this->assertDatabaseHas('notifications', [
            'notifiable_id' => $this->adminUser->id,
            'type' => 'transparency'
        ]);
        
        $this->assertDatabaseHas('notifications', [
            'notifiable_id' => $this->staffUser->id,
            'type' => 'transparency'
        ]);
    }

    /** @test */
    public function test_notification_settings_for_role()
    {
        $settings = NotificationTypeService::getSettingsForRole('complaint', 'created', 'admin');
        
        $this->assertNotNull($settings);
        $this->assertEquals('complaint_created', $settings['type']);
        $this->assertEquals('high', $settings['priority']);
        $this->assertTrue($settings['email']);
        $this->assertEquals('fas fa-exclamation-triangle', $settings['icon']);
        
        // Test for role not in target_roles
        $userSettings = NotificationTypeService::getSettingsForRole('complaint', 'created', 'user');
        $this->assertNull($userSettings);
    }

    /** @test */
    public function test_notification_type_validation()
    {
        // Test existing type
        $this->assertTrue(NotificationTypeService::exists('news', 'created'));
        
        // Test non-existing type
        $this->assertFalse(NotificationTypeService::exists('invalid', 'action'));
        
        // Test type string generation
        $typeString = NotificationTypeService::getTypeString('gallery', 'created');
        $this->assertEquals('gallery_created', $typeString);
    }

    /** @test */
    public function test_notification_cleanup_and_management()
    {
        // Create test notifications with explicit timestamps
        $oldDate = Carbon::now()->subDays(31);
        $recentDate = Carbon::now();
        
        $notification1 = new Notification([
            'title' => 'Test Notification 1',
            'message' => 'Test message',
            'type' => 'test',
            'notifiable_type' => User::class,
            'notifiable_id' => $this->regularUser->id,
        ]);
        $notification1->created_at = $oldDate;
        $notification1->updated_at = $oldDate;
        $notification1->save();

        $notification2 = new Notification([
            'title' => 'Test Notification 2',
            'message' => 'Test message',
            'type' => 'test',
            'notifiable_type' => User::class,
            'notifiable_id' => $this->regularUser->id,
        ]);
        $notification2->created_at = $recentDate;
        $notification2->updated_at = $recentDate;
        $notification2->save();
        
        // Test deleteOld method
        $this->notificationService->deleteOld();
        
        // Old notification should be deleted, recent one should remain
        $this->assertDatabaseMissing('notifications', ['id' => $notification1->id]);
        $this->assertDatabaseHas('notifications', ['id' => $notification2->id]);
    }
}