<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductColorRequest;
use App\Http\Resources\ProductColorResource;
use App\Models\Color;
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

    /**
     *
     * @apiResource ProductColorResource
     * @apiModel Product
     * @param ProductColorRequest $request
     * @param Product $product
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function store(ProductColorRequest $request, Product $product)
    {
        $changed = $product->colors()->sync($request->colors);
        $colorsAttachedId = $changed['attached'];
        $colors = Color::whereIn('id', $colorsAttachedId)->get();
        return $colors->count() ? response()->json(new ProductColorResource($product), 201) : [];
    }

    /**
     * @param Product $product
     * @param Color $color
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product, Color $color)
    {
        $product->colors()->detach($color->id);
        return response()->json([], 204);
    }
}
