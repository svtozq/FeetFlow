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
        public readonly ?User $respondent,
    ) {}

    public static function fromRequest(Request $request, Survey $survey, ?User $user): self
    {
        // answers[0][survey_question_id], answers[0][answer], ...
        $answers = $request->input('answers', []);

        return new self(
            survey: $survey,
            answers: $answers,
            respondent: $user,
        );
    }
}
