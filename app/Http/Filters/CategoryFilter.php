<?php


namespace App\Http\Filters;

use Mnabialek\LaravelEloquentFilter\Filters\SimpleQueryFilter;
class CategoryFilter extends SimpleQueryFilter
{
    protected $simpleFilters = ['search'];
    protected $simpleSorts = ['category_name', 'created_at'];
    protected function applySearch($value)
    {
        $this->query->where('category_name', 'LIKE', "%$value%");
    }
}
