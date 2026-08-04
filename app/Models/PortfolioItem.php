<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PortfolioItem extends Model
{
    protected $fillable = [
        'service_id', 'title', 'slug', 'client_name',
        'cover_image', 'tour_embed_url', 'description', 'is_published',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            if (empty($item->slug)) {
                $item->slug = Str::slug($item->title);
            }
        });
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}