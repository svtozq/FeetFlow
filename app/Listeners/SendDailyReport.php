<?php

namespace App\Listeners;

use App\Mail\DailyAnswerMail;
use App\Mail\SurveySubmittedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Events\DailyAnswersThresholdReached;



class SendDailyReport implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {

        // celui qui crée le sondage

        $surveyCreator = $event->survey->user;



        Mail::to($surveyCreator->email)->send(new DailyAnswerMail($event->survey,$event->answers));
    }
}
