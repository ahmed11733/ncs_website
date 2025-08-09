<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventRegistration;


class EventsController extends Controller
{
   public function registrations(){
       $registrations = EventRegistration::query()->paginate(10);

       return view('admin.pages.events.registrations', compact('registrations'));
   }
}
