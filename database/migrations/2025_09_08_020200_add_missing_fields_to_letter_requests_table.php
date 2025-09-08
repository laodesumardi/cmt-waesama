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
        Schema::table('letter_requests', function (Blueprint $table) {
            // Check if columns don't exist before adding them
            if (!Schema::hasColumn('letter_requests', 'applicant_email')) {
                $table->string('applicant_email')->nullable()->after('applicant_phone');
            }
            if (!Schema::hasColumn('letter_requests', 'applicant_birth_place')) {
                $table->string('applicant_birth_place')->nullable()->after('applicant_email');
            }
            if (!Schema::hasColumn('letter_requests', 'applicant_birth_date')) {
                $table->date('applicant_birth_date')->nullable()->after('applicant_birth_place');
            }
            if (!Schema::hasColumn('letter_requests', 'applicant_gender')) {
                $table->enum('applicant_gender', ['Laki-laki', 'Perempuan'])->nullable()->after('applicant_birth_date');
            }
            if (!Schema::hasColumn('letter_requests', 'applicant_religion')) {
                $table->enum('applicant_religion', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'])->nullable()->after('applicant_gender');
            }
            if (!Schema::hasColumn('letter_requests', 'applicant_marital_status')) {
                $table->enum('applicant_marital_status', ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'])->nullable()->after('applicant_religion');
            }
            if (!Schema::hasColumn('letter_requests', 'applicant_occupation')) {
                $table->string('applicant_occupation')->nullable()->after('applicant_marital_status');
            }
            if (!Schema::hasColumn('letter_requests', 'applicant_nationality')) {
                $table->enum('applicant_nationality', ['WNI', 'WNA'])->nullable()->after('applicant_occupation');
            }
            if (!Schema::hasColumn('letter_requests', 'completed_at')) {
                $table->timestamp('completed_at')->nullable()->after('processed_at');
            }
            if (!Schema::hasColumn('letter_requests', 'rejection_reason')) {
                $table->text('rejection_reason')->nullable()->after('completed_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('letter_requests', function (Blueprint $table) {
            $table->dropColumn([
                'applicant_email',
                'applicant_birth_place', 
                'applicant_birth_date',
                'applicant_gender',
                'applicant_religion',
                'applicant_marital_status',
                'applicant_occupation',
                'applicant_nationality',
                'completed_at',
                'rejection_reason'
            ]);
        });
    }
};