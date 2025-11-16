<?php

use Illuminate\Support\Facades\Route;

// Halaman utama Laravel
Route::get('/', function () {
    return view('welcome');
});

// Route Admin Dashboard
Route::get('/admin', function () {
    return view('admin.dashboard');
});
