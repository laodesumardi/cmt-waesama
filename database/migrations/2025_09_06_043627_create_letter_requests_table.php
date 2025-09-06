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
        Schema::create('letter_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_number')->unique();
            $table->enum('letter_type', ['domisili', 'usaha', 'tidak_mampu', 'pengantar_ktp', 'pengantar_kk', 'izin_keramaian']);
            $table->string('applicant_name');
            $table->string('applicant_nik', 16);
            $table->text('applicant_address');
            $table->string('applicant_phone');
            $table->text('purpose');
            $table->json('additional_data')->nullable(); // untuk data tambahan sesuai jenis surat
            $table->json('attachments')->nullable(); // file pendukung
            $table->enum('status', ['pending', 'in_review', 'approved', 'rejected', 'completed'])->default('pending');
            $table->text('notes')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('processed_at')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_requests');
    }
};
