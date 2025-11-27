<?php

namespace App\DTOs;

use App\Models\Survey;
use App\Models\User;
use Illuminate\Http\Request;

final class SurveyAnswerDTO
{
    private function __construct(
        public readonly Survey $survey,
        /** @var array<int, array{survey_question_id:int, answer:mixed}> */
        public readonly array $answers,
        public readonly ?int $user_id,
    ) {}

    public static function fromRequest(Request $request, Survey $survey, ?int $user_id): self
    {
        // answers[0][survey_question_id], answers[0][answer], ...
        $answers = $request->input('answers', []);

        return new self(
            survey: $survey,
            answers: $answers,
            user_id: $user_id,
        );
    }
}
