<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResources extends JsonResource
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
            'id'                => (int) $this->id,
            'name'              => (string) $this->name,
            'email'             => (string) $this->email,
            'created_at'        => (string) $this->created_at->diffForHumans() ?? "",
        ];
        return $data;
    }
}
