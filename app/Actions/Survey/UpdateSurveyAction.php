<?php

namespace App\Actions\Survey;

use App\DTOs\SurveyDTO;
use App\Models\Survey;

class UpdateSurveyAction
{
    public function execute(Survey $survey, SurveyDTO $dto): Survey
    {
        $survey->update([
            'title' => $dto->title,
            'description' => $dto->description,
            'start_date' => $dto->start_date,
            'end_date' => $dto->end_date,
            'is_anonymous' => $dto->is_anonymous,
        ]);

        return $survey;
    }
}
