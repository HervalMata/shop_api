<?php


namespace App\Http\Filters;

use Mnabialek\LaravelEloquentFilter\Filters\SimpleQueryFilter;
class ColorFilter extends SimpleQueryFilter
{
    protected $simpleFilters = ['search'];
    protected $simpleSorts = ['color_name', 'created_at'];
    protected function applySearch($value)
    {
        $this->query->where('color_name', 'LIKE', "%$value%");
    }
}
