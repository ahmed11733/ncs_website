<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // For update operations, get the page ID from route parameters
        $pageId = $this->route('page') ? $this->route('page')->id : null;

        return [
            'page_category_id' => 'required|exists:page_categories,id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('pages')->ignore($pageId)
            ],
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'page_category_id.required' => 'The category is required',
            'name.unique' => 'A page with this name already exists',
            // Add other custom messages as needed
        ];
    }
}
