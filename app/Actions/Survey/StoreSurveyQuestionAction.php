<?php
namespace App\Actions\Survey;

use App\DTOs\SurveyDTO;
use App\Models\Survey;
use App\Models\SurveyQuestion;
use Illuminate\Support\Facades\DB;

final class StoreSurveyQuestionAction
{
    public function __construct() {}

    /**
     * Store a Survey
     * @param SurveyDTO $dto
     * @return array
     */
    public function execute(array $data, int $survey_id): SurveyQuestion
    {
        return DB::transaction(function () use ($data, $survey_id) {
            $options = in_array($data['question_type'], ['radio', 'checkbox'])
                ? json_encode($data['options'] ?? [])
                : null;

            return SurveyQuestion::create([
                'survey_id' => $survey_id,
                'title' => $data['title'],
                'question_type' => $data['question_type'],
                'data' => $options,
            ]);
        });
    }
}
