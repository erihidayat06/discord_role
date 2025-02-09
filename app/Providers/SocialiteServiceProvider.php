<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use SocialiteProviders\Discord\Provider as DiscordProvider;

class SocialiteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register the Discord provider
        Socialite::extend('discord', function ($app) {
            $config = $app['config']['services.discord'];
            return new DiscordProvider(
                $app['request'],
                $config['client_id'],
                $config['client_secret'],
                $config['redirect']
            );
        });
    }
}
