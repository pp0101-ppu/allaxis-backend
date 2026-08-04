<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function index()
    {
        return ProductResource::collection(Product::with('category')->get());
    }
}
