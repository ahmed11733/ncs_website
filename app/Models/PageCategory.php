<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PageCategory extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['name'];

    public array $translatable = ['name'];

    public function pages()
    {
        return $this->hasMany(Page::class)->orderBy('order');
    }
}
