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

            // Handle file upload if an attachment exists
            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');

                // Create a unique filename
                $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Store the file in the "attachments" directory (public disk)
                $path = $file->storeAs('attachments', $fileName, 'public');

                // Store the full URL instead of just the relative path
                $validated['attachment'] = asset('storage/' . $path);
            }

            DemoRequest::query()->create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Action ran successfully! We will contact you soon.',
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Action failed. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}
