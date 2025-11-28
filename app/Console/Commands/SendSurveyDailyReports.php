<?php

namespace App\Console\Commands;

use App\Events\DailyAnswersThresholdReached;
use App\Models\Survey;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Event;

class SendSurveyDailyReports extends Command
{
    protected $signature = 'app:send-survey-daily-reports';         //pour appeler

    protected $description = 'Envoie un rapport par mail du sondage qui a recu plus de 10 reponses dans les dernières 24h';

    /*
     * Fontion pour calculer la recuperation des informations
     * elle s'execute lorsqu'on l'appelle
     */
    public function handle()
    {
        $now = now();       //actuellement
        $from = $now->copy()->subDay(); // dernières 24h

        $surveys = Survey::all();       //recuperer tout les sondage

        foreach ($surveys as $survey) {

            $answers = $survey->answers()
                //entre maintenant et les dernière 24h
                ->whereBetween('created_at', [$from, $now])
                ->get();

            $count = $answers->count(); //on compte

            if ($count >= 10) {
                Event::dispatch(new DailyAnswersThresholdReached($survey, $answers));

            } else {
                $this->line("Sondage #{$survey->id} : seulement $count réponses → pas de rapport.");
            }
        }


    }
}
