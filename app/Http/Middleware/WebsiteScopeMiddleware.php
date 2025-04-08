<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteScopeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Ambil domain dari URL yang diakses
        $domain = $request->getHost();  // Misalnya: user1.test, user2.test, atau belajarsatupersen.test

        // Jika domain adalah website utama, langsung set website_id untuk domain utama
        if ($domain === 'belajarsatupersen.test') {
            $website = Website::where('domain', 'belajarsatupersen.test')->first();

            // Pastikan website utama ditemukan
            if ($website) {
                session(['website_id' => $website->id]);
            } else {
                abort(403, 'Website utama tidak ditemukan');
            }
        } else {
            // Cari website berdasarkan domain lainnya (user1.test, user2.test, dll.)
            $website = Website::where('domain', $domain)->first();

            // Jika website ditemukan, simpan website_id di session
            if ($website) {
                session(['website_id' => $website->id]);
            } else {
                // Jika website tidak ditemukan, kirim error 403
                abort(403, 'Website tidak ditemukan');
            }
        }

        return $next($request);
    }
}
