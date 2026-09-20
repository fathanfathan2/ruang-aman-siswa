<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisPelanggaran extends Model
{
    protected $fillable = [
        'nama_pelanggaran',
        'poin',
        'kategori',
    ];

    public function catatanPoins(): HasMany
    {
        return $this->hasMany(CatatanPoin::class, 'pelanggaran_id');
    }
}