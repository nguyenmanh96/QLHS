<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;

class ValidatorDepartment
{
    public static function validateDepartment(array $data)
    {
        return Validator::make($data, [
            'departmentName' => ['required', 'max:100']
        ],
            [
                'departmentName.required' => __('validation.department_required'),
                'departmentName.max:255' => __('validation.department_max'), ['max' => 100],
            ])->validate();
    }
}
