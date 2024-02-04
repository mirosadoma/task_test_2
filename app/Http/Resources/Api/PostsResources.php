<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class PostsResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id'                => (int) $this->id??"",
            'title'             => (string) $this->title??"",
            'description'       => (string) $this->description ? \Str::limit($this->description, 512, '...') : "",
            'created_at'        => (string) $this->created_at->diffForHumans() ?? "",
        ];
        return $data;
    }
}
