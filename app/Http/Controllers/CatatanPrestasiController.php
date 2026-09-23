<?php

namespace App\Http\Controllers;

use App\Models\CatatanPrestasi;
use App\Models\JenisPrestasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CatatanPrestasiController extends Controller
{
    public function index()
    {
        $catatanPrestasis = CatatanPrestasi::with(['siswa', 'prestasi', 'guru'])
            ->orderByDesc('tanggal')
            ->get();

        return view('catatan_prestasi.index', compact('catatanPrestasis'));
    }

    public function create()
    {
        $siswas = User::when(
            Schema::hasColumn('users', 'role'),
            fn ($query) => $query->where('role', 'siswa')
        )->orderBy('name')->get();

        $jenisPrestasis = JenisPrestasi::orderBy('nama_prestasi')->get();

        return view('catatan_prestasi.create', compact('siswas', 'jenisPrestasis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:users,id',
            'prestasi_id' => 'required|exists:jenis_prestasis,id',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $validated['guru_id'] = auth()->id();

        CatatanPrestasi::create($validated);

        return redirect()
            ->route('catatan-prestasi.index')
            ->with('success', 'Poin prestasi berhasil dicatat.');
    }
}