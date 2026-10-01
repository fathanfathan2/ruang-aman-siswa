<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Tambahkan nilai 'ditolak' ke enum status di tabel sesi_konselings.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE sesi_konselings MODIFY COLUMN status ENUM('menunggu', 'disetujui', 'ditolak', 'selesai') NOT NULL DEFAULT 'menunggu'");
    }

    /**
     * Kembalikan ke enum semula (tanpa ditolak).
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE sesi_konselings MODIFY COLUMN status ENUM('menunggu', 'disetujui', 'selesai') NOT NULL DEFAULT 'menunggu'");
    }
};
