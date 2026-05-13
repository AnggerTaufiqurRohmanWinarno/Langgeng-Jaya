<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuk';
    protected $fillable = ['id_kategoriBarang', 'berat', 'tanggal'];

    /** @return BelongsTo<KategoriBarang, covariant BarangMasuk> */
    public function kategoriBarang(): BelongsTo
    {
        return $this->belongsTo(KategoriBarang::class, 'id_kategoriBarang');
    }
}