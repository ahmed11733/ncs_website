<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class JobDepartment extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public array $translatable = ['name'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'array',
    ];

    /**
     * Get the jobs for the department.
     */
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class, 'department_id');
    }

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $attributes = parent::toArray();

        // Convert translatable attributes to their translated values
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, app()->getLocale());
        }

        return $attributes;
    }
}
