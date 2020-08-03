<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Mnabialek\LaravelEloquentFilter\Traits\Filterable;

class Material extends Model
{
    use Filterable;

    protected $fillable = ['material_name', 'slug'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($material) {
            $material->slug = Str::slug($material->material_name);
        });
    }
}
