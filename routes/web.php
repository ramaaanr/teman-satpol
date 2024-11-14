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
Route::middleware('auth')->get('/data-giat/1', function () {
    return view('data-giat.detail');
})->name('detail-data-giat');
Route::middleware('auth')->get('/tambah-giat', function () {
    return view('tambah-giat.index');
})->name('tambah-giat');