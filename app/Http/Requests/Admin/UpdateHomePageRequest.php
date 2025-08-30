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
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'required|string|max:255',
            'hero_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

            // Trusted Companies
            'trusted_companies_heading' => 'required|string|max:255',
            'company_logos.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',

            // About Section
            'about_heading' => 'required|string|max:255',
            'about_description' => 'required|string',
            'about_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

            // Industries Section
            'industries_heading' => 'required|string|max:255',
            'industries' => 'sometimes|array',
            'industries.*.title' => 'nullable|string|max:100',
            'industries.*.image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',

            // Video Section
            'video_file' => 'sometimes|mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/webm|max:51200', // 50MB max

            // Careers Section
            'careers_heading' => 'required|string|max:255',
            'careers_description' => 'required|string',
            'careers_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'careers_features' => 'required|array',
            'careers_features.*' => 'nullable|string|max:255',

            // Testimonials Section
            'testimonials_heading' => 'required|string|max:255',
            'testimonials' => 'required|array',
            'testimonials.*.name' => 'nullable|string|max:255',
            'testimonials.*.position' => 'nullable|string|max:255',
            'testimonials.*.text' => 'nullable|string',
            'testimonials.*.stars' => 'required|integer|min:1|max:5',
            'testimonials.*.image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'hero_image.image' => 'The hero image must be a valid image file.',
            'hero_image.max' => 'The hero image may not be greater than 2MB.',
            'company_logos.*.image' => 'Each company logo must be a valid image file.',
            'company_logos.*.max' => 'Each company logo may not be greater than 1MB.',
            'video_file.mimetypes' => 'The video file must be a valid video format (MP4, MOV, AVI, WEBM).',
            'video_file.max' => 'The video file may not be greater than 50MB.',
            'testimonials.*.stars.min' => 'The star rating must be at least 1.',
            'testimonials.*.stars.max' => 'The star rating may not be greater than 5.',
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
