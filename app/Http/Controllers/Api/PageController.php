<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Models\Page;
use Exception;

class PageController extends Controller
{
    public function show(Page $page)
    {
        try {
            $page->load('sections');

            return new PageResource($page);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Page not found'
            ], 404);
        }
    }
}
