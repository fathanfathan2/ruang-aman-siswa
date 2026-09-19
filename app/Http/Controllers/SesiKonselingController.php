<?php

namespace App\Http\Controllers;

use App\Models\SesiKonseling;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;

class SesiKonselingController extends Controller
{
    // ==========================================
    // FITUR UNTUK SISWA
    // ==========================================

    public function dashboardSiswa()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();
        return view('siswa.dashboard', compact('user'));
    }

    public function createKonseling()
    {
        return view('siswa.konseling');
    }

    public function storeKonseling(Request $request)
    {
        // 1. Validasi inputan dari form siswa
        $request->validate([
            'topik'  => 'required|string|max:255',
            'jadwal' => 'required|date',
            'tipe'   => 'required|in:terbuka,anonim',
        ]);

        // 2. Simpan ke database
        SesiKonseling::create([
            'siswa_id' => Auth::id(), // Otomatis mengambil ID siswa yang login
            'topik'    => $request->topik,
            'jadwal'   => $request->jadwal,
            'status'   => 'menunggu', // Status default saat pertama kali diajukan
            'tipe'     => $request->tipe,
        ]);

        // 3. Kembalikan ke halaman form dengan pesan sukses
        return redirect()->route('siswa.konseling.create')->with('success', 'Jadwal sesi konseling berhasil diajukan! Silakan tunggu konfirmasi dari Guru BK.');
    }

    // ==========================================
    // FITUR UNTUK GURU BK
    // ==========================================

    public function indexBk()
    {
        // Ambil semua data pengajuan konseling beserta relasi nama siswanya, urutkan dari yang terbaru
        $sesiKonselings = SesiKonseling::with('siswa')->latest()->get();
        return view('bk.konseling', compact('sesiKonselings'));
    }

    public function updateStatus(Request $request, $id)
    {
        // 1. Validasi perubahan status
        $request->validate([
            'status' => 'required|in:menunggu,disetujui,selesai',
        ]);

        // 2. Cari data berdasarkan ID, lalu update statusnya
        $sesi = SesiKonseling::findOrFail($id);
        $sesi->update([
            'status' => $request->status
        ]);

        // 3. Kembalikan ke halaman BK dengan pesan sukses
        return redirect()->route('bk.konseling.index')->with('success', 'Status konseling berhasil diperbarui!');
=======

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
>>>>>>> b5a22db7bb419c461979e3c7192a37bb1143a5b6
    }
}