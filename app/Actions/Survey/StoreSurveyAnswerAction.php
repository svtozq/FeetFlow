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

                $answer = $answerData['answer'];

                if (is_array($answer)) {
                    $answer = array_values(array_filter(array_map('trim', $answer)));
                    $answer = json_encode($answer);
                }

                $created[] = SurveyAnswer::create([
                    'survey_id'          => $dto->survey->id,
                    'survey_question_id' => $answerData['survey_question_id'],
                    'user_id'            => $dto->respondent?->id,
                    'answer'             => $answer,
                ]);
            }

            $lastAnswer = end($created);

            // call event SurveyAnswerSubmitted
            event(new SurveyAnswerSubmitted($dto->survey, $created, $dto->respondent,$lastAnswer));


            return $created;
        });
    }
}
