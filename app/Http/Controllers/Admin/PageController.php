<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Page;
use App\Models\PageCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $pages = Page::with('category')
            ->when($request->category_id, function($query) use ($request) {
                return $query->where('page_category_id', $request->category_id);
            })
            ->latest()
            ->paginate(10);

        $categories = PageCategory::all();

        return view('admin.pages.pages.index', compact('pages', 'categories'));
    }

    public function create()
    {
        $categories = PageCategory::all();
        return view('admin.pages.pages.form', compact('categories'));
    }

    public function store(PageRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('hero_image')) {
            $path = $request->file('hero_image')->store('pages', 'public');
            $validated['hero_image'] = Storage::disk('public')->path($path);
        }

        Page::create($validated);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page created successfully');
    }

    public function update(PageRequest $request, Page $page)
    {
        $validated = $request->validated();

        if ($request->hasFile('hero_image')) {
            if ($page->hero_image) {
                $relativePath = str_replace(Storage::disk('public')->path(''), '', $page->hero_image);
                Storage::disk('public')->delete($relativePath);
            }
            $path = $request->file('hero_image')->store('pages', 'public');
            $validated['hero_image'] = Storage::disk('public')->path($path);
        }

        $page->update($validated);

        return redirect()->route('admin.pages.index', ['category_id' => $page->page_category_id])
            ->with('success', 'Page updated successfully');
    }

    public function edit(Page $page)
    {
        $categories = PageCategory::all();
        return view('admin.pages.pages.form', compact('page', 'categories'));
    }

    public function destroy(Page $page)
    {
        if ($page->hero_image) {
            Storage::disk('public')->delete($page->hero_image);
        }

        $page->delete();

        return redirect()->route('admin.pages.index', ['category_id' => $page->page_category_id])
            ->with('success', 'Page deleted successfully');
    }
}
