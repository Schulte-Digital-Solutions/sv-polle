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
        // CSRF-Token für Inertia-Shared-Props hinzufügen
        Inertia::share([
            'csrfToken' => csrf_token(),
        ]);
    }
}
