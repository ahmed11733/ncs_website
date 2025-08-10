<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category_id' => $this->page_category_id,
            'hero_image' => $this->hero_image,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'order' => $this->order,
            'sections' => PageSectionResource::collection($this->whenLoaded('sections')),
        ];
    }
}
