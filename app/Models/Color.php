<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mnabialek\LaravelEloquentFilter\Traits\Filterable;

class Color extends Model
{
    use Filterable;

    protected $fillable = ['color_name'];
}
