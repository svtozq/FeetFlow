<?php

namespace App\Http\Requests\Survey;

use Illuminate\Foundation\Http\FormRequest;

class StoreSurveyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_anonymous' => 'nullable|boolean',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'is_anonymous' => $this->has('is_anonymous') ? 1 : 0,
        ]);
    }
}
