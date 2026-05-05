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
        <h2>Edit Kategori Barang</h2>

        <div class="card">
            <form id="formEditKategori" action="{{ route('kategori-barang.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}" placeholder="Masukkan nama kategori" required>
                </div>
                
                <div class="form-group">
                    <label>Deskripsi Kategori</label>
                    <input type="text" name="deskripsi" value="{{ $kategori->deskripsi }}" placeholder="Masukkan deskripsi kategori" required>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-save"></i> Simpan
                </button>
            </form>
        </div>
        
    </div>
</div>

<script>
document.getElementById('formEditKategori').addEventListener('submit', function(e) {
    e.preventDefault(); 

    Swal.fire({
        title: 'Apakah Anda yakin?',
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