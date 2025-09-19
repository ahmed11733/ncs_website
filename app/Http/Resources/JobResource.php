<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $locale = $request->header('Accept-Language');

        return [
            'id' => $this->id,
            'title' => $this->getTranslation('title', $locale),
            'department' => [
                'id' => $this->department?->id,
                'name' => $this->department?->getTranslation('name',$locale),
            ],
            'experience_years' => $this->experience_years,
            'last_date' => optional($this->last_date)->format('Y-m-d'),
            'job_description' => $this->getTranslation('job_description', $locale),
            'skills' => $this->getTranslation('skills', $locale),
            'nationality' => $this->getTranslation('nationality', $locale),
            'certificate' => $this->getTranslation('certificate', $locale),
            'age' => $this->age,
            'specialization' => $this->getTranslation('specialization', $locale),
            'created_at' => $this->created_at->format('Y-m-d H:i:s')
        ];
    }
}
