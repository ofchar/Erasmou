<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
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
            'targetable' => [
                'uuid' => $this->targetable->uuid,
                'type' => $this->targetable_type,
            ],
            'rateable' => [
                'uuid' => $this->rateable->uuid,
                'name' => $this->rateable->name,
                'description' => $this->rateable->description,
                'data_type' => $this->rateable->data_type,
                'min_value' => $this->rateable->min_value,
                'max_value' => $this->rateable->max_value,
            ],
            'value' => $this->value,
            'comment' => $this->comment,
            'user_uuid' => $this->user->uuid,
            'user' => [
                'username' => $this->user->username,
            ],
            'created_at' => $this->created_at,
        ];
    }
}
