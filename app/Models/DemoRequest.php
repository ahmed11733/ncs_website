<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemoRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'job_title',
        'email',
        'phone',
        'country_region',
        'company_name',
        'industry',
        'number_of_employees',
        'product_name',
        'purpose_of_demo',
        'message',
        'subscribe_to_updates',
    ];

    protected $casts = [
        'subscribe_to_updates' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Helper method to get full name
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
