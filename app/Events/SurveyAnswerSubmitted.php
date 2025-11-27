<?php

namespace App\Events;

use App\Models\Survey;
use App\Models\SurveyAnswer;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class SurveyAnswerSubmitted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param array<int, SurveyAnswer> $answers
     */
    public function __construct(
        public readonly Survey $survey,
        public readonly array $answers,
        public readonly ?int $user_id,
    ) {}
}
