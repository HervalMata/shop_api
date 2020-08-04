<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductPhotoCollection;
use App\Http\Resources\ProductPhotoResource;
use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;

class ProductPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @apiResource ProductPhotoCollection
     * @apiModel Product
     * @param Product $product
     * @return ProductPhotoCollection
     */
    public function index(Product $product)
    {
        return new ProductPhotoCollection($product->photos(), $product);
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
     * Display the specified resource.
     *
     * @apiResource ProductPhotoResorce
     * @apiModel Product
     * @param Product $product
     * @param ProductPhoto $photo
     * @return ProductPhotoResource
     */
    public function show(Product $product, ProductPhoto $photo)
    {
        if ($photo->product_id != $product->id) {
            abort(404);
        }
        return new ProductPhotoResource($photo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
