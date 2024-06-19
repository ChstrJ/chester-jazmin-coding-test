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
            'Product Name' => $this->name,
            'Product Description' => $this->description,
            'Product Price' => $this->price,
            'Created At' => $this->created_at,
            'Updated At' => $this->updated_at,
        ];
    }
}
