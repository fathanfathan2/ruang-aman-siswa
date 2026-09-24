<?php

use App\Http\Controllers\SesiKonselingController;
use App\Http\Controllers\JenisPelanggaranController;
use App\Http\Controllers\CatatanPoinController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporanController; // <-- Tambahkan baris ini
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

Route::get('/bk/dashboard', function () {
    return view('bk.dashboard');
})->middleware(['auth', 'verified'])->name('bk.dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

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
// Gembok middleware('auth') dimatikan dulu sementara
Route::get('/siswa/konseling', [SesiKonselingController::class, 'createKonseling'])->name('siswa.konseling.create');
Route::post('/siswa/konseling', [SesiKonselingController::class, 'storeKonseling'])->name('siswa.konseling.store');

// --- Rute Form Laporan Siswa ---
Route::get('/siswa/lapor', [LaporanController::class, 'create'])->name('siswa.laporan.create');

// ==========================================
// FITUR UNTUK GURU BK (Sesi Konseling)
// ==========================================
Route::get('/bk/konseling', [SesiKonselingController::class, 'indexBk'])->name('bk.konseling.index');
Route::patch('/bk/konseling/{id}/status', [SesiKonselingController::class, 'updateStatus'])->name('bk.konseling.update');

// --- TAMBAHAN DAVIN: SISTEM POIN KEDISIPLINAN ---
Route::resource('jenis-pelanggaran', JenisPelanggaranController::class)
    ->except(['show']);

Route::resource('catatan-poin', CatatanPoinController::class)
    ->only(['index', 'create', 'store']);
// -------------------------------------------------

require __DIR__.'/auth.php';

// --- Rute Form Laporan Siswa ---
Route::get('/siswa/lapor', [LaporanController::class, 'create'])->name('siswa.laporan.create');
Route::post('/siswa/lapor', [LaporanController::class, 'store'])->name('siswa.laporan.store'); // <-- Tambahkan ini