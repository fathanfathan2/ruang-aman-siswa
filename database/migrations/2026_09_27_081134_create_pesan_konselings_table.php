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
        Schema::create('pesan_konselings', function (Blueprint $table) {
            $table->id();

            // Relasi ke sesi konseling yang sedang berlangsung
            $table->foreignId('sesi_konseling_id')
                  ->constrained('sesi_konselings')
                  ->onDelete('cascade');

            // Siapa yang mengirim pesan (bisa siswa atau guru BK)
            $table->foreignId('pengirim_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Isi pesan
            $table->text('isi');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesan_konselings');
    }
};
