<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Handle login dengan validasi Cloudflare CAPTCHA dan session ID
     */
    public function login(Request $request)
    {
        // Validasi input termasuk CAPTCHA
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'cf-turnstile-response' => 'required',
        ]);

        // Verifikasi CAPTCHA dengan Cloudflare
        $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => env('CLOUDFLARE_SECRET_KEY'),
            'response' => $request->input('cf-turnstile-response'),
            'remoteip' => $request->ip(),
        ]);

        $captchaData = $response->json();

        if (!$captchaData['success']) {
            return back()->withErrors(['cf-turnstile-response' => 'Verifikasi CAPTCHA gagal.']);
        }

        // Lanjutkan proses login
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            return $this->authenticated($request, Auth::user());
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    /**
     * Perbarui session_id untuk mencegah multi-login
     */
    protected function authenticated(Request $request, $user)
    {
        $sessionId = session()->getId();

        // Jika sudah login di perangkat lain, logout
        if ($user->session_id && $user->session_id !== $sessionId) {
            Auth::logout();
            return redirect('/')->with('error', 'Akun ini sedang digunakan di perangkat lain.');
        }

        // Simpan session ID di database dan cookie
        $user->update(['session_id' => $sessionId]);

        // Simpan di cookie selama 1 tahun
        Cookie::queue('user_session', $sessionId, 60 * 24 * 365);

        return redirect()->intended($this->redirectTo);
    }

    /**
     * Hapus session saat logout
     */
    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $user->update([
                'session_id' => null,
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
