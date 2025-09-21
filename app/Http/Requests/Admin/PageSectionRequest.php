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
        $sectionId = $this->route('page_section')?->id;

        return [
            'page_id' => 'required|exists:pages,id',

            'label.en' => 'nullable|string|max:255',
            'label.ar' => 'nullable|string|max:255',

            'title.en' => 'required|string|max:255',
            'title.ar' => 'required|string|max:255',

            'sub_title.en' => 'nullable|string|max:255',
            'sub_title.ar' => 'nullable|string|max:255',

            'content.en' => 'required|string',
            'content.ar' => 'required|string',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            'order' => [
                'required',
                'integer',
                Rule::unique('page_sections')
                    ->where(fn($q) => $q->where('page_id', $this->page_id))
                    ->ignore($sectionId),
            ],
        ];
    }

    public function messages()
    {
        return [
            'title.en.required' => 'The English title is required.',
            'title.ar.required' => 'The Arabic title is required.',
            'content.en.required' => 'The English content is required.',
            'content.ar.required' => 'The Arabic content is required.',
            'order.unique' => 'This order number is already used for another section on this page',
        ];
    }
}
