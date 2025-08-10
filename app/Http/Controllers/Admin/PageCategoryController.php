<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageCategory;
use Illuminate\Http\Request;

class PageCategoryController extends Controller
{
    public function index()
    {
        $categories = PageCategory::query()->latest()->paginate(10);

        return view('admin.pages.page_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.pages.page_categories.form');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:page_categories',
        ]);

        PageCategory::query()->create($validated);

        return redirect()->route('admin.page-categories.index')
            ->with('success', 'Category created successfully');
    }


    public function edit(PageCategory $pageCategory)
    {
        return view('admin.pages.page_categories.form', compact('pageCategory'));
    }

    public function update(Request $request, PageCategory $pageCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:page_categories,name,'.$pageCategory->id,
        ]);

        $pageCategory->update($validated);

        return redirect()->route('admin.page-categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy(PageCategory $pageCategory)
    {
        $pageCategory->delete();

        return redirect()->route('admin.page-categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
