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
Route::middleware('auth')->get('/kegiatan/{id}', function () {
    return view('kegiatan.detail');
})->name('detail-kegiatan');
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
Route::middleware('auth')->get('/review-kegiatan/1', function () {
    return view('review-kegiatan.detail');
})->name('detail-review-kegiatan');