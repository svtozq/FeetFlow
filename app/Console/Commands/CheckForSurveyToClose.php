<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use App\Models\Survey;
use Psy\Readline\Hoa\Event;

class CheckForSurveyToClose extends Command
{
    protected $signature = 'app:check-for-survey-to-close';

    protected $description = 'Check for survey end date';

    public function handle()
    {
        $this->info('Check each survey end date..');
        $surveys = Survey::whereDate('end_date', Carbon::today())
                            ->where('closed', 0)
                            ->get();

        foreach ($surveys as $survey) {
            $survey->update(['closed' => 1]);

            Event::dispatch()

            $this->info("The Survey #{$survey->id} entitled {$survey->title} expired, it just got closed on {$survey->end_date} !");
        }

        $this->info('All surveys got checked !');
        return 0;
    }
    public function schedule(Schedule $schedule)
    {
        $schedule->command('app:check-for-survey-to-close')->dailyAt('00:01');
    }
}
