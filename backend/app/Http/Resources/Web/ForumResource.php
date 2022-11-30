<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Resources\Json\JsonResource;

class ForumResource extends JsonResource
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
            'forumable_type' => $this->forumable_type,
            'forumable_uuid' => $this->forumable->uuid,
            'name' => $this->name,
            'description' => $this->description,
            'post' => $this->post ? [
                'title' => $this->post->title,
            ] : null,
            'posts_count' => $this->posts_count,
            'user' => [
                'uuid' => $this->user->uuid,
                'name' => $this->user->username,
            ]
        ];
    }
}
