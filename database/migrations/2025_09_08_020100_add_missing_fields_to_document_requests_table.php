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
        Schema::table('document_requests', function (Blueprint $table) {
            // Check if columns don't exist before adding them
            if (!Schema::hasColumn('document_requests', 'applicant_email')) {
                $table->string('applicant_email')->nullable()->after('applicant_phone');
            }
            if (!Schema::hasColumn('document_requests', 'applicant_marital_status')) {
                $table->string('applicant_marital_status')->nullable()->after('applicant_religion');
            }
            if (!Schema::hasColumn('document_requests', 'applicant_nationality')) {
                $table->string('applicant_nationality')->default('WNI')->after('applicant_occupation');
            }
            if (!Schema::hasColumn('document_requests', 'request_number')) {
                $table->string('request_number')->nullable()->after('user_id');
            }
        });
        
        // Fix empty request_numbers before adding unique constraint
        $emptyRecords = DB::table('document_requests')
            ->where('request_number', '')
            ->orWhereNull('request_number')
            ->get();
            
        foreach ($emptyRecords as $record) {
            $requestNumber = 'DOC-' . date('Ymd') . '-' . str_pad($record->id, 4, '0', STR_PAD_LEFT);
            DB::table('document_requests')
                ->where('id', $record->id)
                ->update(['request_number' => $requestNumber]);
        }
        
        // Now add unique constraint
        Schema::table('document_requests', function (Blueprint $table) {
            if (Schema::hasColumn('document_requests', 'request_number')) {
                $table->unique('request_number', 'document_requests_request_number_unique');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('document_requests', function (Blueprint $table) {
            // Check if unique constraint exists before dropping
            $indexes = DB::select("SHOW INDEX FROM document_requests WHERE Key_name = 'document_requests_request_number_unique'");
            if (!empty($indexes)) {
                $table->dropUnique('document_requests_request_number_unique');
            }
            
            $columns = ['applicant_email', 'applicant_marital_status', 'applicant_nationality', 'request_number'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('document_requests', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};