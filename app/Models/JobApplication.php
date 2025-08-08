<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string first_name
 * @property string last_name
 */
class JobApplication extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'national_id_number',
        'job_title',
        'department',
        'highest_degree_achieved',
        'institution_name',
        'graduation_year',
        'years_of_experience',
        'previous_employer_name',
        'employment_date_start_end',
        'desired_salary',
        'date_available_to_start',
        'why_join_us',
        'additional_comments',
        'reference_contact_information',
        'linkedin_profile',
        'resume_path',
        'cv_path',
        'subscribe_to_updates',
    ];

    /**
     * Get the job that this application belongs to.
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    /**
     * Get the full name of the applicant.
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
