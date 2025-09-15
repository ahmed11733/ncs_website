<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventsPageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Hero Section
            'hero_title.en' => 'required|string|max:255',
            'hero_title.ar' => 'required|string|max:255',
            'hero_subtitle.en' => 'required|string|max:500',
            'hero_subtitle.ar' => 'required|string|max:500',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            // Main Content Section
            'main_title.en' => 'required|string|max:255',
            'main_title.ar' => 'required|string|max:255',
            'main_description.en' => 'required|string',
            'main_description.ar' => 'required|string',

            // Learning Objectives
            'learning_title.en' => 'required|string|max:255',
            'learning_title.ar' => 'required|string|max:255',
            'learning_points.en.*' => 'required|string|max:500',
            'learning_points.ar.*' => 'required|string|max:500',

            // Featured Event
            'featured_event_title.en' => 'required|string|max:255',
            'featured_event_title.ar' => 'required|string|max:255',
            'featured_event_date.en' => 'required|string|max:255',
            'featured_event_date.ar' => 'required|string|max:255',
            'featured_event_time.en' => 'required|string|max:255',
            'featured_event_time.ar' => 'required|string|max:255',
            'featured_event_location.en' => 'required|string|max:255',
            'featured_event_location.ar' => 'required|string|max:255',
            'featured_event_description.en' => 'required|string',
            'featured_event_description.ar' => 'required|string',
            'featured_event_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            // Event Card
            'event_card_time_text.en' => 'required|string|max:255',
            'event_card_time_text.ar' => 'required|string|max:255',
            'event_card_title.en' => 'required|string|max:255',
            'event_card_title.ar' => 'required|string|max:255',
            'event_card_date.en' => 'required|string|max:255',
            'event_card_date.ar' => 'required|string|max:255',
            'event_card_location.en' => 'required|string|max:255',
            'event_card_location.ar' => 'required|string|max:255',
            'event_card_description.en' => 'required|string',
            'event_card_description.ar' => 'required|string',
            'event_card_rating' => 'required|numeric|min:0|max:5',
            'event_card_raters_count' => 'required|integer|min:0',
            'event_card_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'This field is required',
            '*.max' => 'This field must not exceed :max characters',
            'hero_image.image' => 'The hero image must be a valid image file',
            'featured_event_image.image' => 'The featured event image must be a valid image file',
            'event_card_image.image' => 'The event card image must be a valid image file',
        ];
    }
}
