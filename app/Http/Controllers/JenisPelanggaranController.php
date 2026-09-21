<?php

namespace App\Http\Controllers;

use App\Models\JenisPelanggaran;
use Illuminate\Http\Request;

class JenisPelanggaranController extends Controller
{
    public function index() {
    $jenisPelanggaran = JenisPelanggaran::all(); // sesuaikan dengan nama model Anda
    // Arahkan ke file index milik jenis_pelanggaran
    return view('jenis_pelanggaran.index', compact('jenisPelanggaran')); 
}


    public function create()
    {
        return view('jenis_pelanggaran.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggaran' => 'required|string|max:255',
            'poin' => 'required|integer|min:0',
            'kategori' => 'required|in:ringan,sedang,berat',
        ]);

        JenisPelanggaran::create($validated);

        return redirect()
            ->route('jenis-pelanggaran.index')
            ->with('success', 'Jenis pelanggaran berhasil ditambahkan.');
    }

    public function edit(JenisPelanggaran $jenisPelanggaran)
    {
        return view('jenis_pelanggaran.edit', compact('jenisPelanggaran'));
    }

    public function update(Request $request, JenisPelanggaran $jenisPelanggaran)
    {
        $validated = $request->validate([
            'nama_pelanggaran' => 'required|string|max:255',
            'poin' => 'required|integer|min:0',
            'kategori' => 'required|in:ringan,sedang,berat',
        ]);

        $jenisPelanggaran->update($validated);

        return redirect()
            ->route('jenis-pelanggaran.index')
            ->with('success', 'Jenis pelanggaran berhasil diperbarui.');
    }

    public function destroy(JenisPelanggaran $jenisPelanggaran)
    {
        $jenisPelanggaran->delete();

        return redirect()
            ->route('jenis-pelanggaran.index')
            ->with('success', 'Jenis pelanggaran berhasil dihapus.');
    }
}