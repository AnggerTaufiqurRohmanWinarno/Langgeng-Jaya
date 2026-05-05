<?php

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class KategoriBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriBarang::all();
        return view('kategori-barang', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'nullable'
        ]);

        KategoriBarang::create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('kategori-barang.index')->with('success', 'Kategori barang berhasil ditambahkan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = KategoriBarang::findOrFail($id);
        $kategori->delete();
        return redirect()->route('kategori-barang.index')->with('success', 'Kategori barang berhasil dihapus.');
    }

    public function show(string $id)
    {
        $kategori = KategoriBarang::findOrFail($id);
        return view('edit-kategori', compact('kategori'));

    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'nullable'
        ]);

        $kategori = KategoriBarang::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('kategori-barang.index')->with('success', 'Kategori barang berhasil diperbarui.');
    }

}
