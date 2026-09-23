<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_prestasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_prestasi');
            $table->integer('poin');
            $table->enum('kategori', ['akademik', 'non_akademik', 'sikap']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_prestasis');
    }
};