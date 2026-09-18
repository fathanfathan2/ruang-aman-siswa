<?php

namespace App\Http\Controllers;

use App\Models\SesiKonseling;
use Illuminate\Http\Request;

class SesiKonselingController extends Controller
{
    public function index()
    {
        $sesiKonselings = SesiKonseling::all();

        return view('sesi_konseling.index', compact('sesiKonselings'));
    }

    public function create()
    {
        return view('sesi_konseling.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'topik' => 'required|string|max:255',
            'jadwal' => 'required|date',
            'tipe' => 'required|in:terbuka,anonim',
        ]);

        $validated['siswa_id'] = auth()->id();
        $validated['status'] = 'menunggu';

        SesiKonseling::create($validated);

        return redirect()
            ->route('sesi-konseling.index')
            ->with('success', 'Booking konseling berhasil dibuat.');
    }

    public function show(SesiKonseling $sesiKonseling)
    {
        return view('sesi_konseling.show', compact('sesiKonseling'));
    }

    public function edit(SesiKonseling $sesiKonseling)
    {
        return view('sesi_konseling.edit', compact('sesiKonseling'));
    }

    public function update(Request $request, SesiKonseling $sesiKonseling)
    {
        $validated = $request->validate([
            'topik' => 'required|string|max:255',
            'jadwal' => 'required|date',
            'tipe' => 'required|in:terbuka,anonim',
            'status' => 'required|in:menunggu,disetujui,selesai',
        ]);

        $sesiKonseling->update($validated);

        return redirect()
            ->route('sesi-konseling.index')
            ->with('success', 'Data konseling berhasil diperbarui.');
    }

    public function destroy(SesiKonseling $sesiKonseling)
    {
        $sesiKonseling->delete();

        return redirect()
            ->route('sesi-konseling.index')
            ->with('success', 'Booking konseling berhasil dihapus.');
    }
}