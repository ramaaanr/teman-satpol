<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
  // Konstruktor ini akan memastikan bahwa halaman hanya bisa diakses oleh pengguna yang sudah login
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    // Tampilkan halaman dashboard
    return view('dashboard');
  }
}