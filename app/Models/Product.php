<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'brand',
        'price',
        'description',
        'specifications',
        'stock_quantity',
        'is_active',
    ];

    protected $casts = [
        'specifications' => 'array',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    // A product belongs to one category
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }
}
