<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageCategoryResource extends JsonResource
{
    public function toArray(Request $request)
    {
        $locale = $request->header('Accept-Language');

        return [
            'id' => $this->id,
            'name' => $this->getTranslation('name', $locale),
            'pages' => PageResource::collection($this->whenLoaded('pages')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
