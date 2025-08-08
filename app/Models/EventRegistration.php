<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'job_title',
        'country_code',
        'phone_number',
        'email',
        'company_name',
        'country_region',
        'number_of_attendees',
        'event_name',
        'preferred_session',
        'receive_event_reminder',
    ];
}
