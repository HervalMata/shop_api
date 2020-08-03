<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\ColorFilter;
use App\Http\Requests\ColorRequest;
use App\Http\Resources\ColorResource;
use App\Models\Color;
use Illuminate\Http\JsonResponse;
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
        $filterQuery = $query->filtered($filter);
        $color = $request->has('all') ? $filterQuery->get() : $filterQuery->paginate(5);
        return ColorResource::collection($color);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @apiResource ColorResource
     * @apiModel Color
     * @param ColorRequest $request
     * @return ColorResource
     */
    public function store(ColorRequest $request)
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
     * @param ColorRequest $request
     * @param Color $color
     * @return ColorResource
     */
    public function update(ColorRequest $request, Color $color)
    {
        $color->fill($request->all());
        $color->save();
        return new ColorResource($color);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Color $color
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Color $color)
    {
        $color->delete();
        return response()->json([], 204);
    }

}
