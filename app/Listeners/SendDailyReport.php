<?php

namespace App\Listeners;

use App\Mail\DailyAnswerMail;
use App\Mail\SurveySubmittedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Events\DailyAnswersThresholdReached;






class SendDailyReport
{


    /**
     * Fonction declenché automatiquement lors de l'appel
     */
    public function handle(DailyAnswersThresholdReached $event): void
    {
        // celui qui crée le sondage
        $surveyCreator = $event->survey->user;

        //envoie du mail (sans Queue)
        Mail::to($surveyCreator->email)->send(new DailyAnswerMail($event->survey,$event->answers));
    }
}
