<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreventMultipleLogin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $currentSessionId = session()->getId();

            // Jika session_id berbeda, berarti user login dari perangkat lain → Logout otomatis
            if ($user->session_id && $user->session_id !== $currentSessionId) {
                $user->update(['session_id' => null]);
                Auth::logout();
                session()->invalidate();
                session()->regenerateToken();

                return redirect('/login')->with('error', 'Akun ini telah login di perangkat lain.');
            }

            // **Setel last_activity jika belum ada (saat login pertama kali)**
            if (!$request->session()->has('last_activity')) {
                $request->session()->put('last_activity', now());
            } else {
                // **Cek apakah sesi sudah expired**
                $sessionLifetime = config('session.lifetime'); // Waktu sesi dalam menit
                $lastActivity = session('last_activity');
                $expiredTime = now()->subMinutes($sessionLifetime);

                if ($lastActivity < $expiredTime) {
                    $user->update(['session_id' => null]);
                    Auth::logout();
                    session()->invalidate();
                    return redirect('/login')->with('error', 'Sesi Anda telah habis.');
                }
            }

            // **Perbarui last_activity setiap request**
            $request->session()->put('last_activity', now());
        }

        return $next($request);
    }
}
