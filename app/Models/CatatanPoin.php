<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatatanPoin extends Model
{
    protected $fillable = [
        'siswa_id',
        'pelanggaran_id',
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

    public function pelanggaran(): BelongsTo
    {
        return $this->belongsTo(JenisPelanggaran::class, 'pelanggaran_id');
    }
}