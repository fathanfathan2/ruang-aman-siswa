<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SesiKonseling;

class SesiKonselingController extends Controller
{
    // ==========================================
    // FITUR SISWA
    // ==========================================
    
    public function dashboardSiswa()
    {
        return view('siswa.dashboard'); 
    }

    public function createKonseling()
    {
        // Menampilkan halaman form booking konseling untuk siswa
        return view('siswa.konseling');
    }

    public function storeKonseling(Request $request)
    {
        // Nanti logika untuk menyimpan isian form ke database kita buat di sini
        return "Berhasil! Form booking konseling sudah terkirim (Ini baru pesan tes).";
    }

    // ==========================================
    // FITUR GURU BK
    // ==========================================

    public function indexBk()
    {
        // Menampilkan daftar siswa yang request konseling di halaman Guru BK
        return view('bk.konseling');
    }

    public function updateStatus(Request $request, $id)
    {
        // Nanti logika untuk Guru BK menyetujui jadwal ada di sini
        return "Status konseling berhasil diupdate.";
    }
}