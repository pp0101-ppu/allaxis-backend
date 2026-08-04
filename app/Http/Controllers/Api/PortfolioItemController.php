<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PortfolioItemResource;
use App\Models\PortfolioItem;
use Illuminate\Http\Request;

class PortfolioItemController extends Controller
{
    public function index()
    {
        $items = PortfolioItem::with('service')
            ->where('is_published', true)
            ->latest()
            ->get();

        return PortfolioItemResource::collection($items);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'nullable|exists:services,id',
            'title' => 'required|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'cover_image' => 'nullable|string',
            'tour_embed_url' => 'nullable|string',
            'description' => 'nullable|string',
            'is_published' => 'boolean',
        ]);

        $item = PortfolioItem::create($validated);

        return new PortfolioItemResource($item);
    }

    public function show(PortfolioItem $portfolioItem)
    {
        return new PortfolioItemResource($portfolioItem->load('service'));
    }

    public function update(Request $request, PortfolioItem $portfolioItem)
    {
        $validated = $request->validate([
            'service_id' => 'nullable|exists:services,id',
            'title' => 'sometimes|required|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'cover_image' => 'nullable|string',
            'tour_embed_url' => 'nullable|string',
            'description' => 'nullable|string',
            'is_published' => 'boolean',
        ]);

        $portfolioItem->update($validated);

        return new PortfolioItemResource($portfolioItem);
    }

    public function destroy(PortfolioItem $portfolioItem)
    {
        $portfolioItem->delete();
        return response()->json(['message' => 'Portfolio item deleted successfully']);
    }
}