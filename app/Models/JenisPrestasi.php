<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisPrestasi extends Model
{
    protected $fillable = [
        'nama_prestasi',
        'poin',
        'kategori',
    ];

    public function catatanPrestasis(): HasMany
    {
        return $this->hasMany(CatatanPrestasi::class, 'prestasi_id');
    }
}