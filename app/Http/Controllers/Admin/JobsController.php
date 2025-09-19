<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobRequest;
use App\Models\Job;
use App\Models\JobDepartment;
use Exception;

class JobsController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->paginate(10);
        return view('admin.pages.jobs.index', compact('jobs'));
    }

    public function create()
    {
        $departments = JobDepartment::all();
        return view('admin.pages.jobs.form', compact('departments'));
    }

    public function store(JobRequest $request)
    {
        try {
            Job::create([
                'department_id' => $request->department_id,
                'experience_years' => $request->experience_years,
                'last_date' => $request->last_date,
                'age' => $request->age,
                // translatable fields
                'title' => [
                    'en' => $request->title_en,
                    'ar' => $request->title_ar,
                ],
                'job_description' => [
                    'en' => $request->job_description_en,
                    'ar' => $request->job_description_ar,
                ],
                'skills' => [
                    'en' => $request->skills_en,
                    'ar' => $request->skills_ar,
                ],
                'nationality' => [
                    'en' => $request->nationality_en,
                    'ar' => $request->nationality_ar,
                ],
                'certificate' => [
                    'en' => $request->certificate_en,
                    'ar' => $request->certificate_ar,
                ],
                'specialization' => [
                    'en' => $request->specialization_en,
                    'ar' => $request->specialization_ar,
                ],
            ]);

            return redirect()->route('admin.jobs.index')
                ->with('success', 'Job created successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function edit(Job $job)
    {
        $departments = JobDepartment::all();
        return view('admin.pages.jobs.form', compact('job', 'departments'));
    }

    public function update(JobRequest $request, Job $job)
    {
        try {
            $job->update([
                'department_id' => $request->department_id,
                'experience_years' => $request->experience_years,
                'last_date' => $request->last_date,
                'age' => $request->age,
                'title' => [
                    'en' => $request->title_en,
                    'ar' => $request->title_ar,
                ],
                'job_description' => [
                    'en' => $request->job_description_en,
                    'ar' => $request->job_description_ar,
                ],
                'skills' => [
                    'en' => $request->skills_en,
                    'ar' => $request->skills_ar,
                ],
                'nationality' => [
                    'en' => $request->nationality_en,
                    'ar' => $request->nationality_ar,
                ],
                'certificate' => [
                    'en' => $request->certificate_en,
                    'ar' => $request->certificate_ar,
                ],
                'specialization' => [
                    'en' => $request->specialization_en,
                    'ar' => $request->specialization_ar,
                ],
            ]);

            return redirect()->route('admin.jobs.index')
                ->with('success', 'Job updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return redirect()->back()->with('success', 'Job deleted successfully.');
    }
}
