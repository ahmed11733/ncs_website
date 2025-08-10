<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageSectionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // For update operations, get the section ID from route parameters
        $sectionId = $this->route('page_section') ? $this->route('page_section')->id : null;

        return [
            'page_id' => 'required|exists:pages,id',
            'label' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => [
                'required',
                'integer',
                Rule::unique('page_sections')
                    ->where('page_id', $this->page_id)
                    ->ignore($sectionId)
            ],
        ];
    }

    public function messages()
    {
        return [
            'page_id.required' => 'The page selection is required',
            'title.required' => 'The title field is required',
            'content.required' => 'The content field is required',
            'order.unique' => 'This order number is already used for another section on this page',
            'image.max' => 'The image must not be larger than 2MB',
        ];
    }
}
