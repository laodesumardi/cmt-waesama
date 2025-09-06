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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // jenis notifikasi
            $table->string('title');
            $table->text('message');
            $table->json('data')->nullable(); // data tambahan
            $table->string('notifiable_type'); // model yang dinotifikasi
            $table->unsignedBigInteger('notifiable_id'); // id model
            $table->timestamp('read_at')->nullable();
            $table->string('action_url')->nullable(); // link untuk action
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->timestamps();
            
            $table->index(['notifiable_type', 'notifiable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
