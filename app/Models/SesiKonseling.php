<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class SesiKonseling extends Model
{
    use HasFactory;

    // Menghubungkan model ke tabel
    protected $table = 'sesi_konselings';

    // Kolom yang boleh diisi
    protected $fillable = [
        'siswa_id',
        'topik',
        'jadwal',
        'status',
        'tipe',
    ];

    // Memastikan jadwal dibaca sebagai format waktu (datetime) otomatis
    protected $casts = [
        'jadwal' => 'datetime',
    ];

    // Relasi ke tabel users (sebagai siswa)
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}