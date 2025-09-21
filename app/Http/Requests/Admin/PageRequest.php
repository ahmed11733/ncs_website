<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $pageId = $this->route('page') ? $this->route('page')->id : null;

        return [
            'page_category_id' => 'required|exists:page_categories,id',

            'name.en' => [
                'required', 'string', 'max:255',
                Rule::unique('pages', 'name->en')->ignore($pageId)
            ],
            'name.ar' => ['required', 'string', 'max:255'],

            'title.en' => 'required|string|max:255',
            'title.ar' => 'required|string|max:255',

            'subtitle.en' => 'nullable|string|max:255',
            'subtitle.ar' => 'nullable|string|max:255',

            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer',
        ];
    }
}
