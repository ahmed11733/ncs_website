<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactMessageRequest;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function store(ContactMessageRequest $request)
    {
        ContactMessage::query()->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully',
        ], 200);
    }
}
