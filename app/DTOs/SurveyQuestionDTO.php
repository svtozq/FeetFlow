<?php

namespace App\DTOs;

class SurveyQuestionDTO
{
    public function __construct(
        public readonly int $survey_id,
        public readonly string $type,
        public readonly string $title,
        public readonly ?array $data = null
    ) {}

    public static function fromRequest($request, int $survey_id): self
    {
        return new self(
            survey_id: $survey_id,
            type: $request->type,
            title: $request->title,
            data: $request->data ?? null
        );
    }
}
