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
        $jobs = Job::query()->orderBy('created_at', 'desc')->paginate(10);

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
            Job::query()->create($request->validated());

            return redirect()
                ->route('admin.jobs.index')
                ->with('success', 'Job created successfully');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Something went wrong');
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
            $job->update($request->validated());

            return redirect()
                ->route('admin.jobs.index')
                ->with('success', 'Job updated successfully');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Something went wrong');
        }
    }

    public function destroy($id)
    {
        $job = Job::query()->findOrFail($id);
        $job->delete();

        return redirect()->back()->with('success', 'Job deleted successfully.');
    }
}
