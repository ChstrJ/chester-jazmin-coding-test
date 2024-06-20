<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id' => $this->id,
            'Product name' => $this->name,
            'Product description' => $this->description,
            'Product price' => $this->price,
            'Created at' => $this->created_at,
            'Updated at' => $this->updated_at,
        ];
    }
}
