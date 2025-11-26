<?php

namespace App\Http\Requests\Survey;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSurveyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->survey);
    }

    public function rules(): array
    {
        return [
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'start_date'   => 'required|date|before_or_equal:end_date',
            'end_date'     => 'required|date|after_or_equal:start_date',
            'is_anonymous' => 'nullable|boolean',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'is_anonymous' => $this->has('is_anonymous') ? (bool)$this->input('is_anonymous') : 0,
        ]);
    }
}
