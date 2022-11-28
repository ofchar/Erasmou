<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Resources\Json\JsonResource;

class UniversityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'description' => $this->description,
            'city' => [
                'uuid' => $this->city->uuid,
                'name' => $this->city->name,
            ],
            'faculties' => FacultyResource::collection($this->faculties),
            'rates' => [
                'friendliness' => $this->Friendliness,
                'friendliness_original' => $this->Friendliness_original,
                'education' => $this->Education,
                'education_original' => $this->Education_original,
                'overall' => $this->Overall,
                'overall_original' => $this->Overall_original,
            ]
        ];
    }
}
