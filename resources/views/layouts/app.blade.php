<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>@yield('title')</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

/* NAVBAR */
.navbar {
    height: 60px;
    background: #3E7B27;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 25px;
    font-weight: 600;
}

.btn-logout {
    background: white;
    color: #3E7B27;
    padding: 6px 12px; 
    border-radius: 5px;
    font-size: 13px;
    text-decoration: none;
}

/* LAYOUT */
.container {
    display: flex;
}

/* SIDEBAR */
.sidebar {
    width: 260px;
    min-width: 260px;
    height: calc(100vh - 60px);
    background: #f7f7f7;
    padding: 20px;
}

.sidebar h4 {
    margin: 15px 0 10px;
    font-size: 14px;
    color: #555;
}

.menu-item {
    display: flex;
    align-items: center;
    padding: 10px 12px;
    border-radius: 8px;
    text-decoration: none;
    color: #333;
    margin-bottom: 6px;
}

.menu-item i {
    margin-right: 10px;
}

.menu-item.active {
    background: #8DB255;
    color: white;
}

/* MAIN */
.main {
    flex: 1;
    padding: 25px;
    background: #eee;
}
</style>

@yield('styles') <!-- ⬅️ penting buat CSS per halaman -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@yield('scripts')

</head>

<body>

<div class="navbar">
    <div>LANGGENG JAYA</div>
    <a href="/" class="btn-logout">
        <i class="fa-solid fa-right-from-bracket"></i> Logout
    </a>
</div>

<div class="container">

    <div class="sidebar">
        <a href="/dashboard" class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-line"></i> Dashboard
        </a>

        <h4>Input</h4>
        <a href="/barang-masuk" class="menu-item {{ request()->is('barang-masuk') ? 'active' : '' }}">
            <i class="fa-solid fa-arrow-down"></i> Barang Masuk
        </a>

        <a href="/barang-keluar" class="menu-item {{ request()->is('barang-keluar') ? 'active' : '' }}">
            <i class="fa-solid fa-arrow-up"></i> Barang Keluar
        </a>

        <a href="/kategori-barang" class="menu-item {{ request()->is('kategori-barang') ? 'active' : '' }}">
            <i class="fa-solid fa-layer-group"></i> Kategori Barang
        </a>

        <h4>Data</h4>
        <a href="/data-masuk" class="menu-item {{ request()->is('data-masuk') ? 'active' : '' }}">
            <i class="fa-solid fa-database"></i> Data Masuk
        </a>

        <a href="/data-keluar" class="menu-item {{ request()->is('data-keluar') ? 'active' : '' }}">
            <i class="fa-solid fa-database"></i> Data Keluar
        </a>
    </div>

    <div class="main">
        @yield('content')
    </div>

</div>

</body>
</html>