<?php

namespace Database\Seeders;

use App\Models\VillageInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VillageInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VillageInfo::create([
            'name' => 'Kecamatan Contoh',
            'description' => 'Kecamatan Contoh adalah salah satu kecamatan yang terletak di wilayah strategis dengan berbagai potensi unggulan. Wilayah ini memiliki karakteristik geografis yang beragam, mulai dari area perkotaan hingga pedesaan yang asri. Masyarakat di kecamatan ini dikenal ramah dan gotong royong dalam membangun daerahnya.',
            'vision' => 'Menjadi kecamatan yang maju, sejahtera, dan berkelanjutan dengan pelayanan publik yang prima dan masyarakat yang berdaya.',
            'mission' => "1. Meningkatkan kualitas pelayanan publik yang transparan dan akuntabel\n2. Mengembangkan potensi ekonomi lokal dan pemberdayaan masyarakat\n3. Mewujudkan tata kelola pemerintahan yang bersih dan profesional\n4. Membangun infrastruktur yang mendukung kemajuan daerah\n5. Melestarikan budaya dan lingkungan hidup",
            'address' => 'Jl. Raya Kecamatan No. 123, Kelurahan Pusat, Kecamatan Contoh, Kabupaten Contoh, Provinsi Contoh 12345',
            'phone' => '(021) 1234-5678',
            'email' => 'info@kecamatancontoh.go.id',
            'area' => '45.5',
            'population' => 85000
        ]);

        $this->command->info('VillageInfo seeder completed successfully!');
    }
}
