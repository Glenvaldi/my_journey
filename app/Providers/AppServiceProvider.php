<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL; // <-- Tambahin ini di paling atas
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void { }

    public function boot(): void
    {
        // Paksa semua link jadi HTTPS kalau di server Railway
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }
    }
}