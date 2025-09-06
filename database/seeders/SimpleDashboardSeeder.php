<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\DocumentRequest;
use App\Models\Complaint;
use App\Models\User;
use Carbon\Carbon;

class SimpleDashboardSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        
        // Create News
        News::create([
            'title' => 'Pengumuman Penting Desa',
            'slug' => 'pengumuman-penting-desa-' . time(),
            'content' => 'Ini adalah pengumuman penting untuk seluruh warga desa.',
            'excerpt' => 'Pengumuman penting untuk warga desa',
            'category' => 'pengumuman',
            'status' => 'published',
            'is_featured' => true,
            'author_id' => $user->id,
            'published_at' => Carbon::now(),
        ]);
        
        News::create([
            'title' => 'Kegiatan Gotong Royong',
            'slug' => 'kegiatan-gotong-royong-' . (time() + 1),
            'content' => 'Kegiatan gotong royong akan dilaksanakan hari Minggu.',
            'excerpt' => 'Gotong royong hari Minggu',
            'category' => 'kegiatan',
            'status' => 'published',
            'is_featured' => false,
            'author_id' => $user->id,
            'published_at' => Carbon::now()->subDays(1),
        ]);
        
        // Create Document Requests
        DocumentRequest::create([
            'user_id' => $user->id,
            'document_type' => 'ktp',
            'purpose' => 'Keperluan administrasi',
            'applicant_name' => $user->name,
            'applicant_nik' => '1234567890123456',
            'applicant_phone' => '081234567890',
            'applicant_address' => 'Alamat lengkap pemohon',
            'status' => 'pending',
            'notes' => 'Mohon diproses segera',
        ]);
        
        DocumentRequest::create([
            'user_id' => $user->id,
            'document_type' => 'kk',
            'purpose' => 'Keperluan sekolah',
            'applicant_name' => $user->name,
            'applicant_nik' => '1234567890123457',
            'applicant_phone' => '081234567891',
            'applicant_address' => 'Alamat lengkap pemohon 2',
            'status' => 'processing',
            'notes' => 'Sedang diproses',
        ]);
        
        // Create Complaints
        Complaint::create([
            'user_id' => $user->id,
            'ticket_number' => 'ADU-' . date('Ymd') . '-' . rand(100, 999),
            'subject' => 'Jalan Rusak',
            'description' => 'Jalan di depan rumah rusak parah',
            'category' => 'infrastruktur',
            'priority' => 'high',
            'status' => 'open',
            'complainant_name' => $user->name,
            'complainant_email' => $user->email,
            'complainant_phone' => '081234567890',
            'complainant_address' => 'Alamat contoh',
        ]);
        
        Complaint::create([
            'user_id' => $user->id,
            'ticket_number' => 'ADU-' . date('Ymd') . '-' . rand(1000, 1999),
            'subject' => 'Pelayanan Lambat',
            'description' => 'Pelayanan di kantor desa terlalu lambat',
            'category' => 'pelayanan',
            'priority' => 'medium',
            'status' => 'in_progress',
            'complainant_name' => $user->name,
            'complainant_email' => $user->email,
            'complainant_phone' => '081234567890',
            'complainant_address' => 'Alamat contoh 2',
        ]);
    }
}