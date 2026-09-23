<?php

namespace App\Http\Controllers;

use App\Models\JenisPrestasi;
use Illuminate\Http\Request;

class JenisPrestasiController extends Controller
{
    public function index()
    {
        $jenisPrestasis = JenisPrestasi::orderBy('nama_prestasi')->get();

        return view('jenis_prestasi.index', compact('jenisPrestasis'));
    }

    public function create()
    {
        return view('jenis_prestasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_prestasi' => 'required|string|max:255',
            'poin' => 'required|integer|min:0',
            'kategori' => 'required|in:akademik,non_akademik,sikap',
        ]);

        JenisPrestasi::create($validated);

        return redirect()
            ->route('jenis-prestasi.index')
            ->with('success', 'Jenis prestasi berhasil ditambahkan.');
    }

    public function edit(JenisPrestasi $jenisPrestasi)
    {
        return view('jenis_prestasi.edit', compact('jenisPrestasi'));
    }

    public function update(Request $request, JenisPrestasi $jenisPrestasi)
    {
        $validated = $request->validate([
            'nama_prestasi' => 'required|string|max:255',
            'poin' => 'required|integer|min:0',
            'kategori' => 'required|in:akademik,non_akademik,sikap',
        ]);

        $jenisPrestasi->update($validated);

        return redirect()
            ->route('jenis-prestasi.index')
            ->with('success', 'Jenis prestasi berhasil diperbarui.');
    }

    public function destroy(JenisPrestasi $jenisPrestasi)
    {
        $jenisPrestasi->delete();

        return redirect()
            ->route('jenis-prestasi.index')
            ->with('success', 'Jenis prestasi berhasil dihapus.');
    }
}