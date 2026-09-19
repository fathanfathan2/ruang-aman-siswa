<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
use App\Models\User;
>>>>>>> b5a22db7bb419c461979e3c7192a37bb1143a5b6
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SesiKonseling extends Model
{
<<<<<<< HEAD
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
=======
    protected $fillable = [
        'siswa_id',
        'topik',
        'jadwal',
        'status',
        'tipe',
    ];

    protected $casts = [
        'jadwal' => 'datetime',
    ];

    public function siswa(): BelongsTo
>>>>>>> b5a22db7bb419c461979e3c7192a37bb1143a5b6
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}