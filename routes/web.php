<?php

use App\Http\Controllers\SesiKonselingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiKonselingController;

// Halaman awal bawaan Laravel
Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
// Gembok middleware('auth') aku matikan dulu sementara supaya kamu bisa langsung tes UI-nya!

// ==========================================
// FITUR UNTUK SISWA
// ==========================================
Route::get('/siswa/dashboard', [SesiKonselingController::class, 'dashboardSiswa'])->name('siswa.dashboard');
Route::get('/siswa/konseling', [SesiKonselingController::class, 'createKonseling'])->name('siswa.konseling.create');
Route::post('/siswa/konseling', [SesiKonselingController::class, 'storeKonseling'])->name('siswa.konseling.store');

// ==========================================
// FITUR UNTUK GURU BK
// ==========================================
Route::get('/bk/konseling', [SesiKonselingController::class, 'indexBk'])->name('bk.konseling.index');
Route::patch('/bk/konseling/{id}/status', [SesiKonselingController::class, 'updateStatus'])->name('bk.konseling.update');
=======
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

require __DIR__.'/auth.php';
>>>>>>> b5a22db7bb419c461979e3c7192a37bb1143a5b6
