<?php

namespace App\Http\Controllers;

use App\Models\CatatanPoin;
use App\Models\JenisPelanggaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CatatanPoinController extends Controller
{
    public function index()
    {
        $catatanPoins = CatatanPoin::with(['siswa', 'pelanggaran', 'guru'])
            ->orderByDesc('tanggal')
            ->get();

        return view('catatan_poin.index', compact('catatanPoins'));
    }

    public function create()
    {
        $siswas = User::when(
            Schema::hasColumn('users', 'role'),
            fn ($query) => $query->where('role', 'siswa')
        )->orderBy('name')->get();

        $jenisPelanggarans = JenisPelanggaran::orderBy('nama_pelanggaran')->get();

        return view('catatan_poin.create', compact('siswas', 'jenisPelanggarans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:users,id',
            'pelanggaran_id' => 'required|exists:jenis_pelanggarans,id',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $validated['guru_id'] = auth()->id();

        CatatanPoin::create($validated);

        return redirect()
            ->route('catatan-poin.index')
            ->with('success', 'Poin pelanggaran berhasil dicatat.');
    }
}