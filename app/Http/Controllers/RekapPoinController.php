<?php

namespace App\Http\Controllers;

use App\Models\CatatanPoin;
use App\Models\CatatanPrestasi;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class RekapPoinController extends Controller
{
    public function index()
    {
        $siswas = User::when(
            Schema::hasColumn('users', 'role'),
            fn ($query) => $query->where('role', 'siswa')
        )->orderBy('name')->get();

        $rekap = $siswas->map(function ($siswa) {
            $totalPelanggaran = CatatanPoin::where('siswa_id', $siswa->id)
                ->with('pelanggaran')
                ->get()
                ->sum(fn ($catatan) => $catatan->pelanggaran->poin ?? 0);

            $totalPrestasi = CatatanPrestasi::where('siswa_id', $siswa->id)
                ->with('prestasi')
                ->get()
                ->sum(fn ($catatan) => $catatan->prestasi->poin ?? 0);

            $totalBersih = max(0, $totalPelanggaran - $totalPrestasi);

            return (object) [
                'siswa' => $siswa,
                'total_pelanggaran' => $totalPelanggaran,
                'total_prestasi' => $totalPrestasi,
                'total_bersih' => $totalBersih,
            ];
        })->sortByDesc('total_bersih')->values();

        return view('rekap_poin.index', compact('rekap'));
    }
}   