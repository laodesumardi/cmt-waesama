<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DocumentRequest;
use Illuminate\Support\Facades\DB;

class PopulateMissingDocumentRequestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Populating missing document request data...');
        
        // Get document requests with missing data
        $documentRequests = DocumentRequest::where(function($query) {
            $query->whereNull('applicant_birth_place')
                  ->orWhereNull('applicant_birth_date')
                  ->orWhereNull('applicant_gender')
                  ->orWhereNull('applicant_religion')
                  ->orWhereNull('applicant_occupation');
        })->get();
        
        $this->command->info("Found {$documentRequests->count()} document requests with missing data.");
        
        $sampleData = [
            'birth_places' => ['Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Semarang', 'Makassar', 'Palembang', 'Tangerang', 'Depok', 'Bekasi'],
            'genders' => ['Laki-laki', 'Perempuan'],
            'religions' => ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'],
            'occupations' => ['Pegawai Swasta', 'PNS', 'TNI/Polri', 'Wiraswasta', 'Petani', 'Buruh', 'Guru', 'Dokter', 'Pengacara', 'Mahasiswa', 'Ibu Rumah Tangga']
        ];
        
        foreach ($documentRequests as $index => $documentRequest) {
            $updates = [];
            
            // Generate birth date if missing
            if (!$documentRequest->applicant_birth_date) {
                $year = rand(1970, 2000);
                $month = rand(1, 12);
                $day = rand(1, 28);
                $updates['applicant_birth_date'] = sprintf('%04d-%02d-%02d', $year, $month, $day);
            }
            
            // Generate birth place if missing
            if (!$documentRequest->applicant_birth_place) {
                $updates['applicant_birth_place'] = $sampleData['birth_places'][array_rand($sampleData['birth_places'])];
            }
            
            // Generate gender if missing
            if (!$documentRequest->applicant_gender) {
                $updates['applicant_gender'] = $sampleData['genders'][array_rand($sampleData['genders'])];
            }
            
            // Generate religion if missing
            if (!$documentRequest->applicant_religion) {
                $updates['applicant_religion'] = $sampleData['religions'][array_rand($sampleData['religions'])];
            }
            
            // Generate occupation if missing
            if (!$documentRequest->applicant_occupation) {
                $updates['applicant_occupation'] = $sampleData['occupations'][array_rand($sampleData['occupations'])];
            }
            
            if (!empty($updates)) {
                $documentRequest->update($updates);
                $this->command->info("Updated document request ID {$documentRequest->id} with missing data.");
            }
        }
        
        $this->command->info('Finished populating missing document request data.');
    }
}
