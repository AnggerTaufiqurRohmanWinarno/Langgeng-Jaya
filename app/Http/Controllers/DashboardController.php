<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topKategori = DB::table('barang_masuk')
            ->select('id_kategoriBarang', DB::raw('SUM(jumlah) as total'))
            ->groupBy('id_kategoriBarang')
            ->orderByDesc('total')
            ->take(4)
            ->get();

        // Join ke tabel kategori
        $kategori = DB::table('kategori_barang')
            ->whereIn('id', $topKategori->pluck('id_kategoriBarang'))
            ->get()
            ->keyBy('id');

        // Format data untuk chart
        $dataBarang = [];

        foreach ($topKategori as $item) {
            $id = $item->id_kategoriBarang;

            // ambil data per hari (contoh 7 hari)
            $masuk = DB::table('barang_masuk')
                ->where('id_kategoriBarang', $id)
                ->orderBy('tanggal_masuk')
                ->limit(7)
                ->pluck('jumlah');

            $keluar = DB::table('barang_keluar')
                ->where('id_kategoriBarang', $id)
                ->orderBy('tanggal_keluar')
                ->limit(7)
                ->pluck('berat');

            $dataBarang[$id] = [
                'nama' => $kategori[$id]->nama_kategori,
                'masuk' => $masuk->values()->toArray(),
                'keluar' => $keluar->values()->toArray()
            ];
        }
        
        $json = file_get_contents(storage_path('app/hasil_ml.json'));
        $dataML = json_decode($json, true);
        $rekomendasi = $dataML['rekomendasi'];

        $start = Carbon::now()->subDays(6)->format('d/m/Y');
        $end   = Carbon::now()->format('d/m/Y');

        return view('dashboard', compact('topKategori', 'kategori', 'dataBarang','rekomendasi', 'start', 'end'));
    }

}
