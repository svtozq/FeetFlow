<?php

namespace App\Providers;

use App\Events\SurveyAnswerSubmitted;
use App\Listeners\SendNewAnswerNotification;
use App\Listeners\SendFinalReportOnClose;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $listen = [
        SurveyAnswerSubmitted::class => [
            SendNewAnswerNotification::class,
        ],
    ];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            SurveyAnswerSubmitted::class,
            SendNewAnswerNotification::class
        );
    }
}
