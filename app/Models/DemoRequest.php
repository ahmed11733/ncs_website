<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemoRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        // Personal Information
        'first_name',
        'last_name',
        'job_title',
        'email',
        'phone',
        'country_region',

        // Company Information
        'company_name',
        'industry',
        'number_of_employees',

        // Product / Demo Request
        'product_name',
        'purpose_of_demo',
        'message',
        'subscribe_to_updates',

        // Scheduling
        'date',
        'time',

        // Customer Support
        'issue_description',
        'availability_hours',
        'type',
        'attachment',
    ];

    protected $casts = [
        'subscribe_to_updates' => 'boolean',
        'date' => 'date',
        'time' => 'datetime:H:i',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Helper method to get full name
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
