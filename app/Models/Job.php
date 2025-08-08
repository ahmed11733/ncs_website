<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'title',
        'experience_years',
        'last_date',
        'job_description',
        'skills',
        'nationality',
        'certificate',
        'age',
        'specialization',
    ];

    protected $casts = [
        'last_date' => 'date',
    ];


    public function department()
    {
        return $this->belongsTo(JobDepartment::class, 'department_id');
    }
}
