<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\DocumentRequest;
use App\Models\Complaint;
use App\Models\Transparency;
use App\Models\User;
use Carbon\Carbon;

class DashboardDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get first user (assuming it exists)
        $user = User::first();
        if (!$user) {
            $this->command->error('No users found. Please create a user first.');
            return;
        }

        // Create sample news
        $newsData = [
            [
                'title' => 'Pembukaan Pendaftaran Program Bantuan Sosial 2025',
                'slug' => 'pembukaan-pendaftaran-program-bantuan-sosial-2025-dashboard',
                'content' => 'Pemerintah Kecamatan membuka pendaftaran program bantuan sosial untuk tahun 2025. Program ini ditujukan untuk membantu masyarakat kurang mampu dalam memenuhi kebutuhan dasar.',
                'excerpt' => 'Pendaftaran program bantuan sosial 2025 telah dibuka untuk masyarakat kurang mampu.',
                'category' => 'pengumuman',
                'status' => 'published',
                'is_featured' => true,
                'views' => 150,
                'author_id' => $user->id,
                'published_at' => Carbon::now()->subDays(2),
            ],
            [
                'title' => 'Kegiatan Gotong Royong Pembersihan Lingkungan',
                'slug' => 'kegiatan-gotong-royong-pembersihan-lingkungan-dashboard',
                'content' => 'Masyarakat desa bersama-sama melakukan kegiatan gotong royong pembersihan lingkungan untuk menjaga kebersihan dan kesehatan bersama.',
                'excerpt' => 'Gotong royong pembersihan lingkungan melibatkan seluruh masyarakat desa.',
                'category' => 'kegiatan',
                'status' => 'published',
                'is_featured' => false,
                'views' => 89,
                'author_id' => $user->id,
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Sosialisasi Program Vaksinasi COVID-19 Booster',
                'slug' => 'sosialisasi-program-vaksinasi-covid-19-booster-dashboard',
                'content' => 'Dinas Kesehatan bekerja sama dengan Puskesmas setempat mengadakan sosialisasi program vaksinasi COVID-19 booster untuk meningkatkan imunitas masyarakat.',
                'excerpt' => 'Program vaksinasi booster COVID-19 untuk meningkatkan imunitas masyarakat.',
                'category' => 'kesehatan',
                'status' => 'published',
                'is_featured' => true,
                'views' => 234,
                'author_id' => $user->id,
                'published_at' => Carbon::now()->subWeek(),
            ]
        ];

        foreach ($newsData as $news) {
            News::create($news);
        }

        // Create sample document requests
        $documentData = [
            [
                'user_id' => $user->id,
                'document_type' => 'ktp',
                'purpose' => 'Untuk keperluan melamar pekerjaan',
                'applicant_name' => $user->name,
                'applicant_nik' => '1234567890123456',
                'applicant_phone' => '081234567890',
                'applicant_address' => 'Jl. Contoh No. 123, Desa Contoh',
                'status' => 'pending',
                'created_at' => Carbon::now()->subDays(3),
            ],
            [
                'user_id' => $user->id,
                'document_type' => 'surat_domisili',
                'purpose' => 'Untuk keperluan pendaftaran sekolah',
                'applicant_name' => $user->name,
                'applicant_nik' => '1234567890123456',
                'applicant_phone' => '081234567890',
                'applicant_address' => 'Jl. Contoh No. 123, Desa Contoh',
                'status' => 'completed',
                'completed_at' => Carbon::now()->subDay(),
                'created_at' => Carbon::now()->subDays(7),
            ],
            [
                'user_id' => $user->id,
                'document_type' => 'surat_usaha',
                'purpose' => 'Untuk keperluan pengajuan kredit usaha',
                'applicant_name' => $user->name,
                'applicant_nik' => '1234567890123456',
                'applicant_phone' => '081234567890',
                'applicant_address' => 'Jl. Contoh No. 123, Desa Contoh',
                'status' => 'processing',
                'processed_at' => Carbon::now()->subDays(2),
                'created_at' => Carbon::now()->subDays(5),
            ]
        ];

        foreach ($documentData as $document) {
            DocumentRequest::create($document);
        }

        // Create sample complaints
        $complaintData = [
            [
                'user_id' => $user->id,
                'ticket_number' => 'ADU-' . date('Ymd') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
                'subject' => 'Jalan Rusak di Desa Contoh',
                'description' => 'Jalan di RT 01 RW 02 Desa Contoh mengalami kerusakan parah dan perlu segera diperbaiki.',
                'category' => 'infrastruktur',
                'priority' => 'medium',
                'status' => 'open',
                'complainant_name' => $user->name,
                'complainant_email' => $user->email,
                'complainant_phone' => '081234567890',
                'complainant_address' => 'RT 01 RW 02 Desa Contoh',
                'created_at' => Carbon::now()->subDays(4),
            ],
            [
                'user_id' => $user->id,
                'ticket_number' => 'ADU-' . date('Ymd') . '-' . str_pad(rand(1000, 1999), 3, '0', STR_PAD_LEFT),
                'subject' => 'Lampu Jalan Mati',
                'description' => 'Lampu jalan di sepanjang Jl. Utama sudah mati selama 3 hari, mohon segera diperbaiki.',
                'category' => 'infrastruktur',
                'priority' => 'high',
                'status' => 'in_progress',
                'complainant_name' => $user->name,
                'complainant_email' => $user->email,
                'complainant_phone' => '081234567890',
                'complainant_address' => 'Jl. Utama Desa Contoh',
                'created_at' => Carbon::now()->subDays(6),
            ],
            [
                'user_id' => $user->id,
                'ticket_number' => 'ADU-' . date('Ymd') . '-' . str_pad(rand(2000, 2999), 3, '0', STR_PAD_LEFT),
                'subject' => 'Masalah Pelayanan di Kantor Desa',
                'description' => 'Pelayanan di kantor desa terlalu lambat dan kurang responsif terhadap kebutuhan masyarakat.',
                'category' => 'pelayanan',
                'priority' => 'low',
                'status' => 'resolved',
                'complainant_name' => $user->name,
                'complainant_email' => $user->email,
                'complainant_phone' => '081234567890',
                'complainant_address' => 'Kantor Desa Contoh',
                'created_at' => Carbon::now()->subWeeks(2),
            ]
        ];

        foreach ($complaintData as $complaint) {
            Complaint::create($complaint);
        }

        // Create additional transparency data if needed
        if (Transparency::count() < 3) {
            $transparencyData = [
                [
                    'title' => 'Laporan Keuangan Desa Tahun 2024',
                    'description' => 'Laporan keuangan desa untuk tahun anggaran 2024 yang mencakup pendapatan dan belanja desa.',
                    'category' => 'keuangan',
                    'type' => 'financial_report',
                    'period_start' => Carbon::create(2024, 1, 1),
                    'period_end' => Carbon::create(2024, 12, 31),
                    'amount' => 2500000000,
                    'status' => 'published',
                    'is_featured' => true,
                    'views' => 456,
                    'downloads' => 89,
                    'uploaded_by' => $user->id,
                    'published_at' => Carbon::now()->subDays(10),
                ],
                [
                    'title' => 'Data Anggaran Pembangunan Infrastruktur 2025',
                    'description' => 'Rincian anggaran untuk pembangunan infrastruktur desa tahun 2025.',
                    'category' => 'anggaran',
                    'type' => 'budget',
                    'period_start' => Carbon::create(2025, 1, 1),
                    'period_end' => Carbon::create(2025, 12, 31),
                    'amount' => 1800000000,
                    'status' => 'published',
                    'is_featured' => false,
                    'views' => 234,
                    'downloads' => 45,
                    'uploaded_by' => $user->id,
                    'published_at' => Carbon::now()->subDays(15),
                ]
            ];

            foreach ($transparencyData as $transparency) {
                Transparency::create($transparency);
            }
        }

        $this->command->info('Dashboard data seeded successfully!');
    }
}