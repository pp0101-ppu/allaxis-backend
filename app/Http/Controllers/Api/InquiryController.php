<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InquiryResource;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    // Public - anyone can submit an inquiry
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
            'type' => 'required|in:product,service,general',
            'related_id' => 'nullable|integer',
        ]);

        $inquiry = Inquiry::create($validated);

        return new InquiryResource($inquiry);
    }

    // Admin-only from here down
    public function index(Request $request)
    {
        $query = Inquiry::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        return InquiryResource::collection($query->latest()->get());
    }

    public function show(Inquiry $inquiry)
    {
        return new InquiryResource($inquiry);
    }

    public function update(Request $request, Inquiry $inquiry)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,contacted,closed',
        ]);

        $inquiry->update($validated);

        return new InquiryResource($inquiry);
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();
        return response()->json(['message' => 'Inquiry deleted successfully']);
    }
}
