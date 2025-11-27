<?php

namespace App\Listeners;

use App\Events\SurveyAnswerSubmitted;
use App\Http\Controllers\SurveyController;
use App\Mail\SurveySubmittedMail;
use App\Models\SurveyAnswer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewAnswerNotification
{



    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }


    /**
     * Fonction declenché lors de la soumission des reponses
     */
    public function handle(SurveyAnswerSubmitted $event): void
    {

        //l'utilisateur proprietaire du sondage
        $surveyOwner = $event->survey->user;

        //envoie de l'email au proprietaire
        Mail::to($surveyOwner->email)->send(new SurveySubmittedMail($event->survey,$event->respondent,$event->answers));
    }
}
