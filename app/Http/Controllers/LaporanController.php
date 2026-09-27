<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class LaporanController extends Controller
{
    /**
     * Form buat laporan (tampilan siswa)
     */
    public function create()
    {
        return view('siswa.lapor');
    }

    /**
     * Simpan laporan baru dari siswa
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'            => 'required|string|max:255',
            'kategori'         => 'required|string',
            'deskripsi'        => 'required|string',
            'tanggal_kejadian' => 'nullable|date',
        ]);

        Laporan::create([
            'user_id'          => auth()->id(),
            'judul'            => $request->judul,
            'kategori'         => $request->kategori,
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'deskripsi'        => $request->deskripsi,
            'is_anonim'        => $request->has('is_anonim'),
            'status'           => 'menunggu',
        ]);

        return redirect()->route('siswa.dashboard')
            ->with('success', 'Laporan berhasil dikirim dan dijamin kerahasiaannya.');
    }

    /**
     * Detail laporan untuk Guru BK
     */
    public function showBk($id)
    {
        $laporan = Laporan::with('user')->findOrFail($id);
        return view('bk.laporan.show', compact('laporan'));
    }

    /**
     * BK update status laporan + tambah catatan/balasan untuk siswa
     */
    public function updateStatusBk(Request $request, $id)
    {
        $request->validate([
            'status'     => 'required|in:menunggu,diproses,selesai',
            'catatan_bk' => 'nullable|string|max:2000',
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->update([
            'status'     => $request->status,
            'catatan_bk' => $request->catatan_bk,
        ]);

        return redirect()->back()
            ->with('success', 'Status laporan berhasil diperbarui!');
    }
}