<?php

namespace App\Http\Requests;

use App\Rules\ActionNotChange;
use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'subjectName' => [
                'required',
                'max:100',
                'unique:subjects,name,' . $this->id,
            ],

            'departmentId' => ['required', 'exists:departments,id']
        ];
    }
    public function messages(): array
    {
        return [
            'subjectName.required' => __('validation.sub_required'),
            'subjectName.max' => __('validation.sub_max', ['max' => 100]),
            'subjectName.unique' => __('validation.sub_unique'),

            'departmentId.required' => __('validation.depId_required'),
            'departmentId.exists' => __('validation.depId_exists'),
        ];
    }
}
