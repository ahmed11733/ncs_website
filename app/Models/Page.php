<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_category_id',
        'name',
        'hero_image',
        'title',
        'subtitle',
        'order'
    ];

    public function category()
    {
        return $this->belongsTo(PageCategory::class, 'page_category_id');
    }

    public function sections()
    {
        return $this->hasMany(PageSection::class)->orderBy('order');
    }
}
