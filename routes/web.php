<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

// Rute untuk halaman login
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Mengelompokkan rute yang menggunakan middleware 'auth'
Route::middleware('auth')->group(function () {

    // Rute untuk dashboard
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    // Rute untuk data kegiatan
    Route::get('/data-giat', function () {
        return view('data-giat.index');
    })->name('data-giat');

    Route::get('/data-giat/{id}', function () {
        return view('data-giat.detail');
    })->name('detail-data-giat');

    Route::get('/data-giat/edit/{id}', function () {
        return view('data-giat.edit');
    })->name('edit-data-giat');

    // Rute untuk kegiatan
    Route::get('/kegiatan', function () {
        return view('kegiatan.index');
    })->name('kegiatan');

    Route::get('/kegiatan/edit/{id}', function () {
        return view('kegiatan.edit');
    })->name('edit-kegiatan');

    // Rute untuk tambah kegiatan
    Route::get('/tambah-giat', function () {
        return view('tambah-giat.index');
    })->name('tambah-giat');

    // Rute untuk review kegiatan
    Route::get('/review-kegiatan', function () {
        return view('review-kegiatan.index');
    })->name('review-kegiatan');

    Route::get('/review-kegiatan/detail/{id}', function () {
        return view('review-kegiatan.detail');
    })->name('detail-review-kegiatan');

    Route::get('/review-kegiatan/detail/{id_giat}/{id_penugasan}', function () {
        return view('review-kegiatan.detail-penugasan');
    })->name('detail-review-kegiatan');
});