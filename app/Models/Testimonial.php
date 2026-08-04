<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'client_name',
        'client_company',
        'quote',
        'rating',
        'is_featured',
    ];
}
