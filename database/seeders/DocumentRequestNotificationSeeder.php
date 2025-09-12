<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Commands\Seed;
use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;
use App\Models\DocumentRequest;
use Illuminate\Support\Facades\DB;

class DocumentRequestNotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin and staff users
        $adminUsers = User::whereHas('roles', function($q) {
            $q->where('name', 'admin');
        })->get();
        
        $staffUsers = User::whereHas('roles', function($q) {
            $q->where('name', 'staff');
        })->get();
        
        $regularUsers = User::whereHas('roles', function($q) {
            $q->where('name', 'user');
        })->get();

        // Create some document requests first
        $documentRequests = [];
        
        foreach ($regularUsers->take(3) as $index => $user) {
            $documentRequest = DocumentRequest::create([
                'user_id' => $user->id,
                'document_type' => ['ktp', 'kk', 'keterangan_domisili'][$index],
                'purpose' => 'Keperluan administrasi',
                'applicant_name' => $user->name,
                'applicant_nik' => '123456789012345' . $index,
                'applicant_phone' => '08123456789' . $index,
                'applicant_address' => 'Alamat lengkap pemohon ' . ($index + 1),
                'status' => ['pending', 'processing', 'completed'][$index],
                'notes' => 'Catatan untuk pengajuan ' . ($index + 1),
            ]);
            
            $documentRequests[] = $documentRequest;
        }

        // Create notifications for admin users about new document requests
        foreach ($adminUsers as $user) {
            foreach ($documentRequests as $index => $docRequest) {
                Notification::create([
                    'type' => 'document_request',
                    'title' => 'Pengajuan Dokumen Baru',
                    'message' => 'Pengajuan ' . $docRequest->document_type_label . ' dari ' . $docRequest->applicant_name,
                    'notifiable_type' => 'App\\Models\\User',
                    'notifiable_id' => $user->id,
                    'priority' => 'medium',
                    'channel' => 'web',
                    'action_url' => '/admin/document-requests/' . $docRequest->id,
                    'data' => json_encode([
                        'document_request_id' => $docRequest->id,
                        'document_type' => $docRequest->document_type,
                        'applicant_name' => $docRequest->applicant_name
                    ]),
                    'created_at' => now()->subHours($index + 1)
                ]);
            }
        }

        // Create notifications for staff users about document processing
        foreach ($staffUsers as $user) {
            foreach ($documentRequests as $index => $docRequest) {
                Notification::create([
                    'type' => 'document_request',
                    'title' => 'Dokumen Perlu Diproses',
                    'message' => 'Pengajuan ' . $docRequest->document_type_label . ' dari ' . $docRequest->applicant_name . ' perlu diproses',
                    'notifiable_type' => 'App\\Models\\User',
                    'notifiable_id' => $user->id,
                    'priority' => 'medium',
                    'channel' => 'web',
                    'action_url' => '/staff/documents/' . $docRequest->id,
                    'data' => json_encode([
                        'document_request_id' => $docRequest->id,
                        'document_type' => $docRequest->document_type,
                        'applicant_name' => $docRequest->applicant_name
                    ]),
                    'created_at' => now()->subMinutes(30 + ($index * 15))
                ]);
            }
        }

        // Create status update notifications for users
        foreach ($regularUsers->take(3) as $index => $user) {
            $docRequest = $documentRequests[$index];
            
            Notification::create([
                'type' => 'document_request_status',
                'title' => 'Status Pengajuan Diperbarui',
                'message' => 'Status pengajuan ' . $docRequest->document_type_label . ' Anda berubah menjadi ' . $docRequest->status_label,
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => $user->id,
                'priority' => 'medium',
                'channel' => 'web',
                'action_url' => '/documents/' . $docRequest->id,
                'data' => json_encode([
                    'document_request_id' => $docRequest->id,
                    'old_status' => 'pending',
                    'new_status' => $docRequest->status
                ]),
                'created_at' => now()->subMinutes(15 + ($index * 10))
            ]);
        }

        echo "Document request notifications seeded successfully!\n";
    }
}