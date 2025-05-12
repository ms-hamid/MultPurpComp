<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
    public function boot(): void
    {
        //
        Gate::before(function ($user, $ability) {
            // Check if the user is a super admin
            // and grant them all permissions
            // You can customize this logic based on your user model
            // For example, if you have a 'role' attribute:
            // if ($user->role === 'super_admin') {
            //     return true;
            // }
            if ($user->hasRole('super_admin')) {
                return true;
            }
        });
    }
}
