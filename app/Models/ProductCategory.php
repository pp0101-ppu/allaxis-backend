<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'parent_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    // A category can have many products
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    // A category can have a parent category
    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }

    // A category can have many child categories
    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }
}
