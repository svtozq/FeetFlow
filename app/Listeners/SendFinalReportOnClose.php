<?php

namespace App\Listeners;

use App\Events\SurveyClosed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendFinalReportOnClose
{
    /**
     * Handle the event.
     */
    public function handle(SurveyClosed $event): void
    {
        //

    }
}
