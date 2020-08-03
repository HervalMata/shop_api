<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Mnabialek\LaravelEloquentFilter\Traits\Filterable;

class Product extends Model
{
    use SoftDeletes;
    use Filterable;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'product_name', 'slug',
        'product_code', 'description',
        'stock', 'price', 'featured',
        'active', 'photo', 'category_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $product->slug = Str::slug($product->product_name);
            $product->product_code = Str::random(8);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class);
    }
}
