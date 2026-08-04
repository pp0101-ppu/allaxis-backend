<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
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
            'client_name' => $this->client_name,
            'client_company' => $this->client_company,
            'quote' => $this->quote,
            'rating' => $this->rating,
            'is_featured' => $this->is_featured,
        ];
    }
}
