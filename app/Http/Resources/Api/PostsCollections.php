<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class PostsCollections extends JsonResource
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
            'description'       => (string) $this->description??"",
            'phone_number'      => (int) $this->phone_number??"",
            'image'             => (string) $this->image_path??"",
            'user'              => $this->user ? new ClientResources($this->user) : [],
            'created_at'        => (string) $this->created_at->diffForHumans() ?? "",
        ];
        return $data;
    }
}
