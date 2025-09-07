<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DynamicPage extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'page_key',
        'content',
    ];

    protected $casts = [
        'content' => 'array',
    ];

    public $translatable = ['content'];
}
