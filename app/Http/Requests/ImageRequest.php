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
            'upload.required' => __('validate.img_required'),
            'upload.image' => __('validate.img'),
            'upload.mimes' => __('validate.img_mimes'),
            'upload.max:2048' => __('validate.img_max'), ['max' => 2048],
        ];
    }
}
