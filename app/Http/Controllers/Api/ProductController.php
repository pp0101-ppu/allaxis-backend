<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->where('is_active', true);

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->get();

        return ProductResource::collection($products);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|unique:products,sku',
            'brand' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'specifications' => 'nullable|array',
            'stock_quantity' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $product = Product::create($validated);

        return new ProductResource($product->load('category'));
    }

    public function show(Product $product)
    {
        return new ProductResource($product->load('category'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'sometimes|required|exists:product_categories,id',
            'name' => 'sometimes|required|string|max:255',
            'sku' => 'nullable|string|unique:products,sku,' . $product->id,
            'brand' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'description' => 'nullable|string',
            'specifications' => 'nullable|array',
            'stock_quantity' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $product->update($validated);

        return new ProductResource($product->load('category'));
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
