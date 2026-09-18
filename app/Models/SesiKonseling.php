<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SesiKonseling extends Model
{
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
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}