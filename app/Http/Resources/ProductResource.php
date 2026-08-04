<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'sku' => $this->sku,
            'brand' => $this->brand,
            'price' => $this->price,
            'description' => $this->description,
            'specifications' => $this->specifications,
            'stock_quantity' => $this->stock_quantity,
            'is_active' => $this->is_active,
            'category' => $this->whenLoaded('category', fn() => $this->category->name),
        ];
    }
}
