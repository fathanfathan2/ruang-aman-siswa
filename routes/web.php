<?php

use App\Http\Controllers\SesiKonselingController;
use App\Http\Controllers\JenisPelanggaranController;
use App\Http\Controllers\CatatanPoinController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- RUTE ROLE RUANG AMAN SISWA ---

Route::get('/siswa/dashboard', function () {
    return view('siswa.dashboard');
})->middleware(['auth', 'verified'])->name('siswa.dashboard');

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

// SESI KONSELING → sementara TANPA login
Route::resource('sesi-konseling', SesiKonselingController::class);

// --- TAMBAHAN DAVIN: SISTEM POIN KEDISIPLINAN ---
Route::resource('jenis-pelanggaran', JenisPelanggaranController::class)
    ->except(['show']);

Route::resource('catatan-poin', CatatanPoinController::class)
    ->only(['index', 'create', 'store']);
// -------------------------------------------------

require __DIR__.'/auth.php';