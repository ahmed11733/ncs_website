<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'department_id' => 'required|exists:job_departments,id',
            'title' => 'required|string|max:255',
            'experience_years' => 'required|numeric|min:0|max:50',
            'last_date' => 'required|date|after_or_equal:today',
            'job_description' => 'required|string',
            'skills' => 'required|string',
            'nationality' => 'nullable|string|max:100',
            'certificate' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:15',
            'specialization' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'department_id.required' => 'The department field is required.',
            'department_id.exists' => 'The selected department is invalid.',
            'last_date.after_or_equal' => 'The last date must be today or in the future.',
            'experience_years.max' => 'Experience years cannot be more than 50.',
        ];
    }
}
