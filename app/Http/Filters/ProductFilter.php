<?php


namespace App\Http\Filters;


use Mnabialek\LaravelEloquentFilter\Filters\SimpleQueryFilter;

class ProductFilter extends SimpleQueryFilter
{
    protected $simpleFilters = ['search'];
    protected $simpleSorts = ['product_name', 'category_name', 'price', 'stock', 'created_at'];

    protected function applySearch($value)
    {
        $this->query->where('product_name', 'LIKE', "%$value%")
                    ->orwhere('description', 'LIKE', "%$value%");
    }

    protected function applySortCategoryName($order)
    {
        $this->query->orderBy('product.category.category_name', $order);
    }

    protected function applySortCreatedAt($order)
    {
        $this->query->orderBy('product.created_at', $order);
    }

    public function hasFilterParameter()
    {
        $contains = $this->parser->getFilters()->contains(function ($filter) {
            return $filter->getField() === 'search' && !empty($filter->getValue());
        });
        return $contains;
    }

    public function apply($query)
    {
        $query = $query->select('products.*')
            ->join('categories', 'categories.id', '=', 'products.category_id');
        return parent::apply($query);
    }
}
