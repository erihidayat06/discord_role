<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PreventIfActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user tidak login, lanjutkan request tanpa perubahan
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();

        // Jika expired masih aktif, alihkan ke /kursus
        if ($user->expired && Carbon::parse($user->expired)->isFuture()) {
            return redirect('/kursus');
        }

        return $next($request);
    }
}
