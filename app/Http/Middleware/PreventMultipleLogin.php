<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PreventMultipleLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $currentSessionId = session()->getId();

            // Jika session berbeda, logout otomatis
            if ($user->session_id && $user->session_id !== $currentSessionId) {
                Auth::logout();
                return redirect('/')->with('error', 'Akun ini digunakan di perangkat lain.');
            }
        }

        return $next($request);
    }
}
