<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductReesource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $category_id = $this->category_id;
        $category = Category::find($category_id);
        return [
            'id' => $this->id,
            'product_name' => $this->product_name,
            'slug' => $this->slug,
            'product_code' => $this->product_code,
            'description' => $this->description,
            'stock' => (int) $this->stock,
            'price' => (float) $this->price,
            'featured' => (bool) $this->featured,
            'photo_url' => $this->photo_url,
            'active' => (bool) $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'category' => new CategoryResource($category)
        ];
    }
}
