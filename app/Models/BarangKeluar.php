<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluar';
    protected $fillable = ['id_kategoriBarang', 'berat', 'tanggal', 'bulan', 'minggu'];

    /** @return BelongsTo<KategoriBarang, covariant BarangKeluar> */
    public function kategoriBarang(): BelongsTo
    {
        return $this->belongsTo(KategoriBarang::class, 'id_kategoriBarang');
    }
}