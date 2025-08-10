<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'label',
        'title',
        'sub_title',
        'content',
        'image',
        'order',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
