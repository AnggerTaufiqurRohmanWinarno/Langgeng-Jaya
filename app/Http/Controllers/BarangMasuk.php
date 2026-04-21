<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasuk extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = DB::table('kategori_barang')->get();
        return view('barang-masuk', ['query' => $query]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kategoriBarang' => 'required|exists:kategori_barang,id',
            'jumlah' => 'required|integer|min:0',
            'tanggal_masuk' => 'required|date',
        ]);

        DB::table('barang_masuk')->insert([
            'id_kategoriBarang' => $request->id_kategoriBarang,
            'jumlah' => $request->jumlah,
            'tanggal_masuk' => $request->tanggal_masuk,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('barang-masuk.index')->with('success', 'Barang masuk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $barangMasuk = DB::table('barang_masuk')
            ->join('kategori_barang', 'barang_masuk.id_kategoriBarang', '=', 'kategori_barang.id')
            ->select('barang_masuk.*', 'kategori_barang.nama_kategori')
            ->get();

        return view('data-masuk', ['barangMasuk' => $barangMasuk]);
    }
}
