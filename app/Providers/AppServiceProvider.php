<?php

namespace App\Providers;

use App\Models\Website;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        if (app()->runningInConsole()) return;

        $currentDomain = request()->getHost();
        $website = Website::where('domain', $currentDomain)->first();

        if ($website) {
            session(['website_id' => $website->id]);

            if (!$website->is_active) {
                abort(403, 'Website sedang dinonaktifkan oleh administrator.');
            }
        } else {
            // Optional: jika domain tidak dikenal
            abort(404, 'Website tidak ditemukan.');
        }
    }
}
