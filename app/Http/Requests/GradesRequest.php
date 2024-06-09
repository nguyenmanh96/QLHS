<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'grades' => ['required', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'grades.required' => __('validation.grades_required'),
            'grades.numeric' => __('validation.grades_numeric')
        ];
    }
}
