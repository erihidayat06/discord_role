<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

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

                // Hapus cookie saat user logout
                Cookie::queue(Cookie::forget('user_session'));

                return redirect('/login')->with('error', 'Akun ini telah login di perangkat lain.');
            }

            // **Perbarui last_activity setiap request**
            $request->session()->put('last_activity', now());
        } else {
            // **Jika user tidak login, cek apakah ada cookie "user_session"**
            $storedSessionId = Cookie::get('user_session');

            if ($storedSessionId) {
                // Cari user berdasarkan session_id
                $user = \App\Models\User::where('session_id', $storedSessionId)->first();

                if ($user) {
                    // Hapus session_id di database karena user tidak login
                    $user->update(['session_id' => null]);
                }

                // Hapus cookie karena sesi tidak valid lagi
                Cookie::queue(Cookie::forget('user_session'));
            }
        }

        return $next($request);
    }
}
