<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Resources\Json\JsonResource;

class ApartmentResource extends JsonResource
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
            'road' => $this->road,
            'building_number' => $this->building_number,
            'apartment_number' => $this->apartment_number,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'landlord' => [
                'uuid' => $this->landlord->uuid,
                'name' => $this->landlord->name,
            ],
            'user' => [
                'uuid' => $this->user->uuid,
                'username' => $this->user->username,
            ],
        ];
    }
}
