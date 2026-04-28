<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangKeluar extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = DB::table('kategori_barang')->get();
        return view('barang-keluar', ['query' => $query]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kategoriBarang' => 'required',
            'berat' => 'required|integer',
            'tanggal_keluar' => 'required|date',
        ]);

        $stok = DB::table('stok_barang')
            ->where('id_kategoriBarang', $request->id_kategoriBarang)
            ->value('stok') ?? 0;

        if ($stok < $request->berat) {
            return back()->with('error', 'Stok tidak cukup!')->withInput();
        }

        DB::table('barang_keluar')->insert([
            'id_kategoriBarang' => $request->id_kategoriBarang,
            'berat' => $request->berat,
            'tanggal_keluar' => $request->tanggal_keluar,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 🔻 KURANGI STOK
        DB::table('stok_barang')
            ->where('id_kategoriBarang', $request->id_kategoriBarang)
            ->decrement('stok', $request->berat);

        return redirect()->route('barang-keluar.index')->with('success', 'Barang keluar berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $barangKeluar = DB::table('barang_keluar')
            ->join('kategori_barang', 'barang_keluar.id_kategoriBarang', '=', 'kategori_barang.id')
            ->select('barang_keluar.*', 'kategori_barang.nama_kategori')
            ->get();

        return view('data-keluar', ['barangKeluar' => $barangKeluar]);
    }
}
