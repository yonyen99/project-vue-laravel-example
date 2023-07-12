<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class showBookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->only('id','title','description') + [
            "image" => $this->media->file_url ?? null,
        ];
    }
}
