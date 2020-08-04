<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ProductPhoto extends Model
{
    const BASE_PATH = 'app/public';
    const DIR_PRODUCTS = 'products';
    const PRODUCTS_PATH = self::BASE_PATH . '/' . self::DIR_PRODUCTS;

    protected $fillable = ['file_name', 'product_id'];

    /**
     * @param $productId
     * @return string
     */
    public static function photosPath($productId)
    {
        $path = self::PRODUCTS_PATH;
        return storage_path("{$path}/{$productId}");
    }

    /**
     * @param $product_id
     * @param array $files
     */
    public static function uploadFiles($product_id, array $files)
    {
        $dir = self::photosDir($product_id);
        foreach ($files as $file) {
            $file->store($dir, ['disk' => 'public']);
        }
    }

    /**
     * @param $product_id
     * @return string
     */
    private static function photosDir($product_id)
    {
        $dir = self::DIR_PRODUCTS;
        return "{$dir}/{$product_id}";
    }

    /**
     * @param int $productId
     * @param array $files
     * @return Collection
     */
    public static function createWhithPhotoFiles(int $productId, array $files)
    {
        self::uploadFiles($productId, $files);
        $photos = self::createPhotosModels($productId, $files);
        return new Collection($photos);
    }

    /**
     * @param int $productId
     * @param array $files
     * @return array
     */
    private static function createPhotosModels(int $productId, array $files)
    {
        $photos = [];
        foreach ($files as $file) {
            $photos[] = self::create([
                'file_name' => $file->hashName(),
                'product_id' => $productId
            ]);
            return $photos;
        }
    }

    /**
     * @return string
     */
    public function getPhotoUrlAttribute()
    {
        $path = self::photosDir($this->product_id);
        return asset("storage/{$path}/{$this->file_name}");
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
