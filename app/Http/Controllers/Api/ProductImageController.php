<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'image' => 'required|image|max:5120', // max 5MB
        ]);

        $path = $request->file('image')->store('products', 'public');

        $image = $product->images()->create([
            'image_path' => $path,
        ]);

        return response()->json([
            'id' => $image->id,
            'url' => asset('storage/' . $image->image_path),
        ], 201);
    }

    public function destroy(ProductImage $productImage)
    {
        Storage::disk('public')->delete($productImage->image_path);
        $productImage->delete();

        return response()->json(['message' => 'Image deleted successfully']);
    }
}
