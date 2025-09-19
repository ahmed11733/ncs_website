<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Job extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = [
        'title',
        'job_description',
        'skills',
        'nationality',
        'certificate',
        'specialization',
    ];

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

    public function department(): BelongsTo
    {
        return $this->belongsTo(JobDepartment::class, 'department_id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }
}
