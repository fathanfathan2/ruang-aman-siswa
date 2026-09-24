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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            
            // Mencatat siapa yang melapor (Relasi ke tabel users)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Isi form laporan
            $table->string('judul');
            $table->string('kategori');
            $table->date('tanggal_kejadian')->nullable();
            $table->text('deskripsi');
            
            // Fitur rahasia (Anonim)
            $table->boolean('is_anonim')->default(false);
            
            // Status laporan untuk diurus Guru BK
            $table->enum('status', ['menunggu', 'diproses', 'selesai'])->default('menunggu');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
