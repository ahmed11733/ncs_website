<?php

use App\Http\Controllers\Api\ContactMessageController;
use App\Http\Controllers\Api\DemoRequestController;
use App\Http\Controllers\Api\DynamicDataController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventRegistrationController;
use App\Http\Controllers\Api\JobsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/event-registrations', [EventRegistrationController::class, 'store']);

Route::get('/jobs', [JobsController::class, 'index']);
Route::get('/jobs/{job}', [JobsController::class, 'show']);
Route::post('/job-applications', [JobsController::class, 'store']);


Route::get('/pages/show/{page}', [PageController::class, 'show']);

Route::post('/contact', [ContactMessageController::class, 'store']);

Route::post('/demo-requests', [DemoRequestController::class, 'store']);

Route::get('/dynamic-data/{page}', DynamicDataController::class);

Route::get('faqs', [FaqController::class, 'index']);
