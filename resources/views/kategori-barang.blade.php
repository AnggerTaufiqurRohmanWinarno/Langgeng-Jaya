@extends('layouts.app')

@section('title', 'Input Kategori Barang')

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

input {
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

input:focus {
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

</style>

@endsection

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<div class="container">
    <div class="main">
        <h2>Kategori Barang</h2>

        <div class="card">
            <form id="formKategori"  action="{{ route('kategori-barang.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_kategori" placeholder="Contoh: Besi Tua" required>
                </div>

                <button type="submit" class="btn-submit" >
                    <i class="fa-solid fa-save"></i> Simpan
                </button>
            </form>
        </div>
        
    </div>
</div>

<script>
document.getElementById('formKategori').addEventListener('submit', function(e) {
    e.preventDefault(); 

    Swal.fire({
        title: 'Simpan Kategori?',
        text: "Nama barang akan ditambahkan!",
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