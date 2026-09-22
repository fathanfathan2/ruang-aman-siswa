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
        Schema::create('sesi_konselings', function (Blueprint $table) {
            $table->id();
            
            // Menyimpan ID siswa dan menyambungkannya ke tabel users
            $table->foreignId('siswa_id')->constrained('users')->onDelete('cascade');
            
            // Kolom-kolom untuk data konseling
            $table->string('topik');
            $table->dateTime('jadwal');
            $table->enum('status', ['menunggu', 'disetujui', 'selesai'])->default('menunggu');
            $table->enum('tipe', ['terbuka', 'anonim'])->default('terbuka');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesi_konselings');
    }
};