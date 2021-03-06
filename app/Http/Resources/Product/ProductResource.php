<?php

namespace App\Http\Resources\Product;

use App\Models\Maker;
use App\Models\Substance;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'substance' => Substance::find($this->substance_id),
            'maker' => Maker::find($this->maker_id),
            'price' => $this->price,
        ];
    }
}
