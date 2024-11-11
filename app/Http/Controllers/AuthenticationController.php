<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function login (Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau Password Salah!'],
            ]);
        }

        return $user->createToken('Login User')->plainTextToken;
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return("Token has been revoke");
    }

    public function detailUser(Request $request){
        return response()->json(Auth::user()); //mengeluarkan semua detail
    }
}
