<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\Admin\JobsController;
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


Route::group(['as' => 'admin.', 'prefix' => '/admin'], function () {
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
        });


//        Route::resource('users', UsersController::class);
//        Route::put('users/update-status/{user}', [UsersController::class, 'updateStatus'])->name('users.update.status');
//
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    });
});
