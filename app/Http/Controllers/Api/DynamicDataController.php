<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageCategoryResource;
use App\Models\DynamicPage;
use App\Models\PageCategory;
use Illuminate\Http\Request;

class DynamicDataController extends Controller
{
    public function __invoke(Request $request, $page)
    {
        $pageCategories = PageCategory::with('pages')->get();
        $header = PageCategoryResource::collection($pageCategories);

        $page_data = DynamicPage::query()
            ->where('page_key', '=', $page)
            ->first()
            ->getTranslation('content', $request->header('Accept-Language'));

        $footer = DynamicPage::query()
            ->where('page_key', '=', 'footer')
            ->first()
            ->getTranslation('content', $request->header('Accept-Language'));

        return response()->json([
            'header' => $header,
            'page_data' => $page_data,
            'footer' => $footer,
        ]);
    }
}
