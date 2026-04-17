<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('loginFunction');

Route::middleware('auth')->group(function () {

    Route::get('/barang-masuk', [App\Http\Controllers\BarangMasuk::class, 'index'])->name('barang-masuk.index');
    Route::post('/barang-masuk-store', [App\Http\Controllers\BarangMasuk::class, 'store'])->name('barang-masuk.store');

    Route::get('/barang-keluar', [App\Http\Controllers\BarangKeluar::class, 'index'])->name('barang-keluar.index');
    Route::post('/barang-keluar-store', [App\Http\Controllers\BarangKeluar::class, 'store'])->name('barang-keluar.store');


    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::get('/data-masuk', function () {
        return view('data-masuk');
    });

    Route::get('/data-masuk', [App\Http\Controllers\BarangMasuk::class, 'show'])->name('data-masuk.show');
    Route::get('/data-keluar', [App\Http\Controllers\BarangKeluar::class, 'show'])->name('data-keluar.show');

    
    Route::get('/kategori-barang', [App\Http\Controllers\KategoriBarangController::class, 'index'])->name('kategori-barang.index');
    Route::post('/kategori-barang', [App\Http\Controllers\KategoriBarangController::class, 'store'])->name('kategori-barang.store');

    Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
});