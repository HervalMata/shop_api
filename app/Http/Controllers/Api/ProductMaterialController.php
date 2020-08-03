<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductMaterialRequest;
use App\Http\Resources\ProductMaterialResource;
use App\Models\Material;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @apiResource ProductMaterialResource
     * @apiModel Product
     * @param Product $product
     * @return ProductMaterialResource
     */
    public function index(Product $product)
    {
        return new ProductMaterialResource($product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @apiResource ProductColorResource
     * @apiModel Product
     * @param ProductMaterialRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function store(ProductMaterialRequest $request, Product $product)
    {
        $changed = $product->materials()->sync($request->materials);
        $materialsAttachedId = $changed['attached'];
        $materials = Material::whereIn('id', $materialsAttachedId)->get();
        return $materials->count() ? response()->json(new ProductMaterialResource($product), 201) : [];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
