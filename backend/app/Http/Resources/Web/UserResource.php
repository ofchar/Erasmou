<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'username' => $this->username,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'bio' => $this->bio,
            'type' => $this->type,
            'country' => [
                'uuid' => $this->country->uuid,
                'name' => $this->country->name,
            ],
            'city' => [
                'uuid' => $this->city->uuid,
                'name' => $this->city->name,
            ],
        ];
    }
}
