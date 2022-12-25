<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            'country' => $this->country->name,
            'province' => $this->province ? $this->province->name : null,
            'name' => $this->name,
            'description' => $this->description,
            'population' => $this->population,
            'universities' => UniversityResource::collection($this->universities),
            'rates' => [
                'overall' => $this->Overall,
                'overall_original' => $this->Overall_original,
                'prices' => $this->Prices,
                'prices_original' => $this->Prices_original,
                'funnes' => $this->Funnes,
                'funnes_original' => $this->Funnes_original,
            ]
        ];
    }
}
