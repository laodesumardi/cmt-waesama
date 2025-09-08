<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // For MySQL, we need to alter the enum column
        if (Schema::hasColumn('document_requests', 'applicant_gender')) {
            // First update any existing data to new format
            DB::statement("UPDATE document_requests SET applicant_gender = 'Laki-laki' WHERE applicant_gender = 'male'");
            DB::statement("UPDATE document_requests SET applicant_gender = 'Perempuan' WHERE applicant_gender = 'female'");
            
            // Now alter the column to use the new enum values
            DB::statement("ALTER TABLE document_requests MODIFY COLUMN applicant_gender ENUM('Laki-laki', 'Perempuan') NULL");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('document_requests', 'applicant_gender')) {
            // First update data back to old format
            DB::statement("UPDATE document_requests SET applicant_gender = 'male' WHERE applicant_gender = 'Laki-laki'");
            DB::statement("UPDATE document_requests SET applicant_gender = 'female' WHERE applicant_gender = 'Perempuan'");
            
            // Alter column back to old enum values
            DB::statement("ALTER TABLE document_requests MODIFY COLUMN applicant_gender ENUM('male', 'female') NULL");
        }
    }
};