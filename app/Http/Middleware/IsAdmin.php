<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna sudah login dan is_admin = 1
        if (Auth::check() && Auth::user()->is_admin || Auth::check() && Auth::user()->is_admin === "3") {
            return $next($request);
        }

        // Redirect ke halaman utama jika bukan admin
        return redirect('/');
    }
}
