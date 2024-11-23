<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role = null)
    {
        // Cek apakah pengguna sudah login dan memiliki role yang sesuai
        if (Auth::check() && ($role === null || Auth::user()->role === $role)) {
            return $next($request);
        }

        // Jika tidak, kembalikan ke halaman yang diinginkan (misalnya 403)
        return redirect('/unauthorized')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}