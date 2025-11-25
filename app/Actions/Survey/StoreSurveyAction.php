<?php

namespace App\Actions\Survey;

use App\DTOs\SurveyDTO;
use App\Models\Survey;

class StoreSurveyAction
{
    public function execute(SurveyDTO $dto): Survey
    {
        return Survey::create([
            'organization_id' => $dto->organization_id,
            'user_id' => $dto->user_id,
            'title' => $dto->title,
            'description' => $dto->description,
            'start_date' => $dto->start_date,
            'end_date' => $dto->end_date,
            'is_anonymous' => $dto->is_anonymous,
        ]);
    }
}
