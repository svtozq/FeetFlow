<?php

namespace App\Listeners;

use App\Mail\DailyAnswerMail;
use App\Mail\SurveySubmittedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendDailyReport implements ShouldQueue
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
    public function handle(object $event): void
    {

        // celui qui crée le sondage

        $surveyCreator = $event->survey->surveyCreator;

        Mail::to($surveyCreator->email)->send(new DailyAnswerMail($event->dailyAnswer));
    }
}
