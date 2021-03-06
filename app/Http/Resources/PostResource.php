<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
//        do not use this for real project instead use eager loading!!!!

        return [
            'id' => $this->id,
            'body' => $this->body,
            'created_at' => $this->created_at,
            'user' => $this->user,
            'like_count' => $this->likes->count(),
            'users' => UserResource::collection($this->likes->pluck('user')), //number of users who like the post
        ];
    }
}
