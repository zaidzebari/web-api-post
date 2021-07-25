<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
//        do not use this for real project instead use eager loading!!!!
        return [
            'id' => $this->id,
            'title' => $this->title,
            'created_at' => $this->created_at,
            'posts' => PostResource::collection($this->posts),
            'user' => $this->user,
        ];
    }
}
