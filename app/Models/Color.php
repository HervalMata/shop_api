<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Mnabialek\LaravelEloquentFilter\Traits\Filterable;

class Color extends Model
{
    use Filterable;

    protected $fillable = ['color_name', 'slug'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($color) {
            $color->slug = Str::slug($color->color_name);
        });
    }
}
