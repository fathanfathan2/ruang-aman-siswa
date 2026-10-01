<?php

use App\Http\Controllers\SesiKonselingController;
use App\Http\Controllers\JenisPelanggaranController;
use App\Http\Controllers\CatatanPoinController;
use App\Http\Controllers\JenisPrestasiController;
use App\Http\Controllers\RekapPoinController;
use App\Http\Controllers\CatatanPrestasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

// Halaman awal bawaan Laravel
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    if ($role === 'bk') {
        return redirect('/bk/dashboard');
    } elseif ($role === 'admin') {
        return redirect('/admin/dashboard');
    } else {
        return redirect('/siswa/dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// --- RUTE ROLE RUANG AMAN SISWA ---

// Dashboard Siswa (Di-handle oleh SesiKonselingController milikmu)
Route::get('/siswa/dashboard', [SesiKonselingController::class, 'dashboardSiswa'])->name('siswa.dashboard');

// Dashboard BK (gabungan data Laporan + Histori Poin Kedisiplinan)
Route::get('/bk/dashboard', function () {
    $laporans = \App\Models\Laporan::latest()->get();

    $catatanPoins = \App\Models\CatatanPoin::with(['siswa', 'pelanggaran'])
        ->orderByDesc('tanggal')
        ->limit(5)
        ->get();

    return view('bk.dashboard', compact('laporans', 'catatanPoins'));
})->middleware(['auth', 'verified'])->name('bk.dashboard');

// ==========================================
// FITUR UNTUK ADMIN (Manajemen User)
// ==========================================
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    // Halaman Utama Admin
    Route::get('/dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->name('dashboard');

    // Rute Lengkap CRUD (Create, Read, Update, Delete) untuk Kelola Akun
    Route::resource('users', App\Http\Controllers\UserController::class);

});

// ----------------------------------

// PROFILE → tetap membutuhkan login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================================
// FITUR UNTUK SISWA (Sesi Konseling & Laporan)
// ==========================================
Route::get('/siswa/konseling', [SesiKonselingController::class, 'createKonseling'])->name('siswa.konseling.create');
Route::post('/siswa/konseling', [SesiKonselingController::class, 'storeKonseling'])->name('siswa.konseling.store');

// --- Rute Form Laporan Siswa ---
Route::get('/siswa/lapor', [LaporanController::class, 'create'])->name('siswa.laporan.create');
Route::post('/siswa/lapor', [LaporanController::class, 'store'])->name('siswa.laporan.store');

// ==========================================
// FITUR UNTUK GURU BK
// ==========================================
Route::get('/bk/konseling', [SesiKonselingController::class, 'indexBk'])->name('bk.konseling.index');
Route::patch('/bk/konseling/{id}/status', [SesiKonselingController::class, 'updateStatus'])->name('bk.konseling.update');

// --- Aksi Laporan (Guru BK) ---
Route::get('/bk/laporan/{id}', [LaporanController::class, 'showBk'])->name('bk.laporan.show');
Route::patch('/bk/laporan/{id}/status', [LaporanController::class, 'updateStatusBk'])->name('bk.laporan.update');

// --- TAMBAHAN DAVIN: SISTEM POIN KEDISIPLINAN ---
Route::resource('jenis-pelanggaran', JenisPelanggaranController::class)
    ->except(['show']);

Route::resource('jenis-prestasi', JenisPrestasiController::class)
    ->except(['show']);

Route::resource('catatan-poin', CatatanPoinController::class)
    ->only(['index', 'create', 'store']);

Route::resource('catatan-prestasi', CatatanPrestasiController::class)
    ->only(['index', 'create', 'store']);

Route::get('/rekap-poin', [RekapPoinController::class, 'index'])->name('rekap-poin.index');
// -------------------------------------------------

// HARUS SELALU BERADA DI BARIS PALING BAWAH
require __DIR__.'/auth.php';