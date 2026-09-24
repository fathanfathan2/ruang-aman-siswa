<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan; // Pastikan model dipanggil

class LaporanController extends Controller
{
    public function create()
    {
        return view('siswa.lapor');
    }

    public function store(Request $request)
    {
        // 1. Validasi data yang masuk
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'deskripsi' => 'required|string',
            'tanggal_kejadian' => 'nullable|date',
        ]);

        // 2. Simpan ke database
        Laporan::create([
            'user_id' => auth()->id(), // Ambil ID siswa yang sedang login
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'deskripsi' => $request->deskripsi,
            'is_anonim' => $request->has('is_anonim') ? true : false,
            'status' => 'menunggu',
        ]);

        // 3. Kembalikan siswa ke dashboard setelah sukses
        return redirect()->route('siswa.dashboard')->with('success', 'Laporan berhasil dikirim dan dijamin kerahasiaannya.');
    }

    // ... fungsi create dan store sebelumnya ada di atas sini ...

    // Menampilkan detail laporan untuk Guru BK
    public function showBk($id)
    {
        $laporan = Laporan::with('user')->findOrFail($id);
        return view('bk.laporan.show', compact('laporan'));
    }

    // Mengubah status laporan (Menunggu -> Diproses -> Selesai)
    public function updateStatusBk(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai'
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->update([
            'status' => $request->status
        ]);

        return redirect()->route('bk.dashboard')->with('success', 'Status laporan berhasil diperbarui!');
    }
}