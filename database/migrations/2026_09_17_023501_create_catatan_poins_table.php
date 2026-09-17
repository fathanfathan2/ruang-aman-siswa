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
        Schema::create('catatan_poins', function (Blueprint $table) {
    $table->id();
    // Relasi ke tabel users dan jenis_pelanggaran
    $table->foreignId('siswa_id')->constrained('users')->onDelete('cascade');
    $table->foreignId('pelanggaran_id')->constrained('jenis_pelanggarans')->onDelete('cascade');
    $table->foreignId('guru_id')->constrained('users')->onDelete('cascade');
    
    $table->date('tanggal');
    $table->text('keterangan')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_poins');
    }
};
