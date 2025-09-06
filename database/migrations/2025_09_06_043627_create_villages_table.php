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
        Schema::create('villages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->enum('type', ['desa', 'kelurahan']);
            $table->text('address');
            $table->string('postal_code');
            $table->string('head_name');
            $table->string('head_phone')->nullable();
            $table->string('head_email')->nullable();
            $table->text('profile')->nullable();
            $table->json('demographics')->nullable(); // data kependudukan
            $table->json('programs')->nullable(); // program pembangunan
            $table->decimal('budget', 15, 2)->nullable(); // APBD
            $table->string('map_coordinates')->nullable();
            $table->decimal('area_size', 10, 2)->nullable(); // luas wilayah
            $table->integer('population')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villages');
    }
};
