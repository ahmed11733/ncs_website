<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRegistrationRequest;
use App\Models\EventRegistration;

class EventRegistrationController extends Controller
{
    public function store(StoreEventRegistrationRequest $request)
    {
        EventRegistration::query()->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Event registration created successfully.',
        ], 200);
    }
}
