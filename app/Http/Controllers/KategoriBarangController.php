<?php

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KategoriBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $kategori = KategoriBarang::all();
        return view('kategori-barang', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
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
    public function destroy(string $id): RedirectResponse
    {
        $kategori = KategoriBarang::findOrFail($id);
        $kategori->delete();
        return redirect()->route('kategori-barang.index')->with('success', 'Kategori barang berhasil dihapus.');
    }

    public function show(string $id): View
    {
        $kategori = KategoriBarang::findOrFail($id);
        return view('edit-kategori', compact('kategori'));
    }

    public function update(Request $request, string $id): RedirectResponse
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