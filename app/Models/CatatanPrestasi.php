<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatatanPrestasi extends Model
{
    protected $fillable = [
        'siswa_id',
        'prestasi_id',
        'guru_id',
        'tanggal',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function prestasi(): BelongsTo
    {
        return $this->belongsTo(JenisPrestasi::class, 'prestasi_id');
    }
}