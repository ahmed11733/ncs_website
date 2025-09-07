<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFooterPageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // Event Section
            'event_title' => 'required|array',
            'event_title.en' => 'required|string|max:255',
            'event_title.ar' => 'required|string|max:255',
            'event_subtitle' => 'required|array',
            'event_subtitle.en' => 'required|string|max:500',
            'event_subtitle.ar' => 'required|string|max:500',

            // Contact Information (not translatable)
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'whatsapp_number' => 'nullable|string|max:20',

            // Social Links (not translatable)
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',

            // Copyright
            'copyright' => 'required|array',
            'copyright.en' => 'required|string|max:500',
            'copyright.ar' => 'required|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            'event_title.en.required' => 'The English event title is required.',
            'event_title.ar.required' => 'The Arabic event title is required.',
            'event_subtitle.en.required' => 'The English event subtitle is required.',
            'event_subtitle.ar.required' => 'The Arabic event subtitle is required.',
            'copyright.en.required' => 'The English copyright text is required.',
            'copyright.ar.required' => 'The Arabic copyright text is required.',
        ];
    }
}
