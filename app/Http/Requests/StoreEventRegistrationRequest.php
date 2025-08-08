<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreEventRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'country_code' => 'required|string|max:10',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'company_name' => 'required|string|max:255',
            'country_region' => 'required|string|max:255',
            'number_of_attendees' => 'required|integer|min:1',
            'event_name' => 'required|string|max:255',
            'preferred_session' => 'required|string|max:255',
            'receive_event_reminder' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required.',
            'first_name.string'   => 'First name must be a valid string.',
            'first_name.max'      => 'First name cannot be longer than 255 characters.',

            'last_name.required' => 'Last name is required.',
            'last_name.string'   => 'Last name must be a valid string.',
            'last_name.max'      => 'Last name cannot be longer than 255 characters.',

            'job_title.string' => 'Job title must be a valid string.',
            'job_title.max'    => 'Job title cannot exceed 255 characters.',

            'phone_country_code.string' => 'Country code must be a valid string.',
            'phone_country_code.max'    => 'Country code cannot exceed 10 characters.',

            'phone_number.string' => 'Phone number must be a valid string.',
            'phone_number.max'    => 'Phone number cannot exceed 20 characters.',

            'email.required' => 'Email address is required.',
            'email.email'    => 'Please enter a valid email address.',
            'email.max'      => 'Email cannot be longer than 255 characters.',
            'email.unique'   => 'This email address is already registered.',

            'company_name.string' => 'Company name must be a valid string.',
            'company_name.max'    => 'Company name cannot exceed 255 characters.',

            'country_region.string' => 'Country/Region must be a valid string.',
            'country_region.max'    => 'Country/Region cannot exceed 255 characters.',

            'number_of_attendees.integer' => 'Number of attendees must be an integer.',
            'number_of_attendees.min'     => 'Number of attendees must be at least 1.',

            'event_name.required' => 'Event name is required.',
            'event_name.string'   => 'Event name must be a valid string.',
            'event_name.max'      => 'Event name cannot be longer than 255 characters.',

            'preferred_session.string' => 'Preferred session must be a valid string.',
            'preferred_session.max'    => 'Preferred session cannot exceed 255 characters.',

            'receive_event_reminder.boolean' => 'Event reminder selection must be true or false.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors occurred.',
            'errors'  => $validator->errors()
        ], 422));
    }
}
