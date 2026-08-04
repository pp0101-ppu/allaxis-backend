<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestimonialResource;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        return TestimonialResource::collection(Testimonial::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'quote' => 'required|string',
            'rating' => 'integer|min:1|max:5',
            'is_featured' => 'boolean',
        ]);

        $testimonial = Testimonial::create($validated);

        return new TestimonialResource($testimonial);
    }

    public function show(Testimonial $testimonial)
    {
        return new TestimonialResource($testimonial);
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'client_name' => 'sometimes|required|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'quote' => 'sometimes|required|string',
            'rating' => 'integer|min:1|max:5',
            'is_featured' => 'boolean',
        ]);

        $testimonial->update($validated);

        return new TestimonialResource($testimonial);
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return response()->json(['message' => 'Testimonial deleted successfully']);
    }
}
