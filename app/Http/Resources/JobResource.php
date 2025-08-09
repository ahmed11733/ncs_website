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
        return [
            'id' => $this->id,
            'title' => $this->title,
            'department' => $this->department->name,
            'experience_years' => $this->experience_years,
            'last_date' => $this->last_date->format('Y-m-d'),
            'job_description' => $this->job_description,
            'skills' => $this->skills,
            'nationality' => $this->nationality,
            'certificate' => $this->certificate,
            'age' => $this->age,
            'specialization' => $this->specialization,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
