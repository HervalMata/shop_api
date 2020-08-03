<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductColorResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductColorController extends Controller
{
    /**
     * @apiResource ProductColorResource
     * @apiModel Product
     * @param Product $product
     * @return ProductColorResource
     */
    public function index(Product $product)
    {
        return new ProductColorResource($product);
    }
}
