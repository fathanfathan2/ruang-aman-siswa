<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PesanKonseling extends Model
{
    protected $fillable = [
        'sesi_konseling_id',
        'pengirim_id',
        'isi',
    ];

    // Relasi ke sesi konseling induk
    public function sesiKonseling(): BelongsTo
    {
        return $this->belongsTo(SesiKonseling::class, 'sesi_konseling_id');
    }

    // Relasi ke user yang mengirim pesan
    public function pengirim(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }
}
