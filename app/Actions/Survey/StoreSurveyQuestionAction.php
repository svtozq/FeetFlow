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
            $options = null;

            if (in_array($data['question_type'], ['radio', 'checkbox'])) {

                if (!empty($data['options_text'])) {
                    $lines = preg_split('/\r\n|\r|\n/', $data['options_text']);
                    $cleaned = array_filter(array_map('trim', $lines));
                    $options = array_values($cleaned);
                } else {

                    $options = $data['options'] ?? [];
                }
            }

            return SurveyQuestion::create([
                'survey_id'     => $survey_id,
                'title'         => $data['title'],
                'question_type' => $data['question_type'],
                'options'       => $options,
            ]);
        });
    }
}
