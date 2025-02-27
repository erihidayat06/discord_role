<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect('/');
        }

        $user = Auth::user();

        // Jika user bukan admin dan expired kosong atau sudah lewat, redirect ke /
        if (!$user->is_admin && (!$user->expired || Carbon::parse($user->expired)->isPast())) {
            return redirect('/');
        }

        // Jika user admin atau belum expired, lanjutkan ke halaman kursus
        return $next($request);
    }
}
