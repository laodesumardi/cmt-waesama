<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // SQLite compatible approach
        if (Schema::hasColumn('document_requests', 'applicant_gender')) {
            // Update existing data
            \DB::statement("UPDATE document_requests SET applicant_gender = 'Laki-laki' WHERE applicant_gender = 'male'");
            \DB::statement("UPDATE document_requests SET applicant_gender = 'Perempuan' WHERE applicant_gender = 'female'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // SQLite compatible approach
        if (Schema::hasColumn('document_requests', 'applicant_gender')) {
            // Update existing data back
            \DB::statement("UPDATE document_requests SET applicant_gender = 'male' WHERE applicant_gender = 'Laki-laki'");
            \DB::statement("UPDATE document_requests SET applicant_gender = 'female' WHERE applicant_gender = 'Perempuan'");
        }
    }
};
