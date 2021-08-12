<?php

namespace App\Http\Resources\Substance;

use Illuminate\Http\Resources\Json\JsonResource;

class SubstanceResource extends JsonResource
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
            'products' => $this->products()->count(),
        ];
    }
}
