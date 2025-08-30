<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDemoRequestRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // Personal Information
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'job_title' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'country_region' => 'required|string|max:100',

            // Company Information
            'company_name' => 'required|string|max:255',
            'industry' => 'required|string|max:100',
            'number_of_employees' => 'required|string|max:50',

            // Product Information
            'product_name' => 'required|string|max:255',
            'purpose_of_demo' => 'required|string|max:500',
            'message' => 'nullable|string|max:1000',

            // Preferences
            'subscribe_to_updates' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'job_title.required' => 'Job title is required.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'phone.required' => 'Phone number is required.',
            'country_region.required' => 'Country/Region is required.',
            'company_name.required' => 'Company name is required.',
            'industry.required' => 'Industry is required.',
            'number_of_employees.required' => 'Number of employees is required.',
            'product_name.required' => 'Product name is required.',
            'purpose_of_demo.required' => 'Purpose of demo is required.',
        ];
    }
}
