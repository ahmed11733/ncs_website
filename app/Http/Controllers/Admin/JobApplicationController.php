<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the job applications for a specific job.
     */
    public function index(Job $job)
    {
        $applications = $job->applications()->latest()->paginate(10);

        return view('admin.pages.jobs.applications.index', compact('job', 'applications'));
    }

    /**
     * Display the specified job application.
     */
    public function show(Job $job, JobApplication $application)
    {
        return view('admin.pages.jobs.applications.show', compact('job', 'application'));
    }

    /**
     * Remove the specified job application from storage.
     */
    public function destroy(Job $job, JobApplication $application)
    {
        // Delete associated files if they exist
        if ($application->resume_path && Storage::exists($application->resume_path)) {
            Storage::delete($application->resume_path);
        }

        if ($application->cv_path && Storage::exists($application->cv_path)) {
            Storage::delete($application->cv_path);
        }

        $application->delete();

        return redirect()->route('admin.jobs.applications.index', $job)
            ->with('success', 'Application deleted successfully.');
    }
}
