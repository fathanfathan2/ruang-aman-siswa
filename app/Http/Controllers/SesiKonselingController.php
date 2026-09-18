<?php

namespace App\Http\Controllers;

use App\Models\SesiKonseling;
use Illuminate\Http\Request;
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
    }
}