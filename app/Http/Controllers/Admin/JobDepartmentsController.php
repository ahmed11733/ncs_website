<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobDepartment;
use Exception;
use Illuminate\Http\Request;

class JobDepartmentsController extends Controller
{
    public function index()
    {
        $departments = JobDepartment::query()->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pages.job_departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.pages.job_departments.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        try {
            JobDepartment::create([
                'name' => [
                    'en' => $validated['name_en'],
                    'ar' => $validated['name_ar'],
                ]
            ]);

            return redirect()->route('admin.job-departments.index')->with('success', 'Department created successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function edit(JobDepartment $jobDepartment)
    {
        return view('admin.pages.job_departments.form', compact('jobDepartment'));
    }

    public function update(Request $request, JobDepartment $jobDepartment)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        try {
            $jobDepartment->update([
                'name' => [
                    'en' => $validated['name_en'],
                    'ar' => $validated['name_ar'],
                ]
            ]);

            return redirect()->route('admin.job-departments.index')->with('success', 'Department updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function destroy($id)
    {
        $department = JobDepartment::findOrFail($id);
        $department->delete();

        return redirect()->back()->with('success', 'Department deleted successfully.');
    }
}
