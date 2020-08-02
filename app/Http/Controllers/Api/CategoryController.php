<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\CategoryFilter;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     * @apiResource CategoryResource
     * @apiModel Category
     */
    public function index(Request $request)
    {
        $filter = app(CategoryFilter::class);
        $query = Category::query();
        $query = $this->onlyTrashedIfRequested($request, $query);
        $filterQuery = $query->filtered($filter);
        $categories = $request->has('all') ? $filterQuery->get() : $filterQuery->paginate(5);
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     * @apiResource CategoryResource
     * @apiModel Category
     * @param CategoryRequest $request
     * @return CategoryResource
     */
    public function store(CategoryRequest $request)
    {
        $request['slug'] = Str::slug($request->category_name);
        $category = Category::create($request->all());
        $category->refresh();
        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @apiResource CategoryResource
     * @apiModel Category
     * @param Category $category
     * @return CategoryResource
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @apiResource CategoryResource
     * @apiModel Category
     * @param CategoryRequest $request
     * @param Category $category
     * @return CategoryResource
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->fill($request->all());
        $category->save();
        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @apiModel Category
     * @param Category $category
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([], 204);
    }

    /**
     * @param Category $category
     * @return JsonResponse
     */
    public function restore(Category $category)
    {
        $category->restore();
        return response()->json([], 204);
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
