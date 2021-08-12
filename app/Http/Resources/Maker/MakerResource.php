<?php

namespace App\Http\Resources\Maker;

use Illuminate\Http\Resources\Json\JsonResource;

class MakerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'link' => $this->link,
            'products' => $this->products()->count(),
        ];
    }
}
