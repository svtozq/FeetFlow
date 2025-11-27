<?php

namespace App\Http\Requests\Survey;

use Illuminate\Foundation\Http\FormRequest;

class StoreSurveyAnswerRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'answers'                       => ['required', 'array', 'min:1'],
            'answers.*.survey_question_id'  => ['required', 'integer', 'exists:survey_questions,id'],
            'answers.*.answer'              => ['required'],
        ];
    }
}
