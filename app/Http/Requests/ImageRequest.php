<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'upload' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2048']
        ];
    }

    public function messages()
    {
        return [
            'upload.required' => __('validation.img_required'),
            'upload.image' => __('validation.img'),
            'upload.mimes' => __('validation.img_mimes'),
            'upload.max' => __('validation.img_max',['max' => 2048]),
        ];
    }
}
