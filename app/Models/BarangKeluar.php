<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluar';
    protected $fillable = ['id_kategoriBarang', 'berat', 'tanggal', 'bulan', 'minggu'];

    public function kategoriBarang()
    {
        return $this->belongsTo(KategoriBarang::class, 'id_kategoriBarang');
    }
}
