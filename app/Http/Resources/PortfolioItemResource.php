<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioItemResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'client_name' => $this->client_name,
            'cover_image' => $this->cover_image,
            'tour_embed_url' => $this->tour_embed_url,
            'description' => $this->description,
            'category' => $this->whenLoaded('service', fn() => $this->service->category),
        ];
    }
}
