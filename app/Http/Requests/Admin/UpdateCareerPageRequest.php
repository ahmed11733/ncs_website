<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCareerPageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // Hero Section
            'hero_title.en' => 'required|string|max:255',
            'hero_title.ar' => 'required|string|max:255',
            'hero_subtitle.en' => 'required|string|max:500',
            'hero_subtitle.ar' => 'required|string|max:500',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'This field is required',
            '*.max' => 'This field must not exceed :max characters',
            'hero_image.image' => 'The hero image must be a valid image file',
        ];
    }
}
