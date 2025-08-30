<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDemoRequestRequest;
use App\Models\DemoRequest;

class DemoRequestController extends Controller
{
    public function store(StoreDemoRequestRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['subscribe_to_updates'] = $request->boolean('subscribe_to_updates');

            DemoRequest::query()->create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Demo request submitted successfully! We will contact you soon.',
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit demo request. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}
