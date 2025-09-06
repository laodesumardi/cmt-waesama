<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Complaint;
use App\Models\User;
use App\Events\ComplaintCreated;

class TestNotificationSeeder extends Seeder
{
    public function run()
    {
        // Create a test complaint to trigger notification
        $complaint = Complaint::create([
            'ticket_number' => 'TEST-' . now()->format('YmdHis'),
            'complainant_name' => 'Test User',
            'complainant_email' => 'test@example.com',
            'complainant_phone' => '081234567890',
            'complainant_address' => 'Test Address',
            'subject' => 'Test Complaint for Notification',
            'description' => 'This is a test complaint to verify notification system.',
            'status' => 'open',
            'priority' => 'medium',
            'category' => 'lainnya'
        ]);

        // Fire the event to create notification
        event(new ComplaintCreated($complaint));

        $this->command->info('Test complaint created with ID: ' . $complaint->id);
        $this->command->info('Notification should be visible in admin dashboard.');
    }
}