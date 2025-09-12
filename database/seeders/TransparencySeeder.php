<?php

namespace Database\Seeders;

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
        // Check if transparency data already exists
        if (Transparency::count() > 0) {
            $this->command->info('Transparency data already exists. Skipping seeder.');
            return;
        }

        // Get first admin user or create one if doesn't exist
        $adminUser = User::where('email', 'admin@kecamatan.go.id')->first();
        if (!$adminUser) {
            $adminUser = User::create([
                'name' => 'Administrator',
                'email' => 'admin@kecamatan.go.id',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }

        $transparencyData = [
            [
                'title' => 'Laporan Keuangan Desa Tahun 2024',
                'description' => 'Laporan keuangan desa untuk tahun anggaran 2024 yang mencakup pendapatan dan belanja desa.',
                'category' => 'keuangan',
                'type' => 'financial_report',
                'period_start' => '2024-01-01',
                'period_end' => '2024-12-31',
                'fiscal_year' => 2024,
                'amount' => 2500000000.00,
                'status' => 'published',
                'is_featured' => true,
                'views' => 456,
                'downloads' => 89,
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Data Anggaran Pembangunan Infrastruktur 2025',
                'description' => 'Rincian anggaran untuk pembangunan infrastruktur desa tahun 2025.',
                'category' => 'anggaran',
                'type' => 'budget',
                'period_start' => '2025-01-01',
                'period_end' => '2025-12-31',
                'fiscal_year' => 2025,
                'amount' => 1800000000.00,
                'status' => 'published',
                'is_featured' => false,
                'views' => 234,
                'downloads' => 45,
                'published_at' => Carbon::now()->subDays(10),
            ],
            [
                'title' => 'Anggaran Pendapatan dan Belanja Daerah (APBD) 2024',
                'description' => 'Dokumen lengkap APBD tahun 2024 yang mencakup rincian pendapatan dan belanja daerah untuk pembangunan infrastruktur dan pelayanan publik.',
                'category' => 'budget',
                'type' => 'document',
                'period_start' => '2024-01-01',
                'period_end' => '2024-12-31',
                'fiscal_year' => 2024,
                'amount' => 15750000000.00,
                'status' => 'published',
                'is_featured' => true,
                'views' => 892,
                'downloads' => 156,
                'published_at' => Carbon::now()->subDays(15),
            ],
            [
                'title' => 'Tender Pembangunan Jalan Desa Waesama',
                'description' => 'Informasi tender untuk pembangunan jalan desa dengan total anggaran 500 juta rupiah.',
                'category' => 'pengadaan',
                'type' => 'tender',
                'period_start' => '2024-06-01',
                'period_end' => '2024-12-31',
                'fiscal_year' => 2024,
                'amount' => 500000000.00,
                'status' => 'published',
                'is_featured' => false,
                'views' => 123,
                'downloads' => 34,
                'published_at' => Carbon::now()->subDays(20),
            ],
            [
                'title' => 'Struktur Organisasi Kecamatan Waesama 2024',
                'description' => 'Bagan struktur organisasi kecamatan beserta tugas dan fungsi masing-masing jabatan.',
                'category' => 'organisasi',
                'type' => 'organization_structure',
                'period_start' => '2024-01-01',
                'period_end' => '2024-12-31',
                'fiscal_year' => 2024,
                'amount' => null,
                'status' => 'published',
                'is_featured' => false,
                'views' => 345,
                'downloads' => 67,
                'published_at' => Carbon::now()->subDays(25),
            ],
            [
                'title' => 'Peraturan Desa No. 01/2024 tentang APBDes',
                'description' => 'Peraturan desa yang mengatur tentang Anggaran Pendapatan dan Belanja Desa tahun 2024.',
                'category' => 'regulasi',
                'type' => 'regulation',
                'period_start' => '2024-01-01',
                'period_end' => '2024-12-31',
                'fiscal_year' => 2024,
                'amount' => null,
                'status' => 'published',
                'is_featured' => false,
                'views' => 178,
                'downloads' => 23,
                'published_at' => Carbon::now()->subDays(30),
            ],
            [
                'title' => 'Laporan Realisasi Anggaran Semester I 2024',
                'description' => 'Laporan realisasi penggunaan anggaran untuk semester pertama tahun 2024.',
                'category' => 'keuangan',
                'type' => 'financial_report',
                'period_start' => '2024-01-01',
                'period_end' => '2024-06-30',
                'fiscal_year' => 2024,
                'amount' => 7500000000.00,
                'status' => 'published',
                'is_featured' => false,
                'views' => 267,
                'downloads' => 41,
                'published_at' => Carbon::now()->subDays(35),
            ],
            [
                'title' => 'Data Kependudukan Kecamatan Waesama 2024',
                'description' => 'Data statistik kependudukan meliputi jumlah penduduk, komposisi usia, dan sebaran geografis.',
                'category' => 'data',
                'type' => 'data',
                'period_start' => '2024-01-01',
                'period_end' => '2024-12-31',
                'fiscal_year' => 2024,
                'amount' => null,
                'status' => 'published',
                'is_featured' => false,
                'views' => 445,
                'downloads' => 78,
                'published_at' => Carbon::now()->subDays(40),
            ],
            [
                'title' => 'Pengumuman Hasil Tender Pembangunan Balai Desa',
                'description' => 'Pengumuman pemenang tender untuk pembangunan balai desa dengan nilai kontrak 750 juta rupiah.',
                'category' => 'pengumuman',
                'type' => 'announcement',
                'period_start' => '2024-03-01',
                'period_end' => '2024-09-30',
                'fiscal_year' => 2024,
                'amount' => 750000000.00,
                'status' => 'published',
                'is_featured' => false,
                'views' => 189,
                'downloads' => 29,
                'published_at' => Carbon::now()->subDays(45),
            ],
            [
                'title' => 'Dokumen Perencanaan Pembangunan Jangka Menengah Desa',
                'description' => 'RPJMDes (Rencana Pembangunan Jangka Menengah Desa) periode 2024-2030 yang memuat visi, misi, dan program pembangunan.',
                'category' => 'perencanaan',
                'type' => 'document',
                'period_start' => '2024-01-01',
                'period_end' => '2030-12-31',
                'fiscal_year' => 2024,
                'amount' => null,
                'status' => 'published',
                'is_featured' => true,
                'views' => 623,
                'downloads' => 112,
                'published_at' => Carbon::now()->subDays(50),
            ],
        ];

        foreach ($transparencyData as $data) {
            $data['uploaded_by'] = $adminUser->id;
            $data['created_by'] = $adminUser->id;
            $data['updated_by'] = $adminUser->id;
            
            Transparency::create($data);
        }

        $this->command->info('Transparency data seeded successfully! Created ' . count($transparencyData) . ' transparency records.');
    }
}