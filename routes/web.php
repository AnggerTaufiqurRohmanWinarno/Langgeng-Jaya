<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/barang-masuk', function () {
    return view('barang-masuk');
});

Route::get('/barang-keluar', function () {
    return view('barang-keluar');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/data-masuk', function () {
    return view('data-masuk');
});

Route::get('/data-keluar', function () {
    return view('data-keluar');
});

Route::get('/kategori-barang', function () {
    return view('kategori-barang');
});