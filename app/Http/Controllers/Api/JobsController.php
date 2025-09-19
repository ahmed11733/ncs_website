<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobApplicationRequest;
use App\Http\Resources\JobResource;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobsController extends Controller
{
    public function index(Request $request){

        $jobs = Job::query()
            ->when($request->filled('department'), function ($query) use ($request){
                $query->whereHas('department' , function ($query) use ($request){
                    $query->where('id', '=', $request->get('department'));
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return response()->json([
            'success' => true,
            'message' => 'Action ran successfully',
            'date' => JobResource::collection($jobs)->response()->getData(),
        ], 200);
    }

    public function show(Job $job)
    {
        return response()->json([
            'success' => true,
            'message' => 'Job details retrieved successfully',
            'data' => new JobResource($job->load('department'))
        ]);
    }

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
