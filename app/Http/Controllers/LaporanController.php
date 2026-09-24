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
}