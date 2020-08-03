<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductMaterialResource;
use App\Models\Product;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
