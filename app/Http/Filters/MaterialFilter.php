<?php


namespace App\Http\Filters;

use Mnabialek\LaravelEloquentFilter\Filters\SimpleQueryFilter;
class MaterialFilter extends SimpleQueryFilter
{
    protected $simpleFilters = ['search'];
    protected $simpleSorts = ['material_name', 'created_at'];
    protected function applySearch($value)
    {
        $this->query->where('material_name', 'LIKE', "%$value%");
    }
}
