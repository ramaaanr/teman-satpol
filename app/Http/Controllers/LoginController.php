<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function showLoginForm()
  {
    return view('auth.login');
  }

  public function login(Request $request)
  {
    // Validasi kredensial
    $request->validate([
      'NIP' => 'required',
      'password' => 'required',
    ]);

    // Melakukan login menggunakan Laravel Authentication
    if (Auth::attempt(['NIP' => $request->NIP, 'password' => $request->password])) {
      return redirect()->intended('/dashboard'); // Arahkan ke dashboard setelah login berhasil
    }

    return back()->withErrors([
      'message' => 'NIP atau Password Salah!',
    ]);
  }

  public function logout()
  {
    Auth::logout();
    return redirect('/login');
  }
}