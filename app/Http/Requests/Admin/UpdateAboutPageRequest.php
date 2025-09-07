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
        $rules = [
            'hero_title.en' => 'required|string|max:255',
            'hero_title.ar' => 'required|string|max:255',
            'hero_subtitle.en' => 'required|string|max:500',
            'hero_subtitle.ar' => 'required|string|max:500',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            'about_title.en' => 'required|string|max:255',
            'about_title.ar' => 'required|string|max:255',
            'about_description.en' => 'required|string',
            'about_description.ar' => 'required|string',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            'why_choose_main_title.en' => 'required|string|max:255',
            'why_choose_main_title.ar' => 'required|string|max:255',
            'why_choose_main_subtitle.en' => 'required|string|max:500',
            'why_choose_main_subtitle.ar' => 'required|string|max:500',
        ];

        // Add rules for 10 why choose items
        for ($i = 0; $i < 10; $i++) {
            $rules["why_choose_title.en.{$i}"] = 'nullable|string|max:255';
            $rules["why_choose_title.ar.{$i}"] = 'nullable|string|max:255';
            $rules["why_choose_description.en.{$i}"] = 'nullable|string|max:500';
            $rules["why_choose_description.ar.{$i}"] = 'nullable|string|max:500';
            $rules["why_choose_icon_{$i}"] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'hero_title.en.required' => 'The English hero title is required.',
            'hero_title.ar.required' => 'The Arabic hero title is required.',
            'hero_subtitle.en.required' => 'The English hero subtitle is required.',
            'hero_subtitle.ar.required' => 'The Arabic hero subtitle is required.',
            'about_title.en.required' => 'The English about title is required.',
            'about_title.ar.required' => 'The Arabic about title is required.',
            'about_description.en.required' => 'The English about description is required.',
            'about_description.ar.required' => 'The Arabic about description is required.',
            'why_choose_main_title.en.required' => 'The English why choose us title is required.',
            'why_choose_main_title.ar.required' => 'The Arabic why choose us title is required.',
            'why_choose_main_subtitle.en.required' => 'The English why choose us subtitle is required.',
            'why_choose_main_subtitle.ar.required' => 'The Arabic why choose us subtitle is required.',
        ];

        // Add messages for 10 why choose items
        for ($i = 0; $i < 10; $i++) {
            $itemNumber = $i + 1;
            $messages["why_choose_title.en.{$i}.required"] = "The English title for item {$itemNumber} is required.";
            $messages["why_choose_title.ar.{$i}.required"] = "The Arabic title for item {$itemNumber} is required.";
            $messages["why_choose_description.en.{$i}.required"] = "The English description for item {$itemNumber} is required.";
            $messages["why_choose_description.ar.{$i}.required"] = "The Arabic description for item {$itemNumber} is required.";
        }

        return $messages;
    }
}
