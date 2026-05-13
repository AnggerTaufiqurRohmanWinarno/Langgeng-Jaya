<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/** @use HasFactory<Factory<KategoriBarang>> */
class KategoriBarang extends Model
{
    /** @use HasFactory<Factory<KategoriBarang>> */
    use HasFactory;

    protected $table = 'kategori_barang';
    protected $fillable = ['nama_kategori', 'deskripsi'];
}