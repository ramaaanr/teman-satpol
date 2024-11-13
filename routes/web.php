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