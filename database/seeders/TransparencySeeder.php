<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transparency;
use App\Models\User;
use Carbon\Carbon;

class TransparencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        
        if (!$user) {
            $this->command->error('No user found. Please run UserSeeder first.');
            return;
        }

        $transparencyData = [
            // Budget Data
            [
                'title' => 'Anggaran Pendapatan dan Belanja Daerah (APBD) 2024',
                'description' => 'Dokumen lengkap APBD tahun 2024 yang mencakup rincian pendapatan dan belanja daerah untuk pembangunan infrastruktur dan pelayanan publik.',
                'category' => 'budget',
                'type' => 'document',
                'period_start' => Carbon::create(2024, 1, 1),
                'period_end' => Carbon::create(2024, 12, 31),
                'amount' => 15750000000,
                'status' => 'published',
                'is_featured' => true,
                'views' => 1245,
                'downloads' => 234,
                'created_by' => $user->id,
                'updated_by' => $user->id,
                'uploaded_by' => $user->id,
                'published_at' => Carbon::now()->subDays(5),
                'data' => [
                    'budget_type' => 'annual',
                    'fiscal_year' => 2024,
                    'total_revenue' => 15750000000,
                    'total_expenditure' => 15200000000,
                    'surplus' => 550000000
                ]
            ],
            [
                'title' => 'Realisasi Anggaran Triwulan I 2024',
                'description' => 'Laporan realisasi anggaran untuk triwulan pertama tahun 2024 dengan tingkat penyerapan 23.5%.',
                'category' => 'budget',
                'type' => 'data',
                'period_start' => Carbon::create(2024, 1, 1),
                'period_end' => Carbon::create(2024, 3, 31),
                'amount' => 3701250000,
                'status' => 'published',
                'is_featured' => false,
                'views' => 567,
                'downloads' => 89,
                'created_by' => $user->id,
                'updated_by' => $user->id,
                'uploaded_by' => $user->id,
                'published_at' => Carbon::now()->subDays(15),
                'data' => [
                    'quarter' => 1,
                    'realization_percentage' => 23.5,
                    'target_percentage' => 25.0
                ]
            ],
            
            // Procurement Data
            [
                'title' => 'Pengadaan Pembangunan Jalan Desa Tahap II',
                'description' => 'Proses pengadaan untuk pembangunan jalan desa sepanjang 2.5 km dengan anggaran Rp 2.8 miliar.',
                'category' => 'procurement',
                'type' => 'announcement',
                'period_start' => Carbon::create(2024, 3, 1),
                'period_end' => Carbon::create(2024, 8, 31),
                'amount' => 2800000000,
                'status' => 'published',
                'is_featured' => true,
                'views' => 892,
                'downloads' => 156,
                'created_by' => $user->id,
                'updated_by' => $user->id,
                'uploaded_by' => $user->id,
                'published_at' => Carbon::now()->subDays(8),
                'data' => [
                    'procurement_method' => 'tender_terbuka',
                    'status' => 'ongoing',
                    'contractor' => 'PT Pembangunan Infrastruktur Nusantara',
                    'progress_percentage' => 65
                ]
            ],
            [
                'title' => 'Pengadaan Alat Kesehatan Puskesmas',
                'description' => 'Pengadaan peralatan medis untuk meningkatkan kualitas pelayanan kesehatan di puskesmas.',
                'category' => 'procurement',
                'type' => 'document',
                'period_start' => Carbon::create(2024, 2, 15),
                'period_end' => Carbon::create(2024, 5, 15),
                'amount' => 450000000,
                'status' => 'published',
                'is_featured' => false,
                'views' => 334,
                'downloads' => 67,
                'created_by' => $user->id,
                'updated_by' => $user->id,
                'uploaded_by' => $user->id,
                'published_at' => Carbon::now()->subDays(20),
                'data' => [
                    'procurement_method' => 'penunjukan_langsung',
                    'status' => 'completed',
                    'vendor' => 'CV Medika Sejahtera'
                ]
            ],
            
            // Project Data
            [
                'title' => 'Pembangunan Gedung Sekolah Dasar Baru',
                'description' => 'Proyek pembangunan gedung sekolah dasar dengan 12 ruang kelas untuk menampung 360 siswa.',
                'category' => 'project',
                'type' => 'document',
                'period_start' => Carbon::create(2024, 1, 15),
                'period_end' => Carbon::create(2024, 12, 15),
                'amount' => 4200000000,
                'status' => 'published',
                'is_featured' => true,
                'views' => 1567,
                'downloads' => 298,
                'created_by' => $user->id,
                'updated_by' => $user->id,
                'uploaded_by' => $user->id,
                'published_at' => Carbon::now()->subDays(3),
                'data' => [
                    'project_type' => 'infrastructure',
                    'status' => 'ongoing',
                    'progress_percentage' => 45,
                    'contractor' => 'PT Karya Pembangunan Indonesia',
                    'expected_completion' => '2024-12-15'
                ]
            ],
            [
                'title' => 'Renovasi Pasar Tradisional',
                'description' => 'Proyek renovasi pasar tradisional untuk meningkatkan kenyamanan pedagang dan pembeli.',
                'category' => 'project',
                'type' => 'data',
                'period_start' => Carbon::create(2024, 4, 1),
                'period_end' => Carbon::create(2024, 9, 30),
                'amount' => 1850000000,
                'status' => 'published',
                'is_featured' => false,
                'views' => 723,
                'downloads' => 134,
                'created_by' => $user->id,
                'updated_by' => $user->id,
                'uploaded_by' => $user->id,
                'published_at' => Carbon::now()->subDays(12),
                'data' => [
                    'project_type' => 'renovation',
                    'status' => 'planning',
                    'affected_vendors' => 85,
                    'new_facilities' => ['toilet_modern', 'sistem_drainase', 'area_parkir']
                ]
            ],
            
            // Regulation Data
            [
                'title' => 'Peraturan Daerah No. 5 Tahun 2024 tentang Retribusi Pasar',
                'description' => 'Peraturan daerah yang mengatur tarif retribusi pasar dan tata cara pembayarannya.',
                'category' => 'regulation',
                'type' => 'document',
                'period_start' => Carbon::create(2024, 6, 1),
                'period_end' => null,
                'amount' => null,
                'status' => 'published',
                'is_featured' => false,
                'views' => 445,
                'downloads' => 78,
                'created_by' => $user->id,
                'updated_by' => $user->id,
                'uploaded_by' => $user->id,
                'published_at' => Carbon::now()->subDays(18),
                'data' => [
                    'regulation_type' => 'perda',
                    'regulation_number' => '5/2024',
                    'status' => 'active',
                    'effective_date' => '2024-06-01'
                ]
            ],
            [
                'title' => 'Keputusan Kepala Daerah tentang Tim Pengawas Pembangunan',
                'description' => 'Keputusan pembentukan tim pengawas untuk mengawasi jalannya proyek pembangunan infrastruktur.',
                'category' => 'regulation',
                'type' => 'announcement',
                'period_start' => Carbon::create(2024, 3, 15),
                'period_end' => Carbon::create(2024, 12, 31),
                'amount' => null,
                'status' => 'published',
                'is_featured' => false,
                'views' => 267,
                'downloads' => 45,
                'created_by' => $user->id,
                'updated_by' => $user->id,
                'uploaded_by' => $user->id,
                'published_at' => Carbon::now()->subDays(25),
                'data' => [
                    'regulation_type' => 'keputusan',
                    'status' => 'active',
                    'team_members' => 7
                ]
            ],
            
            // Report Data
            [
                'title' => 'Laporan Kinerja Instansi Pemerintah (LAKIP) 2023',
                'description' => 'Laporan komprehensif kinerja instansi pemerintah daerah untuk tahun 2023.',
                'category' => 'report',
                'type' => 'document',
                'period_start' => Carbon::create(2023, 1, 1),
                'period_end' => Carbon::create(2023, 12, 31),
                'amount' => null,
                'status' => 'published',
                'is_featured' => true,
                'views' => 1834,
                'downloads' => 367,
                'created_by' => $user->id,
                'updated_by' => $user->id,
                'uploaded_by' => $user->id,
                'published_at' => Carbon::now()->subDays(7),
                'data' => [
                    'report_type' => 'lakip',
                    'period' => 'annual',
                    'performance_score' => 85.6,
                    'achievements' => [
                        'infrastruktur' => 'Pembangunan 15 km jalan baru',
                        'pendidikan' => 'Renovasi 8 sekolah',
                        'kesehatan' => 'Penambahan 3 puskesmas pembantu'
                    ]
                ]
            ],
            [
                'title' => 'Laporan Realisasi APBD Semester I 2024',
                'description' => 'Laporan realisasi anggaran pendapatan dan belanja daerah untuk semester pertama tahun 2024.',
                'category' => 'report',
                'type' => 'data',
                'period_start' => Carbon::create(2024, 1, 1),
                'period_end' => Carbon::create(2024, 6, 30),
                'amount' => 7875000000,
                'status' => 'published',
                'is_featured' => false,
                'views' => 678,
                'downloads' => 123,
                'created_by' => $user->id,
                'updated_by' => $user->id,
                'uploaded_by' => $user->id,
                'published_at' => Carbon::now()->subDays(10),
                'data' => [
                    'report_type' => 'financial',
                    'period' => 'semester',
                    'realization_percentage' => 50.0,
                    'revenue_realization' => 8100000000,
                    'expenditure_realization' => 7875000000
                ]
            ]
        ];

        foreach ($transparencyData as $data) {
            Transparency::create($data);
        }

        $this->command->info('Transparency data seeded successfully!');
        $this->command->info('Created ' . count($transparencyData) . ' transparency records.');
    }
}