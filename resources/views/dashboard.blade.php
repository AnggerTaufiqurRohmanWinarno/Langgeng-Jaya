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
}

.stat-box {
    flex: 1;
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
</style>
@endsection

@section('content')

<h2>Dashboard</h2>

<div class="card notif">
    <i class="fa-regular fa-bell"></i>
    <div>
        <div><b>Barang yang Direkomendasikan</b></div>
        <div style="font-size:13px;color:#888;">Besi Tua</div>
    </div>
</div>

<div class="stats">
    <div class="stat-box" data-barang="besi_tua">
        <div class="stat-title">Total Barang</div>
        <div class="stat-content">
            <div>
                Besi Tua
                <small>05/04/2026</small>
            </div>
            <h2>40</h2>
        </div>
    </div>

    <div class="stat-box" data-barang="kardus">
        <div class="stat-title">Total Barang</div>
        <div class="stat-content">
            <div>
                Kardus
                <small>06/04/2026</small>
            </div>
            <h2>20</h2>
        </div>
    </div>

    <div class="stat-box" data-barang="besi">
        <div class="stat-title">Total Barang</div>
        <div class="stat-content">
            <div>
                Besi
                <small>07/04/2026</small>
            </div>
            <h2>30</h2>
        </div>
    </div>

    <div class="stat-box" data-barang="botol_kaca">
        <div class="stat-title">Total Barang</div>
        <div class="stat-content">
            <div>
                Botol Kaca
                <small>08/04/2026</small>
            </div>
            <h2>50</h2>
        </div>
    </div>
</div>

<!-- CHART MASUK -->
<div class="card">
    <div class="chart-header">
        <span id="titleMasuk">Barang Masuk</span>
        <span>5/04/2026 - 11/04/2026</span>
    </div>

    <div class="chart">
        <canvas id="chartMasuk"></canvas>
    </div>
</div>

<!-- CHART KELUAR -->
<div class="card">
    <div class="chart-header">
        <span id="titleKeluar">Barang Keluar</span>
        <span>5/04/2026 - 11/04/2026</span>
    </div>

    <div class="chart">
        <canvas id="chartKeluar"></canvas>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const labels = ['5', '6', '7', '8', '9', '10', '11'];

// DATA PER BARANG + TOTAL
const dataBarang = {
    semua: {
        nama: "Semua Barang",
        masuk: [52, 63, 54, 82, 62, 69, 74], // total gabungan
        keluar: [33, 46, 42, 63, 42, 53, 51]
    },
    besi_tua: {
        nama: "Besi Tua",
        masuk: [12, 19, 10, 25, 15, 20, 18],
        keluar: [8, 15, 12, 20, 10, 17, 14]
    },
    kardus: {
        nama: "Kardus",
        masuk: [5, 10, 8, 12, 7, 9, 11],
        keluar: [3, 8, 6, 10, 5, 7, 9]
    },
    besi: {
        nama: "Besi",
        masuk: [15, 12, 18, 20, 17, 16, 19],
        keluar: [10, 9, 14, 15, 12, 13, 11]
    },
    botol_kaca: {
        nama: "Botol Kaca",
        masuk: [20, 22, 18, 25, 23, 24, 26],
        keluar: [12, 14, 10, 18, 15, 16, 17]
    }
};

// DEFAULT = SEMUA
let currentBarang = 'semua';

// INIT CHART (pakai SEMUA)
const chartMasuk = new Chart(document.getElementById('chartMasuk'), {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Barang Masuk (Kg)',
            data: dataBarang.semua.masuk,
            borderColor: '#3E7B27',
            backgroundColor: 'rgba(62,123,39,0.2)',
            tension: 0.4,
            fill: true
        }]
    }
});

const chartKeluar = new Chart(document.getElementById('chartKeluar'), {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Barang Keluar (Kg)',
            data: dataBarang.semua.keluar,
            borderColor: '#8DB255',
            backgroundColor: 'rgba(141,178,85,0.2)',
            tension: 0.4,
            fill: true
        }]
    }
});

// SET TITLE AWAL
document.getElementById('titleMasuk').innerText = "Barang Masuk - Semua Barang";
document.getElementById('titleKeluar').innerText = "Barang Keluar - Semua Barang";

// CLICK EVENT
document.querySelectorAll('.stat-box').forEach(card => {
    card.addEventListener('click', function () {

        document.querySelectorAll('.stat-box').forEach(c => c.classList.remove('active'));
        this.classList.add('active');

        const barang = this.getAttribute('data-barang');

        // UPDATE CHART
        chartMasuk.data.datasets[0].data = dataBarang[barang].masuk;
        chartMasuk.update();

        chartKeluar.data.datasets[0].data = dataBarang[barang].keluar;
        chartKeluar.update();

        // UPDATE TITLE
        document.getElementById('titleMasuk').innerText = "Barang Masuk - " + dataBarang[barang].nama;
        document.getElementById('titleKeluar').innerText = "Barang Keluar - " + dataBarang[barang].nama;
    });
});
</script>
@endsection