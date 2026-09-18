<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiKonselingController;

// Halaman awal bawaan Laravel
Route::get('/', function () {
    return view('welcome');
});

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