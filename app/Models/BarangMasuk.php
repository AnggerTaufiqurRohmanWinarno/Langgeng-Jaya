<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuk';
    protected $fillable = ['id_kategoriBarang', 'berat', 'tanggal'];

    public function kategoriBarang()
    {
        return $this->belongsTo(KategoriBarang::class, 'id_kategoriBarang');
    }
}
