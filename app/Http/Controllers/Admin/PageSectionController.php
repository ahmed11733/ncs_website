<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageSectionRequest;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageSectionController extends Controller
{
    public function index(Request $request)
    {
        $sections = PageSection::with('page')
            ->when($request->page_id, function($query) use ($request) {
                return $query->where('page_id', $request->page_id);
            })
            ->latest()
            ->paginate(10);

        $pages = Page::all();

        return view('admin.pages.page_sections.index', compact('sections', 'pages'));
    }

    public function create()
    {
        $pages = Page::all();
        return view('admin.pages.page_sections.form', compact('pages'));
    }

    public function store(PageSectionRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('page-sections', 'public');
        }

        PageSection::query()->create($validated);

        return redirect()->route('admin.page-sections.index')
            ->with('success', 'Section created successfully');
    }

    public function edit(PageSection $pageSection)
    {
        $pages = Page::all();
        return view('admin.pages.page_sections.form', compact('pageSection', 'pages'));
    }

    public function update(PageSectionRequest $request, PageSection $pageSection)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($pageSection->image) {
                Storage::disk('public')->delete($pageSection->image);
            }
            $validated['image'] = $request->file('image')->store('page-sections', 'public');
        }

        $pageSection->update($validated);

        return redirect()->route('admin.page-sections.index', ['page_id' => $pageSection->page_id])
            ->with('success', 'Section updated successfully');
    }

    public function destroy(PageSection $pageSection)
    {
        if ($pageSection->image) {
            Storage::disk('public')->delete($pageSection->image);
        }

        $pageSection->delete();

        return redirect()->route('admin.page-sections.index',['page_id' => $pageSection->page_id])
            ->with('success', 'Section deleted successfully');
    }
}
