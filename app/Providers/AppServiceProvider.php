<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Paksa semua URL/Route menggunakan HTTPS jika di server Vercel atau Production
        if (request()->header('x-forwarded-proto') === 'https' || app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}