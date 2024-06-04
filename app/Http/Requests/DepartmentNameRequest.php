<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentNameRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'departmentName' => [
                'required',
                'max:100',
                'unique:departments,name,' . $this->id,
            ]
        ];
    }

    public function messages()
    {
        return [
            'departmentName.required' => __('validation.department_required'),
            'departmentName.unique' => __('validation.department_unique'),
            'departmentName.max:100' => __('validation.department_max'), ['max' => 100],
        ];
    }
}
