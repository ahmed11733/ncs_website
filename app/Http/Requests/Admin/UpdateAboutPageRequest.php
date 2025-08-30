<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAboutPageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // Hero Section
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'required|string|max:255',
            'hero_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

            // About Section
            'about_title' => 'required|string|max:255',
            'about_description' => 'required|string',
            'about_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

            // Why Choose Us Section
            'why_choose_title' => 'required|string|max:255',
            'why_choose_subtitle' => 'required|string|max:255',
            'why_choose_items' => 'required|array|min:1',
            'why_choose_items.*.title' => 'nullable|string|max:255',
            'why_choose_items.*.description' => 'nullable|string',
            'why_choose_items.*.image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
        ];
    }

    public function messages()
    {
        return [
            'why_choose_items.required' => 'At least one "Why Choose Us" item is required.',
            'why_choose_items.*.title.nullable' => 'Each item must have a title.',
            'why_choose_items.*.description.nullable' => 'Each item must have a description.',
        ];
    }

    public function attributes()
    {
        return [
            'hero_title' => 'hero title',
            'hero_subtitle' => 'hero subtitle',
            'about_title' => 'about title',
            'about_description' => 'about description',
            'why_choose_title' => 'why choose us title',
            'why_choose_subtitle' => 'why choose us subtitle',
            'why_choose_items.*.title' => 'item title',
            'why_choose_items.*.description' => 'item description',
        ];
    }
}
