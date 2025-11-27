<?php

namespace App\Actions\Survey;

use App\DTOs\SurveyDTO;
use App\Models\Survey;
use Illuminate\Support\Facades\Auth;

class StoreSurveyAction
{
    public function execute(SurveyDTO $dto): Survey
    {
        return Survey::create([
            'title' => $dto->title,
            'description' => $dto->description,
            'token' => $dto->token,
            'start_date' => $dto->start_date,
            'end_date' => $dto->end_date,
            'organization_id' => $dto->organization_id,
            'is_anonymous' => $dto->is_anonymous,
            'user_id' => Auth::id(),
        ]);
    }
}
