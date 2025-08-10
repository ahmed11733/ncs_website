<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageSectionResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'page_id' => $this->page_id,
            'label' => $this->label,
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'content' => $this->content,
            'image' => $this->image,
            'order' => $this->order,
        ];
    }
}
