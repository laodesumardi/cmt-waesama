<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\LetterRequest;
use App\Models\Notification;
use App\Events\LetterRequestCreated;
use Illuminate\Support\Facades\Event;

class TestLetterNotification extends Command
{
    protected $signature = 'test:letter-notification';
    protected $description = 'Test letter request notification';

    public function handle()
    {
        $this->info('=== Test Letter Request Notification ===');
        
        // Find user with 'user' role
        $user = User::whereHas('roles', function($query) {
            $query->where('name', 'user');
        })->first();
        
        if (!$user) {
            $this->error('User dengan role "user" tidak ditemukan');
            return 1;
        }
        
        $this->info("Testing dengan user: {$user->name} (ID: {$user->id})");
        
        // Count notifications before
        $notificationsBefore = Notification::count();
        $this->info("Notifikasi sebelum: {$notificationsBefore}");
        
        // Create letter request
        $this->info('Membuat letter request...');
        $letterRequest = LetterRequest::create([
            'user_id' => $user->id,
            'letter_type' => 'domisili',
            'purpose' => 'Test purpose',
            'applicant_name' => $user->name,
            'applicant_nik' => '1234567890123456',
            'applicant_address' => 'Test Address',
            'applicant_phone' => '081234567890',
            'status' => 'pending'
        ]);
        
        $this->info("Letter request dibuat dengan ID: {$letterRequest->id}");
        $this->info("Request number: {$letterRequest->request_number}");
        
        // Trigger event manually
        $this->info('Memicu event manual...');
        event(new LetterRequestCreated($letterRequest));
        $this->info('Event dipicu');
        
        // Count notifications after
        $notificationsAfter = Notification::count();
        $this->info("Notifikasi setelah: {$notificationsAfter}");
        
        $newNotifications = $notificationsAfter - $notificationsBefore;
        $this->info("Notifikasi baru yang dibuat: {$newNotifications}");
        
        if ($newNotifications == 5) {
            $this->info('✅ Jumlah notifikasi sesuai ekspektasi (5 notifikasi)');
        } elseif ($newNotifications == 10) {
            $this->error('❌ Masih ada duplikasi! (10 notifikasi)');
        } else {
            $this->warn("⚠️ Jumlah notifikasi tidak sesuai ekspektasi: {$newNotifications}");
        }
        
        // Cleanup
        $this->info('Membersihkan data test...');
        $letterRequest->delete();
        
        $this->info('=== Test Selesai ===');
        return 0;
    }
}