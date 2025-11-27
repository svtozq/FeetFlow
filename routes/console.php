<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('app:send-survey-daily-reports', function () {})->purpose('Send daily survey report when more than 10 responses');

Schedule::command('app:send-survey-daily-reports')
    ->dailyAt('11:45');

Schedule::command('app:check-for-survey-to-close')
    ->dailyAt('10:08')
    ->withoutOverlapping();
