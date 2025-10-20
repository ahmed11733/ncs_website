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
        $demoRequests = DemoRequest::query()
            ->whereNull('type')
            ->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.pages.demoRequests.index', compact('demoRequests'));
    }

  public function customerSupport()
    {
        $customerSupportRequests = DemoRequest::query()
            ->whereNotNull('type')
            ->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.pages.demoRequests.contactSupport', compact('customerSupportRequests'));
    }


    public function destroy(DemoRequest $demoRequest)
    {
        $demoRequest->delete();

        return redirect()->back()->with('success', 'Request deleted.');
    }
}
