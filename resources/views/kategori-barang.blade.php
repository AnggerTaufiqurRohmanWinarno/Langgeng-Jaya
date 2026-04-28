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

.action-buttons {
    display: flex;
    gap: 10px; /* jarak antar tombol */
    align-items: center;
}

.action-buttons form {
    margin: 0; /* biar tidak turun */
}

.action-buttons a {
    text-decoration: none; /* hilangkan garis bawah */
}

.action-buttons a:hover {
    text-decoration: none; /* tetap hilang saat hover */
}

</style>

@endsection

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<div class="container">
    <div class="main">
        <h2>Kategori Barang</h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

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

        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_kategori }}</td>
                            <td>
                               <div class="action-buttons">
                                    <a href="{{ route('kategori-barang.show', $item->id) }}" class="btn-submit" style="background: #3E7B27;">
                                        <i class="fa-solid fa-eye"></i> Edit
                                    </a>

                                    <form action="{{ route('kategori-barang.destroy', $item->id) }}" method="POST" class="form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-submit btn-delete" style="background: #d33;">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
</div>

<script>
document.getElementById('formKategori').addEventListener('submit', function(e) {
    e.preventDefault(); 

    Swal.fire({
        title: 'Simpan Kategori Barang?',
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


document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();

        const form = this.closest('form');

        Swal.fire({
            title: 'Yakin mau hapus?',
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>

@endsection