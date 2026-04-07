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
}

</style>
@endsection

@section('content')

@section('scripts')
<script>
const labels = ['5', '6', '7', '8', '9', '10', '11'];

// CHART MASUK
new Chart(document.getElementById('chartMasuk'), {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Barang Masuk',
            data: [12, 19, 10, 25, 15, 20, 18],
            borderColor: '#3E7B27',
            backgroundColor: 'rgba(62,123,39,0.2)',
            tension: 0.4,
            fill: true
        }]
    }
});

// CHART KELUAR
new Chart(document.getElementById('chartKeluar'), {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Barang Keluar',
            data: [8, 15, 12, 20, 10, 17, 14],
            borderColor: '#8DB255',
            backgroundColor: 'rgba(141,178,85,0.2)',
            tension: 0.4,
            fill: true
        }]
    }
});
</script>
@endsection

<h2>Dashboard</h2>

<div class="card notif">
    <i class="fa-regular fa-bell"></i>
    <div>
        <div><b>Barang yang Direkomendasikan</b></div>
        <div style="font-size:13px;color:#888;">Besi Tua</div>
    </div>
</div>

 <div class="stats">
            <div class="stat-box">
                <div class="stat-title">Total Barang</div>
                <div class="stat-content">
                    <div>
                        Besi Tua
                        <small>05/04/2026</small>
                    </div>
                    <h2>40</h2>
                </div>
            </div>

            <div class="stat-box">
                <div class="stat-title">Total Barang</div>
                <div class="stat-content">
                    <div>
                        Kardus
                        <small>06/04/2026</small>
                    </div>
                    <h2>20</h2>
                </div>
            </div>

            <div class="stat-box">
                <div class="stat-title">Total Barang</div>
                <div class="stat-content">
                    <div>
                        Besi
                        <small>07/04/2026</small>
                    </div>
                    <h2>30</h2>
                </div>
            </div>

            <div class="stat-box">
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
        <span>Barang Masuk</span>
        <span>5/04/2026 - 11/04/2026</span>
    </div>

    <div class="chart">
        <canvas id="chartMasuk"></canvas>
    </div>
</div>

<!-- CHART KELUAR -->
<div class="card">
    <div class="chart-header">
        <span>Barang Keluar</span>
        <span>5/04/2026 - 11/04/2026</span>
    </div>

    <div class="chart">
        <canvas id="chartKeluar"></canvas>
    </div>
</div>
@endsection