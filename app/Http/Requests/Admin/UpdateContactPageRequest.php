<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactPageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // Hero Section - Translatable
            'hero_title' => 'required|array',
            'hero_title.en' => 'required|string|max:255',
            'hero_title.ar' => 'required|string|max:255',
            'hero_subtitle' => 'required|array',
            'hero_subtitle.en' => 'required|string|max:500',
            'hero_subtitle.ar' => 'required|string|max:500',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            // Contact Information - Not translatable
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',

            // Office Locations - Translatable
            'egypt_office' => 'required|array',
            'egypt_office.en' => 'required|string|max:500',
            'egypt_office.ar' => 'required|string|max:500',
            'saudi_office' => 'required|array',
            'saudi_office.en' => 'required|string|max:500',
            'saudi_office.ar' => 'required|string|max:500',

            // Social Links - Not translatable
            'facebook_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
        ];
    }

    public function messages()
    {
        return [
            'hero_title.en.required' => 'The English hero title is required.',
            'hero_title.ar.required' => 'The Arabic hero title is required.',
            'hero_subtitle.en.required' => 'The English hero subtitle is required.',
            'hero_subtitle.ar.required' => 'The Arabic hero subtitle is required.',
            'egypt_office.en.required' => 'The English Egypt office address is required.',
            'egypt_office.ar.required' => 'The Arabic Egypt office address is required.',
            'saudi_office.en.required' => 'The English Saudi office address is required.',
            'saudi_office.ar.required' => 'The Arabic Saudi office address is required.',
        ];
    }
}
