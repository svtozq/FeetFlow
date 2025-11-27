<?php

namespace App\Console\Commands;

use App\Events\DailyAnswersThresholdReached;
use App\Models\Survey;
use Illuminate\Console\Command;

class SendSurveyDailyReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-survey-daily-reports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envoie un rapport par mail du sondage qui a recu plus de 10 reponse';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $this->info('Function called');
        $yesterday = now()->subDay()->toDateString();  //hier

        // recuperer tout les sondages encore ligne
        $surveys = Survey::all();

        foreach ($surveys as $survey) {

            // recuperation des réponses d'hier
            $yesterdayAnswers = $survey->answers()
                ->whereDate('created_at', $yesterday)
                ->get();

            $countYesterdayAnswers = $yesterdayAnswers->count();

            // si seuil  >10 :
            if ($countYesterdayAnswers >= 10) {



                event(new DailyAnswersThresholdReached($survey, $yesterdayAnswers));

            } else {
                $this->line("Sondage #{$survey->id} : seulement {$countYesterdayAnswers} réponses → pas de rapport.");
            }
        }

    }
}
