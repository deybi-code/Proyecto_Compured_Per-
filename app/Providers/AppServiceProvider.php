<?php

namespace App\Providers;

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
    public function boot(): void
    {
        use Illuminate\Support\Facades\URL;

public function boot(): void
{
    // Esto obliga a que toda URL generada sea https
    if ($this->app->environment('production')) {
        URL::forceScheme('https');
    }
}
    }
}
