<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobApplicationRequest;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    public function store(JobApplicationRequest $request)
    {
        try {
            // Handle file uploads
            $validated = $request->validated();

            $validated['resume_path'] = 'testresume_path'; //$this->storeFile($request->file('resume'), 'resumes');
            $validated['cv_path'] = 'testcv_path'; //$this->storeFile($request->file('cv'), 'cvs');

            // Set default for checkbox
            $validated['subscribe_to_updates'] = $validated['subscribe_to_updates'] ?? false;

            // Create application
            JobApplication::query()->create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Job application submitted successfully',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit application',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function storeFile($file, $directory): string
    {
        // Store in public disk (creates in storage/app/public/{directory})
        $path = $file->store($directory, 'public');

        // Generate full public URL
        return Storage::disk('public')->url($path);
    }
}
