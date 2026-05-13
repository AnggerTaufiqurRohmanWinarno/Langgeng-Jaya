<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BarangMasuk extends Controller
{
    public function index(): View
    {
        $query = DB::table('kategori_barang')->get();
        return view('barang-masuk', ['query' => $query]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'id_kategoriBarang' => 'required|exists:kategori_barang,id',
            'jumlah' => 'required|integer|min:0',
            'tanggal_masuk' => 'required|date',
        ]);

        $jumlah = $request->integer('jumlah');

        DB::table('barang_masuk')->insert([
            'id_kategoriBarang' => $request->id_kategoriBarang,
            'jumlah' => $jumlah,
            'tanggal_masuk' => $request->tanggal_masuk,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Gunakan increment() agar tidak perlu DB::raw sama sekali
        $existing = DB::table('stok_barang')
            ->where('id_kategoriBarang', $request->id_kategoriBarang)
            ->exists();

        if ($existing) {
            DB::table('stok_barang')
                ->where('id_kategoriBarang', $request->id_kategoriBarang)
                ->increment('stok', $jumlah);
        } else {
            DB::table('stok_barang')->insert([
                'id_kategoriBarang' => $request->id_kategoriBarang,
                'stok' => $jumlah,
            ]);
        }

        return redirect()->route('barang-masuk.index')->with('success', 'Barang masuk berhasil ditambahkan.');
    }

    public function show(): View
    {
        $barangMasuk = DB::table('barang_masuk')
            ->join('kategori_barang', 'barang_masuk.id_kategoriBarang', '=', 'kategori_barang.id')
            ->select('barang_masuk.*', 'kategori_barang.nama_kategori')
            ->get();

        return view('data-masuk', ['barangMasuk' => $barangMasuk]);
    }
}