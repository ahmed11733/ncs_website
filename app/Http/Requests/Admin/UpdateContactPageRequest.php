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
            // Hero Section
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'required|string|max:255',
            'hero_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

            // Contact Information
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:100',

            // Office Locations
            'egypt_office' => 'required|string|max:255',
            'saudi_office' => 'required|string|max:255',

            // Social Links
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
            'hero_title.required' => 'The hero title is required.',
            'hero_subtitle.required' => 'The hero subtitle is required.',
            'phone.required' => 'The phone number is required.',
            'email.required' => 'The email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'egypt_office.required' => 'Egypt office address is required.',
            'saudi_office.required' => 'Saudi office address is required.',
        ];
    }

    public function attributes()
    {
        return [
            'hero_title' => 'hero title',
            'hero_subtitle' => 'hero subtitle',
            'phone' => 'phone number',
            'email' => 'email address',
            'egypt_office' => 'Egypt office',
            'saudi_office' => 'Saudi office',
            'facebook_url' => 'Facebook URL',
            'youtube_url' => 'YouTube URL',
            'instagram_url' => 'Instagram URL',
            'twitter_url' => 'Twitter URL',
            'linkedin_url' => 'LinkedIn URL',
        ];
    }
}
