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
        $rules = [
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

            // Type
            'type' => 'nullable|string|in:customer-support,other',

            'product_name' => 'required|string|max:255',
        ];

        if ($this->input('type') === 'customer-support') {
            // Customer Support fields
            $rules['issue_description'] = 'required|string|max:1000';
            $rules['availability_hours'] = 'required|string|max:255';
            $rules['message'] = 'required|string|max:1000';
            $rules['attachment'] = 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048';
        } else {
            // Demo Request fields
            $rules['purpose_of_demo'] = 'required|string|max:500';
            $rules['message'] = 'nullable|string|max:1000';
            $rules['subscribe_to_updates'] = 'boolean';

            $rules['date'] = 'required|date|after_or_equal:today';
            $rules['time'] = 'required|date_format:H:i';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            // Personal Information
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'job_title.required' => 'Job title is required.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'phone.required' => 'Phone number is required.',
            'country_region.required' => 'Country/Region is required.',

            // Company Information
            'company_name.required' => 'Company name is required.',
            'industry.required' => 'Industry is required.',
            'number_of_employees.required' => 'Number of employees is required.',

            // Demo Request Fields
            'product_name.required' => 'Product name is required.',
            'purpose_of_demo.required' => 'Purpose of demo is required.',
            'date.required' => 'Please select a preferred date for the demo.',
            'date.date' => 'The selected date is invalid.',
            'date.after_or_equal' => 'The date cannot be in the past.',
            'time.required' => 'Please select a preferred time for the demo.',
            'time.date_format' => 'Please enter a valid time in HH:MM format.',

            // Customer Support Fields
            'issue_description.required' => 'Please describe your issue.',
            'availability_hours.required' => 'Please specify your availability hours.',
            'message.required' => 'A message is required for support requests.',
            'attachment.mimes' => 'Attachment must be a file of type: JPG, JPEG, PNG, PDF, DOC, or DOCX.',
            'attachment.max' => 'Attachment size may not exceed 2 MB.',
        ];
    }
}
