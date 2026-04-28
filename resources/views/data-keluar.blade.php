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
                    @foreach ($barangKeluar as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tanggal_keluar }}</td>
                            <td>{{ $item->nama_kategori }}</td>
                            <td>{{ $item->berat }} Kg</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection