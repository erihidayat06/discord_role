<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('admin-khusus', function (User $user) {
            return $user->email === 'erihidayat17@gmail.com' || $user->email === 'erihidayat549@gmail.com';
        });
        Gate::define('super_admin', function (User $user) {
            return $user->is_admin === "3";
        });
    }
}
