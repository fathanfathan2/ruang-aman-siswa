<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah kolom catatan_bk ke tabel laporans
     * agar BK bisa menulis balasan/catatan yang terlihat oleh siswa.
     */
    public function up(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->text('catatan_bk')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn('catatan_bk');
        });
    }
};
