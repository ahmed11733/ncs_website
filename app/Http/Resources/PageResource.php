<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    public function toArray(Request $request)
    {
        $locale = $request->header('Accept-Language');

        return [
            'id' => $this->id,
            'name' => $this->getTranslation('name', $locale),
            'category_id' => $this->page_category_id,
            'hero_image' => $this->hero_image,
            'title' => $this->getTranslation('title', $locale),
            'subtitle' => $this->getTranslation('subtitle', $locale),
            'order' => $this->order,
            'sections' => PageSectionResource::collection($this->whenLoaded('sections')),
        ];
    }
}
