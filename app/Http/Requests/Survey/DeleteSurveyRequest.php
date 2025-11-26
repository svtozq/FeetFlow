<?php

namespace App\Http\Requests\Survey;

use Illuminate\Foundation\Http\FormRequest;

class DeleteSurveyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('delete', $this->survey);
    }

    public function rules(): array
    {
        return [];
    }
}
