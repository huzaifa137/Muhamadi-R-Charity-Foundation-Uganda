<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Keep private production backups on a daily schedule; configure the host scheduler to run `php artisan schedule:run` every minute.
Schedule::command('foundation:backup --keep=14')
    ->dailyAt('02:00')
    ->withoutOverlapping()
    ->when(fn () => app()->environment('production'));
