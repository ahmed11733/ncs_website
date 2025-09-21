<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageSectionResource extends JsonResource
{
    public function toArray(Request $request)
    {
        $locale = $request->header('Accept-Language');

        return [
            'id' => $this->id,
            'page_id' => $this->page_id,
            'label' => $this->getTranslation('label', $locale),
            'title' => $this->getTranslation('title', $locale),
            'sub_title' => $this->getTranslation('sub_title', $locale),
            'content' => $this->getTranslation('content', $locale),
            'image' => $this->image,
            'order' => $this->order,
        ];
    }
}
