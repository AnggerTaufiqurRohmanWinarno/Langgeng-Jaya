@extends('layouts.app')

@section('title', 'Dashboard')

@section('styles')
    <style>
        .card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
        }

        /* NOTIF */
        .notif {
            margin-top: 15px;
            height: 80px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding-left: 20px;
            color: #555;
        }

        .notif i {
            font-size: 24px;
            color: #3E7B27;
        }

        /* STATS */
        .stats {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .stat-box {
            flex: 1 1 200px;
            background: white;
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #ddd;
            cursor: pointer;
            transition: 0.2s;
        }

        .stat-box:hover {
            transform: scale(1.03);
        }

        .stat-box.active {
            border: 2px solid #3E7B27;
        }

        .stat-title {
            font-size: 12px;
            color: #666;
            margin-bottom: 10px;
        }

        .stat-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-content small {
            display: block;
            font-size: 11px;
            color: #999;
        }

        .stat-content h2 {
            font-size: 32px;
        }

        /* CHART */
        .chart-header {
            background: #8DB255;
            color: white;
            padding: 8px;
            border-radius: 6px;
            display: flex;
            justify-content: space-between;
        }

        .chart {
            height: 220px;
            background: #fafafa;
            border: 1px solid #ddd;
            padding: 10px;
        }

        .chart{
            overflow: hidden;
        }
        body {
            overflow-x: hidden;
        }

        
    </style>
@endsection

@section('content')

    <h2>Dashboard</h2>

    <div class="card notif">
        <i class="fa-regular fa-bell"></i>
        <div>
            <div><b>Barang yang bisa dijual</b></div>
            <div style="font-size:13px;color:#888;">{{ $rekomendasi }}</div>
        </div>
    </div>

    <div class="stats">
        @foreach ($topKategori as $item)
            @php
                $kat = $kategori[$item->id_kategoriBarang];
            @endphp

            <div class="stat-box" data-barang="{{ $item->id_kategoriBarang }}">
                <div class="stat-title">Total Barang</div>
                <div class="stat-content">
                    <div>
                        {{ $kat->nama_kategori }}
                        <small>{{ now()->format('d/m/Y') }}</small>
                    </div>
                    <h2>{{ $item->total }}</h2>
                </div>
            </div>
        @endforeach

    </div>

    <!-- CHART MASUK -->
    <div class="card">
        <div class="chart-header">
            <span id="titleMasuk">Barang Masuk</span>
            <span>{{ $start }} - {{ $end }}</span>
        </div>

        <div class="chart">
            <div id="chartMasuk"></div>
        </div>
    </div>

    <!-- CHART KELUAR -->
    <div class="card">
        <div class="chart-header">
            <span id="titleKeluar">Barang Keluar</span>
            <span>{{ $start }} - {{ $end }}</span>
        </div>

        <div class="chart">
            <div id="chartKeluar"></div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {

        const dataBarang = @json($dataBarang);
        const keys = Object.keys(dataBarang);

        if (keys.length === 0) {
            console.error("Data kosong!");
            return;
        }

        const firstKey = keys[0];

        const chartMasuk = new ApexCharts(document.querySelector("#chartMasuk"), {
            chart: { type: 'line', height: 220 },
            series: [{
                name: 'Barang Masuk',
                data: dataBarang[firstKey].masuk || []
            }],
            xaxis: {
                categories: ['1','2','3','4','5','6','7']
            },
            colors: ['#3E7B27']
        });

        const chartKeluar = new ApexCharts(document.querySelector("#chartKeluar"), {
            chart: { type: 'line', height: 220 },
            series: [{
                name: 'Barang Keluar',
                data: dataBarang[firstKey].keluar || []
            }],
            xaxis: {
                categories: ['1','2','3','4','5','6','7']
            },
            colors: ['#8DB255']
        });

        chartMasuk.render();
        chartKeluar.render();

        // ✅ EVENT CLICK DI SINI (WAJIB DI DALAM)
        document.querySelectorAll('.stat-box').forEach(card => {
            card.addEventListener('click', function () {

                document.querySelectorAll('.stat-box').forEach(c => c.classList.remove('active'));
                this.classList.add('active');

                const id = this.getAttribute('data-barang');

                if (!dataBarang[id]) {
                    alert("Data tidak ditemukan!");
                    return;
                }

                chartMasuk.updateSeries([{
                    data: dataBarang[id].masuk || []
                }]);

                chartKeluar.updateSeries([{
                    data: dataBarang[id].keluar || []
                }]);

                document.getElementById('titleMasuk').innerText =
                    "Barang Masuk - " + dataBarang[id].nama;

                document.getElementById('titleKeluar').innerText =
                    "Barang Keluar - " + dataBarang[id].nama;
            });
        });

    });
    </script>
@endsection
