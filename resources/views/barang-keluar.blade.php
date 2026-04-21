@extends('layouts.app')

@section('title', 'Input Barang Masuk')

@section('styles')
<style>

/* CARD */
.card {
    margin-top: 20px;
    background: white;
    border-radius: 10px;
    padding: 20px;
    max-width: 500px;
}

/* FORM */
.form-group {
    margin-bottom: 15px;
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 5px;
    font-weight: 500;
}

input, select {
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

input:focus, select:focus {
    outline: none;
    border-color: #3E7B27;
}

/* BUTTON */
.btn-submit {
    background: #3E7B27;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.btn-submit:hover {
    background: #2f5f1d;
}

/* LOGOUT */
.btn-logout {
    background: white;
    color: #3E7B27;
    padding: 6px 12px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 13px;
}

</style>
@endsection  

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<div class="container">
    <div class="main">
        <h2>Input Barang Keluar</h2>

        <div class="card">
            <form id="formBarangKeluar" action="{{ route('barang-keluar.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal_keluar" required>
                </div>

                <div class="form-group">
                    <label>Nama Barang</label>
                    <select name="id_kategoriBarang" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach ($query as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Berat (Kg)</label>
                    <input type="number" name="berat" placeholder="Masukkan berat" required>
                </div>
                <div class="form-group">
                    <label>Bulan</label>
                    <input type="number" name="bulan" placeholder="Masukkan bulan" required>
                </div>
                <div class="form-group">
                    <label>Minggu</label>
                    <input type="number" name="minggu" placeholder="Masukkan minggu" required>
                </div>

                <button type="submit" class="btn-submit" onclick="confirmSubmit()">
                    <i class="fa-solid fa-save"></i> Simpan
                </button>
            </form>
        </div>
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>

<script>
document.getElementById('formBarangKeluar').addEventListener('submit', function(e) {
    e.preventDefault(); 

    Swal.fire({
        title: 'Simpan Barang Keluar?',
        text: "Pastikan data sudah benar ya!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3E7B27',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Simpan!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            e.target.submit();
        }
    });
});
</script>

@endsection