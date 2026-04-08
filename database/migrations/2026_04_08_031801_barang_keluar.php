<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->id()->unique();
            $table->foreignId('id_kategoriBarang')->constrained('kategori_barang')->onDelete('cascade');
            $table->integer('berat');
            $table->date('tanggal');
            $table->integer('bulan');
            $table->integer('minggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
