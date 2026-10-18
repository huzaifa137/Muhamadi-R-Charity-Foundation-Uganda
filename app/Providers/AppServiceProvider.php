<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Throwable;

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
        if (app()->isProduction()) {
            if (str_starts_with((string) config('app.url'), 'https://')) {
                URL::forceScheme('https');
            }

            if (config('app.debug')) {
                Log::critical('APP_DEBUG is true in production. Set APP_DEBUG=false in .env and run php artisan config:clear.');
            }
        }

        if (app()->runningInConsole()) {
            return;
        }

        try {
            if (Schema::hasTable('foundation_settings')) {
                $timezone = DB::table('foundation_settings')->where('key', 'timezone')->value('value');
                if (is_string($timezone) && in_array($timezone, timezone_identifiers_list(), true)) {
                    config(['app.timezone' => $timezone]);
                    date_default_timezone_set($timezone);
                }
            }
        } catch (Throwable $exception) {
            // Keep the configured application timezone if settings are not available yet.
        }
    }
}
