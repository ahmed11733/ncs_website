<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DemoRequestController;
use App\Http\Controllers\Admin\DynamicPageController;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\JobApplicationController;
use App\Http\Controllers\Admin\JobDepartmentsController;
use App\Http\Controllers\Admin\JobsController;
use App\Http\Controllers\Admin\PageCategoryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PageSectionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['as' => 'admin.', 'prefix' => '/'], function () {
    Route::get('/', [AuthController::class, 'loginForm'])->name('login');
    Route::get('login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('submit.login');
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');


        Route::get('events/registrations', [EventsController::class, 'registrations'])->name('events.registrations');

        Route::prefix('jobs')->name('jobs.')->group(function () {
            Route::get('/', [JobsController::class, 'index'])->name('index');
            Route::get('/create', [JobsController::class, 'create'])->name('create');
            Route::post('/store', [JobsController::class, 'store'])->name('store');
            Route::get('/edit/{job}', [JobsController::class, 'edit'])->name('edit');
            Route::put('/update/{job}', [JobsController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [JobsController::class, 'destroy'])->name('destroy');

            // Job Applications Routes
            Route::get('/{job}/applications', [JobApplicationController::class, 'index'])
                ->name('applications.index');
            Route::get('/{job}/applications/{application}', [JobApplicationController::class, 'show'])
                ->name('applications.show');
            Route::delete('/{job}/applications/{application}', [JobApplicationController::class, 'destroy'])
                ->name('applications.destroy');

        });

        Route::prefix('job-departments')->name('job-departments.')->group(function () {
            Route::get('/', [JobDepartmentsController::class, 'index'])->name('index');
            Route::get('/create', [JobDepartmentsController::class, 'create'])->name('create');
            Route::post('/store', [JobDepartmentsController::class, 'store'])->name('store');
            Route::get('/edit/{jobDepartment}', [JobDepartmentsController::class, 'edit'])->name('edit');
            Route::put('/update/{jobDepartment}', [JobDepartmentsController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [JobDepartmentsController::class, 'destroy'])->name('destroy');
        });

        Route::resource('page-categories', PageCategoryController::class)
            ->except(['show']);
        Route::resource('pages', PageController::class)
            ->except(['show']);
        Route::resource('page-sections', PageSectionController::class)
            ->except(['show']);

        Route::get('/contact-messages', [ContactMessageController::class, 'index'])
            ->name('contact-messages.index');
        Route::delete('/contact-messages/{contactMessage}', [ContactMessageController::class, 'destroy'])
            ->name('contact-messages.destroy');

        Route::prefix('/demo-requests')->name('demo-requests.')->group(function () {
            Route::get('/', [DemoRequestController::class, 'index'])->name('index');
            Route::delete('/{demoRequest}', [DemoRequestController::class, 'destroy'])->name('destroy');
        });

        Route::resource('faqs', FaqController::class)->except(['show']);

        Route::prefix('/dynamic-pages')->name('dynamicPages.')->group(function () {
            // Home Page Routes
            Route::get('/home', [DynamicPageController::class, 'homeEdit'])->name('home');
            Route::post('/home', [DynamicPageController::class, 'homeUpdate'])->name('home.update');

            // About Us Page Routes
            Route::get('/about', [DynamicPageController::class, 'aboutEdit'])->name('about');
            Route::post('/about', [DynamicPageController::class, 'aboutUpdate'])->name('about.update');

            // Contact Us Page Routes
            Route::get('/contact', [DynamicPageController::class, 'contactEdit'])->name('contact');
            Route::post('/contact', [DynamicPageController::class, 'contactUpdate'])->name('contact.update');

            Route::get('/events', [DynamicPageController::class, 'eventsEdit'])->name('events');
            Route::post('/events', [DynamicPageController::class, 'eventsUpdate'])->name('events.update');

            Route::get('/career', [DynamicPageController::class, 'careerEdit'])->name('career');
            Route::post('/career', [DynamicPageController::class, 'careerUpdate'])->name('career.update');

            // Footer Routes
            Route::get('/footer', [DynamicPageController::class, 'footerEdit'])->name('footer');
            Route::post('/footer', [DynamicPageController::class, 'footerUpdate'])->name('footer.update');

        });



//        Route::resource('users', UsersController::class);
//        Route::put('users/update-status/{user}', [UsersController::class, 'updateStatus'])->name('users.update.status');
//
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    });
});
