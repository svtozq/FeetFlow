<?php
namespace App\Actions\Survey;

use App\Events\SurveyClosed;
use App\Models\Survey;
use Illuminate\Support\Facades\DB;

final class CloseSurveyAction
{
    public function execute(Survey $survey): Survey
    {
        $survey->refresh();

        return $survey;
    }
}
