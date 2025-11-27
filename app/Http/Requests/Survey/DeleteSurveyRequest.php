<?php

namespace App\Http\Requests\Survey;

use Illuminate\Foundation\Http\FormRequest;

class DeleteSurveyRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('delete', $this->survey);
    }


    /**
     * @return array
     */
    public function rules(): array
    {
        return [];
    }
}
