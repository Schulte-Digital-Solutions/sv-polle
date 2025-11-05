<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

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
        // Force HTTPS in production
        if ($this->app->environment('production', 'coming_soon')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // CSRF-Token für Inertia-Shared-Props hinzufügen
        Inertia::share([
            'csrfToken' => csrf_token(),
        ]);
    }
}
