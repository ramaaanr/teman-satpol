<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Rute web dengan middleware auth
Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');
Route::middleware('auth')->get('/data-giat', function () {
    return view('data-giat.index');
})->name('data-giat');
Route::middleware('auth')->get('/kegiatan', function () {
    return view('kegiatan.index');
})->name('kegiatan');
Route::middleware('auth')->get('/kegiatan/edit/{id}', function () {
    return view('kegiatan.edit');
})->name('edit-kegiatan');
Route::middleware('auth')->get('/data-giat/{id}', function () {
    return view('data-giat.detail');
})->name('detail-data-giat');
Route::middleware('auth')->get('/data-giat/edit/{id}', function () {
    return view('data-giat.edit');
})->name('edit-data-giat');
Route::middleware('auth')->get('/tambah-giat', function () {
    return view('tambah-giat.index');
})->name('tambah-giat');
Route::middleware('auth')->get('/review-kegiatan', function () {
    return view('review-kegiatan.index');
})->name('review-kegiatan');
Route::middleware('auth')->get('/review-kegiatan/detail/{id}', function () {
    return view('review-kegiatan.detail');
})->name('detail-review-kegiatan');
Route::middleware('auth')->get('/review-kegiatan/detail/{id_giat}/{id_penugasan}', function () {
    return view('review-kegiatan.detail');
})->name('detail-review-kegiatan');