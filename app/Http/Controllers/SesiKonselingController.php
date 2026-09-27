<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SesiKonseling;
use App\Models\PesanKonseling;

class SesiKonselingController extends Controller
{
    // ==========================================
    // RESOURCE ROUTES (sesi-konseling.*)
    // Dipakai oleh Davin untuk kelola jadwal
    // ==========================================

    /**
     * Daftar semua sesi konseling
     */
    public function index()
    {
        $sesiKonselings = SesiKonseling::with('siswa')->latest()->get();
        return view('sesi_konseling.index', compact('sesiKonselings'));
    }

    /**
     * Form buat jadwal konseling baru
     */
    public function create()
    {
        return view('sesi_konseling.create');
    }

    /**
     * Simpan jadwal konseling baru (dari resource route)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'topik'  => 'required|string|max:255',
            'jadwal' => 'required|date|after:now',
            'tipe'   => 'required|in:terbuka,anonim',
        ]);

        $validated['siswa_id'] = auth()->id();
        $validated['status']   = 'menunggu';

        SesiKonseling::create($validated);

        return redirect()->route('sesi-konseling.index')
            ->with('success', 'Booking konseling berhasil diajukan!');
    }

    /**
     * Halaman detail sesi konseling + ruang tanya jawab (chat)
     */
    public function show($id)
    {
        $sesiKonseling = SesiKonseling::with(['siswa', 'pesans.pengirim'])->findOrFail($id);
        return view('sesi_konseling.show', compact('sesiKonseling'));
    }

    /**
     * Hapus sesi konseling
     */
    public function destroy($id)
    {
        SesiKonseling::findOrFail($id)->delete();

        return redirect()->route('sesi-konseling.index')
            ->with('success', 'Jadwal konseling berhasil dihapus.');
    }

    // ==========================================
    // FITUR SISWA (Fathan's routes: siswa.konseling.*)
    // ==========================================

    public function dashboardSiswa()
    {
        $laporans         = \App\Models\Laporan::where('user_id', auth()->id())->latest()->get();
        $jumlahKonseling  = \App\Models\SesiKonseling::where('siswa_id', auth()->id())->count();
        return view('siswa.dashboard', compact('laporans', 'jumlahKonseling'));
    }

    public function createKonseling()
    {
        return view('siswa.konseling');
    }

    /**
     * Simpan booking konseling dari form siswa (redirect ke dashboard siswa)
     */
    public function storeKonseling(Request $request)
    {
        $validated = $request->validate([
            'topik'  => 'required|string|max:255',
            'jadwal' => 'required|date|after:now',
            'tipe'   => 'required|in:terbuka,anonim',
        ]);

        $validated['siswa_id'] = auth()->id();
        $validated['status']   = 'menunggu';

        SesiKonseling::create($validated);

        return redirect()->route('siswa.dashboard')
            ->with('success', 'Booking konseling berhasil diajukan! Tunggu konfirmasi dari Guru BK.');
    }

    // ==========================================
    // FITUR GURU BK
    // ==========================================

    /**
     * Daftar semua pengajuan konseling (untuk halaman BK)
     */
    public function indexBk()
    {
        $sesiKonselings = SesiKonseling::with('siswa')->latest()->get();
        return view('bk.konseling', compact('sesiKonselings'));
    }

    /**
     * Update status konseling (setujui / tolak / selesai)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,disetujui,ditolak,selesai',
        ]);

        SesiKonseling::findOrFail($id)->update(['status' => $request->status]);

        return redirect()->back()
            ->with('success', 'Status konseling berhasil diperbarui.');
    }

    // ==========================================
    // FITUR TANYA JAWAB / CHAT
    // ==========================================

    /**
     * Kirim pesan baru dalam sesi konseling
     */
    public function storePesan(Request $request, $id)
    {
        $request->validate([
            'isi' => 'required|string|max:2000',
        ]);

        PesanKonseling::create([
            'sesi_konseling_id' => $id,
            'pengirim_id'       => auth()->id(),
            'isi'               => $request->isi,
        ]);

        return redirect()->back()->with('pesan_success', 'Pesan terkirim!');
    }
}