<?php

namespace App\Console\Commands;

use App\Events\SurveyClosed;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use App\Models\Survey;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class CheckForSurveyToClose extends Command
{
    // Command name
    protected $signature = 'app:check-for-survey-to-close';

    // Command description
    protected $description = 'Check for survey end date';

    public function handle()
    {
        Log::info('CheckForSurveyToClose called at ' . now());

        $this->info('Check each survey end date..');
        // Get surveys reaching end date
        $surveys = Survey::whereDate('end_date', today())
                            ->where('closed', 0)
                            ->get();

        // Loop to set survey as 'closed'
        foreach ($surveys as $survey) {
            $survey->update(['closed' => 1]);

            Event::dispatch(new SurveyClosed($survey));

            Log::info("Survey #{$survey->id} closed at " . now());
            $this->info("The Survey #{$survey->id} entitled {$survey->title} expired, it just got closed on {$survey->end_date} !");
        }

        $this->info('All surveys got checked !');
        return 0;
    }
}
