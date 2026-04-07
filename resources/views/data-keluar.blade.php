@extends('layouts.app')

@section('title', 'Data Barang Keluar')

@section('styles')
<style>

/* CARD */
.card {
    margin-top: 20px;
    background: white;
    border-radius: 10px;
    padding: 20px;
}

/* TABLE */
.table {
    width: 100%;
    border-collapse: collapse;
}

.table thead {
    background: #3E7B27;
    color: white;
}

.table th, .table td {
    padding: 12px;
    text-align: center;
    border: 1px solid #ddd;
}

.table tbody tr:nth-child(even) {
    background: #f9f9f9;
}

.table tbody tr:hover {
    background: #f1f1f1;
}

.table tbody tr {
    transition: 0.2s;
}

.table tbody tr:hover {
    transform: scale(1.01);
    background: #f1f1f1;
}

</style>
@endsection

@section('content')

<div class="container">
    <div class="main">
        <h2>Data Barang Keluar</h2>

        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Berat (Kg)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>01-04-2026</td>
                        <td>Besi Tua</td>
                        <td>120 Kg</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>02-04-2026</td>
                        <td>Kardus</td>
                        <td>80 Kg</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>03-04-2026</td>
                        <td>Botol Kaca</td>
                        <td>45 Kg</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>04-04-2026</td>
                        <td>Plastik</td>
                        <td>60 Kg</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection