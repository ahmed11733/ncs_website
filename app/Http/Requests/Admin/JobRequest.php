<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'department_id' => 'required|exists:job_departments,id',
            'experience_years' => 'required|integer|min:0',
            'age' => 'required|integer|min:18|max:99',
            'last_date' => 'required|date|after:today',

            // English fields
            'title_en' => 'required|string|max:255',
            'job_description_en' => 'required|string',
            'skills_en' => 'required|string',
            'nationality_en' => 'required|string|max:255',
            'certificate_en' => 'required|string|max:255',
            'specialization_en' => 'required|string|max:255',

            // Arabic fields
            'title_ar' => 'required|string|max:255',
            'job_description_ar' => 'required|string',
            'skills_ar' => 'required|string',
            'nationality_ar' => 'required|string|max:255',
            'certificate_ar' => 'required|string|max:255',
            'specialization_ar' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'department_id.required' => 'The department field is required.',
            'department_id.exists' => 'The selected department is invalid.',
            'last_date.after_or_equal' => 'The last date must be today or in the future.',
            'experience_years.max' => 'Experience years cannot be more than 50.',

            // Optional: Translation field messages
            'title.*.required' => 'The job title in each language is required.',
            'job_description.*.required' => 'The job description in each language is required.',
            'skills.*.required' => 'The skills field in each language is required.',
        ];
    }
}
