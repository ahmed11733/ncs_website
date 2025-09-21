<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class PageSection extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'page_id',
        'label',
        'title',
        'sub_title',
        'content',
        'image',
        'order',
    ];

    public array $translatable = [
        'label',
        'title',
        'sub_title',
        'content',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
