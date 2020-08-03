<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\MaterialFilter;
use App\Http\Requests\MaterialRequest;
use App\Http\Resources\MaterialResource;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @apiResource MaterialResource
     * @apiModel Material
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $filter = app(MaterialFilter::class);
        $query = Material::query();
        $filterQuery = $query->filtered($filter);
        $materials = $request->has('all') ? $filterQuery->get() : $filterQuery->paginate(5);
        return MaterialResource::collection($materials);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @apiResource MaterialResource
     * @apiModel Material
     * @param MaterialRequest $request
     * @return MaterialResource
     */
    public function store(MaterialRequest $request)
    {
        $material = Material::create($request->all());
        $material->refresh();
        return new MaterialResource($material);
    }

    /**
     * Display the specified resource.
     *
     * @apiResource MaterialResource
     * @apiModel Material
     * @param Material $material
     * @return MaterialResource
     */
    public function show(Material $material)
    {
        return new MaterialResource($material);
    }

    /**
     * Update the specified resource in storage.
     *
     * @apiResource MaterialResource
     * @apiModel Material
     * @param MaterialRequest $request
     * @param Material $material
     * @return MaterialResource
     */
    public function update(MaterialRequest $request, Material $material)
    {
        $material->fill($request->all());
        $material->save();
        return new MaterialResource($material);
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
