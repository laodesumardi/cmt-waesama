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
        Schema::table('document_requests', function (Blueprint $table) {
            $table->string('applicant_birth_place')->nullable()->after('applicant_address');
            $table->date('applicant_birth_date')->nullable()->after('applicant_birth_place');
            $table->enum('applicant_gender', ['male', 'female'])->nullable()->after('applicant_birth_date');
            $table->string('applicant_religion')->nullable()->after('applicant_gender');
            $table->string('applicant_occupation')->nullable()->after('applicant_religion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('document_requests', function (Blueprint $table) {
            $table->dropColumn([
                'applicant_birth_place',
                'applicant_birth_date',
                'applicant_gender',
                'applicant_religion',
                'applicant_occupation'
            ]);
        });
    }
};
