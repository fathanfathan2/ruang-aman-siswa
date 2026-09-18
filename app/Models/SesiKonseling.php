<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesiKonseling extends Model
{
    use HasFactory;

    // Menghubungkan model ke tabel yang sudah ada
    protected $table = 'sesi_konselings';

    // Kolom yang boleh diisi
    protected $fillable = [
        'siswa_id', 
        'topik', 
        'jadwal', 
        'status', 
        'tipe'              
    ];

    // Relasi ke tabel users (sebagai siswa)
    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}