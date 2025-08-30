<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DemoRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DemoRequestController extends Controller
{
    public function index()
    {
        $demoRequests = DemoRequest::query()->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.pages.demoRequests.index', compact('demoRequests'));
    }


    public function destroy(DemoRequest $demoRequest)
    {
        $demoRequest->delete();

        return redirect()->route('admin.demo-requests.index')
            ->with('success', 'Demo request deleted successfully!');
    }
}
