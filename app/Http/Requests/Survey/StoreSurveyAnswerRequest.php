<?php

namespace App\Http\Requests\Survey;

use Illuminate\Foundation\Http\FormRequest;

class StoreSurveyAnswerRequest extends FormRequest
{
    public function authorize(): bool
    {
        // anonyme ou connecté -> ok pour tout le monde
        return true;
    }

    public function rules(): array
    {
        return [
            'answers'                       => ['required', 'array', 'min:1'],
            'answers.*.survey_question_id'  => ['required', 'integer', 'exists:survey_questions,id'],
            'answers.*.answer'              => ['required'],
        ];
    }
}
