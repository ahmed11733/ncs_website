<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateHomePageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        // Return true if the user is authorized to make this request
        // You can add authorization logic here if needed
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            // Hero Section
            'hero_title.en' => 'required|string|max:255',
            'hero_title.ar' => 'required|string|max:255',
            'hero_subtitle.en' => 'required|string',
            'hero_subtitle.ar' => 'required|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            // Trusted Companies
            'trusted_companies_heading.en' => 'required|string|max:255',
            'trusted_companies_heading.ar' => 'required|string|max:255',
            'company_logos_en_*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',

            // About Section
            'about_heading.en' => 'required|string|max:255',
            'about_heading.ar' => 'required|string|max:255',
            'about_description.en' => 'required|string',
            'about_description.ar' => 'required|string',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            // Industries Section
            'industries_heading.en' => 'nullable|string|max:255',
            'industries_heading.ar' => 'nullable|string|max:255',
            'industries_title.en.*' => 'nullable|string|max:255',
            'industries_title.ar.*' => 'nullable|string|max:255',
            'industries_image_en_*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',

            // Video Section
            'video_file' => 'nullable|mimes:mp4,mov,avi|max:51200',

            // Careers Section
            'careers_heading.en' => 'required|string|max:255',
            'careers_heading.ar' => 'required|string|max:255',
            'careers_description.en' => 'required|string',
            'careers_description.ar' => 'required|string',
            'careers_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'careers_features.en.*' => 'nullable|string|max:255',
            'careers_features.ar.*' => 'nullable|string|max:255',

            // Testimonials Section
            'testimonials_heading.en' => 'required|string|max:255',
            'testimonials_heading.ar' => 'required|string|max:255',
            'testimonials_name.en.*' => 'nullable|string|max:255',
            'testimonials_name.ar.*' => 'nullable|string|max:255',
            'testimonials_position.en.*' => 'nullable|string|max:255',
            'testimonials_position.ar.*' => 'nullable|string|max:255',
            'testimonials_stars.en.*' => 'nullable|integer|min:1|max:5',
            'testimonials_stars.ar.*' => 'nullable|integer|min:1|max:5',
            'testimonials_text.en.*' => 'nullable|string',
            'testimonials_text.ar.*' => 'nullable|string',
            'testimonials_image_en_*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes()
    {
        return [
            'hero_title' => 'hero title',
            'hero_subtitle' => 'hero subtitle',
            'trusted_companies_heading' => 'trusted companies heading',
            'about_heading' => 'about heading',
            'industries_heading' => 'industries heading',
            'video_heading' => 'video heading',
            'careers_heading' => 'careers heading',
            'testimonials_heading' => 'testimonials heading',
            'industries.*.title' => 'industry title',
            'testimonials.*.name' => 'testimonial name',
            'testimonials.*.position' => 'testimonial position',
            'testimonials.*.text' => 'testimonial text',
            'testimonials.*.stars' => 'star rating',
        ];
    }
}
