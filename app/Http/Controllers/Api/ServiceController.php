<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')->get();
        return ServiceResource::collection($services);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:3d_mapping,web_development,digital_marketing',
            'description' => 'required|string',
            'icon_or_image' => 'nullable|string',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $service = Service::create($validated);

        return new ServiceResource($service);
    }

    public function show(Service $service)
    {
        return new ServiceResource($service);
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'category' => 'sometimes|required|in:3d_mapping,web_development,digital_marketing',
            'description' => 'sometimes|required|string',
            'icon_or_image' => 'nullable|string',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $service->update($validated);

        return new ServiceResource($service);
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json(['message' => 'Service deleted successfully']);
    }
}
