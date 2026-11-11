<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan nilai 'ditolak' ke enum status di tabel sesi_konselings.
     */
    public function up(): void
    {
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE sesi_konselings DROP CONSTRAINT IF EXISTS sesi_konselings_status_check');
            DB::statement("ALTER TABLE sesi_konselings ADD CONSTRAINT sesi_konselings_status_check CHECK (status IN ('menunggu', 'disetujui', 'ditolak', 'selesai'))");

            return;
        }

        if (DB::getDriverName() === 'sqlite') {
            Schema::table('sesi_konselings', function (Blueprint $table) {
                $table->enum('status', ['menunggu', 'disetujui', 'ditolak', 'selesai'])->default('menunggu')->change();
            });

            return;
        }

        DB::statement("ALTER TABLE sesi_konselings MODIFY COLUMN status ENUM('menunggu', 'disetujui', 'ditolak', 'selesai') NOT NULL DEFAULT 'menunggu'");
    }

    /**
     * Kembalikan ke enum semula (tanpa ditolak).
     */
    public function down(): void
    {
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE sesi_konselings DROP CONSTRAINT IF EXISTS sesi_konselings_status_check');
            DB::statement("ALTER TABLE sesi_konselings ADD CONSTRAINT sesi_konselings_status_check CHECK (status IN ('menunggu', 'disetujui', 'selesai'))");

            return;
        }

        if (DB::getDriverName() === 'sqlite') {
            Schema::table('sesi_konselings', function (Blueprint $table) {
                $table->enum('status', ['menunggu', 'disetujui', 'selesai'])->default('menunggu')->change();
            });

            return;
        }

        DB::statement("ALTER TABLE sesi_konselings MODIFY COLUMN status ENUM('menunggu', 'disetujui', 'selesai') NOT NULL DEFAULT 'menunggu'");
    }
};
