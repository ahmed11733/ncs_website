<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class JobApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'job_id' => 'required|exists:jobs,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'national_id_number' => 'required|string|max:50',
            'job_title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'highest_degree_achieved' => 'required|string|max:255',
            'institution_name' => 'required|string|max:255',
            'graduation_year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'years_of_experience' => 'required|integer|min:0',
            'previous_employer_name' => 'required|string|max:255',
            'employment_date_start_end' => 'required|string|max:255',
            'desired_salary' => 'required|string|max:100',
            'date_available_to_start' => 'required|date|after_or_equal:today',
            'why_join_us' => 'required|string|min:10|max:2000',
            'additional_comments' => 'required|string|max:2000',
            'reference_contact_information' => 'required|string|max:1000',
            'linkedin_profile' => 'required|url|max:255',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'subscribe_to_updates' => 'boolean'
        ];
    }

    /**
     * Custom error messages for validation
     */
    public function messages(): array
    {
        return [
            'job_id.required' => 'The job ID is required',
            'job_id.exists' => 'The specified job does not exist',
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
            'email.required' => 'Email address is required',
            'email.email' => 'Please enter a valid email address',
            'phone.required' => 'Phone number is required',
            'address.required' => 'Address is required',
            'national_id_number.required' => 'National ID number is required',
            'highest_degree_achieved.required' => 'Highest degree achieved is required',
            'institution_name.required' => 'Institution name is required',
            'graduation_year.required' => 'Graduation year is required',
            'graduation_year.integer' => 'Graduation year must be a valid year',
            'years_of_experience.required' => 'Years of experience is required',
            'date_available_to_start.required' => 'Available start date is required',
            'date_available_to_start.after_or_equal' => 'Start date must be today or in the future',
            'why_join_us.required' => 'Please explain why you want to join us',
            'why_join_us.min' => 'Your answer should be at least 10 characters',
            'cv.required' => 'CV is required',
            'cv.mimes' => 'CV must be a PDF, DOC or DOCX file',
            'cv.max' => 'CV must not exceed 2MB'
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
