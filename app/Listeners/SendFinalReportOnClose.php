<?php

namespace App\Listeners;

use App\Events\SurveyAnswerSubmitted;
use App\Http\Controllers\SurveyController;
use App\Mail\SurveySubmittedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendFinalReportOnClose implements ShouldQueue
{

    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SurveyAnswerSubmitted $event): void
    {
        Mail::to('test@example.com')->send(new SurveySubmittedMail($event->surveyAnswer));
    }
}
