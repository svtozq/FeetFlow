<?php

namespace App\Listeners;

use App\Events\SurveyClosed;
use App\Mail\SurveyClosedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendFinalReportOnClose
{
    use InteractsWithQueue;
    public function handle(SurveyClosed $event): void
    {
        Mail::to('test@feedflow.local')->send(
            new SurveyClosedMail($event->survey)
        );
    }
}
