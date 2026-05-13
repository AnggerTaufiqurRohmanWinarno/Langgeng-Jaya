<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index(): View
    {
        $topKategori = DB::table('stok_barang as s')
            ->join('kategori_barang as k', 's.id_kategoriBarang', '=', 'k.id')
            ->select(
                'k.id',
                'k.nama_kategori',
                's.stok as total'
            )
            ->orderByDesc('s.stok')
            ->take(4)
            ->get();

        $dataBarang = [];
        $rekomendasi = [];

        foreach ($topKategori as $item) {

            $id = $item->id;
            $nama = strtolower($item->nama_kategori);
            $stok = $item->total;

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
                'nama' => $nama,
                'masuk' => $masuk->values()->toArray(),
                'keluar' => $keluar->values()->toArray(),
                'stok' => $stok
            ];

            try {
                $response = Http::post('https://machinelearning-production-3e2d.up.railway.app/prediksi', [
                    'barang' => $nama,
                    'stok' => $stok
                ]);

                if ($response->successful()) {
                    $json = $response->json();
                    // Fix: pastikan $json adalah array sebelum akses offset
                    $rekomendasi[$nama] = is_array($json) && isset($json['rekomendasi']) && is_scalar($json['rekomendasi'])
                        ? (string) $json['rekomendasi']
                        : 'ERROR';
                } else {
                    $rekomendasi[$nama] = 'API ERROR';
                }

            } catch (\Exception $e) {
                $rekomendasi[$nama] = 'SERVER OFF';
            }
        }

        $start = Carbon::now()->subDays(6)->format('d/m/Y');
        $end   = Carbon::now()->format('d/m/Y');

        return view('dashboard', compact(
            'topKategori',
            'dataBarang',
            'start',
            'end',
            'rekomendasi'
        ));
    }
}