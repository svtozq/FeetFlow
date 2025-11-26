<?php

namespace App\Http\Requests\Survey;

use Illuminate\Foundation\Http\FormRequest;

class StoreSurveyQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'question_type' => ['required', 'in:radio,checkbox,text,scale'],
            'options' => ['nullable', 'array'],
            'options.*' => ['string'], // every option must be a string
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Le titre de la question est obligatoire.',
            'question_type.required' => 'Le type de question est obligatoire.',
            'question_type.in' => 'Type de question invalide.',
        ];
    }
}
