<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    // Mengizinkan kolom-kolom ini diisi data
    protected $fillable = [
        'user_id',
        'judul',
        'kategori',
        'tanggal_kejadian',
        'deskripsi',
        'is_anonim',
        'status',
    ];

    // Relasi: 1 Laporan dimiliki oleh 1 User (Siswa)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}