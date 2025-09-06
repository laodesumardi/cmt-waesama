<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin and staff users
        $adminUsers = User::role(['admin', 'super-admin'])->get();
        $staffUsers = User::role('staff')->get();
        $regularUsers = User::role('user')->get();

        // Create notifications for admin users
        foreach ($adminUsers as $user) {
            // System notifications
            Notification::create([
                'type' => 'system',
                'title' => 'Sistem Notifikasi Aktif',
                'message' => 'Sistem notifikasi real-time telah berhasil diaktifkan.',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => $user->id,
                'priority' => 'high',
                'channel' => 'web',
                'data' => json_encode([
                    'action' => 'system_activated',
                    'timestamp' => now()->toISOString()
                ]),
                'created_at' => now()->subMinutes(5)
            ]);

            // News notification
            Notification::create([
                'type' => 'news',
                'title' => 'Berita Baru Dipublikasi',
                'message' => 'Berita "Pembangunan Jalan Desa" telah berhasil dipublikasi.',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => $user->id,
                'priority' => 'medium',
                'channel' => 'web',
                'action_url' => '/admin/news',
                'data' => json_encode([
                    'news_id' => 1,
                    'action' => 'published'
                ]),
                'created_at' => now()->subHours(2)
            ]);

            // Complaint notification
            Notification::create([
                'type' => 'complaint',
                'title' => 'Pengaduan Baru',
                'message' => 'Ada pengaduan baru dari masyarakat yang perlu ditindaklanjuti.',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => $user->id,
                'priority' => 'high',
                'channel' => 'web',
                'action_url' => '/admin/complaints',
                'data' => json_encode([
                    'complaint_id' => 1,
                    'category' => 'infrastruktur'
                ]),
                'created_at' => now()->subHours(1)
            ]);
        }

        // Create notifications for staff users
        foreach ($staffUsers as $user) {
            // Document notification
            Notification::create([
                'type' => 'document',
                'title' => 'Pengajuan Surat Baru',
                'message' => 'Ada pengajuan surat keterangan domisili yang perlu diproses.',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => $user->id,
                'priority' => 'medium',
                'channel' => 'web',
                'action_url' => '/staff/documents',
                'data' => json_encode([
                    'document_type' => 'keterangan_domisili',
                    'applicant' => 'John Doe'
                ]),
                'created_at' => now()->subMinutes(30)
            ]);

            // System notification
            Notification::create([
                'type' => 'system',
                'title' => 'Tugas Baru Ditugaskan',
                'message' => 'Anda mendapat tugas baru untuk memproses dokumen administrasi.',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => $user->id,
                'priority' => 'medium',
                'channel' => 'web',
                'data' => json_encode([
                    'task_type' => 'document_processing',
                    'assigned_by' => 'Admin'
                ]),
                'created_at' => now()->subHours(3)
            ]);
        }

        // Create notifications for regular users
        foreach ($regularUsers->take(3) as $user) {
            // Document status notification
            Notification::create([
                'type' => 'document',
                'title' => 'Status Pengajuan Diperbarui',
                'message' => 'Pengajuan surat keterangan usaha Anda sedang diproses.',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => $user->id,
                'priority' => 'medium',
                'channel' => 'web',
                'action_url' => '/dashboard',
                'data' => json_encode([
                    'document_id' => 1,
                    'status' => 'processing'
                ]),
                'created_at' => now()->subMinutes(45)
            ]);

            // News notification
            Notification::create([
                'type' => 'news',
                'title' => 'Informasi Penting',
                'message' => 'Jadwal pelayanan administrasi akan berubah mulai minggu depan.',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => $user->id,
                'priority' => 'low',
                'channel' => 'web',
                'action_url' => '/news',
                'data' => json_encode([
                    'announcement_type' => 'schedule_change'
                ]),
                'created_at' => now()->subDays(1)
            ]);
        }

        $this->command->info('Notification seeder completed successfully!');
    }
}
