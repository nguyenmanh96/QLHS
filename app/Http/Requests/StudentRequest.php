<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rule = [
            'studentName' => ['required', 'alpha', 'max:50'],
            'departmentId' => ['required'],
            'dob' => ['required', 'date_format:Y-m-d'],
            'sex' => ['required', 'in:Male,Female']
        ];

        if ($this->has('email')) {
            $rule['email'] = ['required', 'unique:users,email'];
        }

        if ($this->has('grades')) {
            $rule['grades'] = ['require', 'numeric'];
        }

        return $rule;
    }

    public function messages(): array
    {
        return [
            'email.required' => __('validation.email_required'),
            'email.unique' => __('validation.email_unique'),
            'studentName.required' => __('validation.st_required'),
            'studentName.max' => __('validation.st_max', ['max' => 50]),
            'studentName.alpha' => __('validation.st_alpha'),
            'departmentId.required' => __('validation.depId_required'),
            'dob.required' => __('validation.dob_required'),
            'dob.date_format' => __('validation.dob_date', ['Y-m-d']),
            'sex.required' => __('validation.sex_required'),
            'sex.in' => __('validation.sex_in'),
        ];
    }
}
