<?php

namespace App\Actions\Survey;

use App\DTOs\SurveyAnswerDTO;
use App\Events\SurveyAnswerSubmitted;
use App\Models\SurveyAnswer;
use Illuminate\Support\Facades\DB;

final class StoreSurveyAnswerAction
{
    public function __construct() {}

    /**
     * @return array<int, \App\Models\SurveyAnswer>
     */
    public function handle(SurveyAnswerDTO $dto): array
    {
        return DB::transaction(function () use ($dto) {
            $created = [];

            foreach ($dto->answers as $answerData) {
                if (! isset($answerData['survey_question_id'], $answerData['answer'])) {
                    continue;
                }

                $created[] = SurveyAnswer::create([
                    'survey_id'          => $dto->survey->id,
                    'survey_question_id' => $answerData['survey_question_id'],
                    'user_id'            => $dto->respondent?->id,
                    'answer'             => $answerData['answer'],
                ]);
            }

            // Story 5 : on déclenche l’évènement
            event(new SurveyAnswerSubmitted($dto->survey, $created, $dto->respondent));

            return $created;
        });
    }
}
