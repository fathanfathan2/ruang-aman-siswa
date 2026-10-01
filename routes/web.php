<?php

use App\Http\Controllers\SesiKonselingController;
use App\Http\Controllers\JenisPelanggaranController;
use App\Http\Controllers\CatatanPoinController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

// Halaman awal bawaan Laravel
Route::get('/', function () {
    return view('welcome');
});

// Redirect setelah login / akses /dashboard langsung ke dashboard siswa
Route::get('/dashboard', function () {
    return redirect()->route('siswa.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==========================================
// PROFILE (semua role yang sudah login)
// ==========================================
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================================
// FITUR SISWA
// ==========================================
Route::middleware(['auth'])->group(function () {

    // Dashboard Siswa
    Route::get('/siswa/dashboard', [SesiKonselingController::class, 'dashboardSiswa'])->name('siswa.dashboard');

    // Form Booking Konseling
    Route::get('/siswa/konseling', [SesiKonselingController::class, 'createKonseling'])->name('siswa.konseling.create');
    Route::post('/siswa/konseling', [SesiKonselingController::class, 'storeKonseling'])->name('siswa.konseling.store');

    // Form Buat Laporan
    Route::get('/siswa/lapor', [LaporanController::class, 'create'])->name('siswa.laporan.create');
    Route::post('/siswa/lapor', [LaporanController::class, 'store'])->name('siswa.laporan.store');
});

// ==========================================
// FITUR GURU BK
// ==========================================
Route::middleware(['auth'])->group(function () {

    // Dashboard BK
    Route::get('/bk/dashboard', function () {
        $laporans = \App\Models\Laporan::latest()->get();
        return view('bk.dashboard', compact('laporans'));
    })->name('bk.dashboard');

    // Kelola Konseling
    Route::get('/bk/konseling', [SesiKonselingController::class, 'indexBk'])->name('bk.konseling.index');
    Route::patch('/bk/konseling/{id}/status', [SesiKonselingController::class, 'updateStatus'])->name('bk.konseling.update');

    // Kelola Laporan
    Route::get('/bk/laporan/{id}', [LaporanController::class, 'showBk'])->name('bk.laporan.show');
    Route::patch('/bk/laporan/{id}/status', [LaporanController::class, 'updateStatusBk'])->name('bk.laporan.update');

    // Sistem Poin Kedisiplinan
    Route::resource('jenis-pelanggaran', JenisPelanggaranController::class)->except(['show']);
    Route::resource('catatan-poin', CatatanPoinController::class)->only(['index', 'create', 'store']);
});

// ==========================================
// FITUR ADMIN
// ==========================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->name('dashboard');
    Route::resource('users', App\Http\Controllers\UserController::class);
});

// ==========================================
// SESI KONSELING RESOURCE
// + FITUR TANYA JAWAB (CHAT)
// ==========================================
Route::middleware(['auth'])->group(function () {
    Route::resource('sesi-konseling', SesiKonselingController::class)
        ->only(['index', 'create', 'store', 'show', 'destroy']);

    Route::post('/sesi-konseling/{id}/pesan', [SesiKonselingController::class, 'storePesan'])
        ->name('sesi-konseling.pesan.store');
});

// HARUS SELALU BERADA DI BARIS PALING BAWAH
require __DIR__.'/auth.php';