<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\ColorFilter;
use App\Http\Requests\ColorResquest;
use App\Http\Resources\ColorResource;
use App\Models\Color;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @apiResource ColorResource
     * @apiModel Color
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $filter = app(ColorFilter::class);
        $query = Color::query();
        $query = $this->onlyTrashedIfRequested($request, $query);
        $filterQuery = $query->filtered($filter);
        $color = $request->has('all') ? $filterQuery->get() : $filterQuery->paginate(5);
        return ColorResource::collection($color);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @apiResource ColorResource
     * @apiModel Color
     * @param ColorResquest $request
     * @return ColorResource
     */
    public function store(ColorResquest $request)
    {
        $category = Color::create($request->all());
        $category->refresh();
        return new ColorResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @apiResource ColorResource
     * @apiModel Color
     * @param Color $color
     * @return ColorResource
     */
    public function show(Color $color)
    {
        return new ColorResource($color);
    }

    /**
     * Update the specified resource in storage.
     *
     * @apiResource ColorResource
     * @apiModel Color
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

    /**
     * @param Request $request
     * @param Builder $query
     * @return Builder
     */
    private function onlyTrashedIfRequested(Request $request, Builder $query)
    {
        if ($request->get('trashed') == 1) {
            $query = $query->onlyTrashed();
        }
        return $query;
    }
}
