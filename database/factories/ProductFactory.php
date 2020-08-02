<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Support\Str;

$faker = Factory::create('pt_BR');

$factory->define(Product::class, function () use ($faker) {
    $categories = Category::all();
    $category = $categories->random();
    $name = $faker->word;
    return [
        'product_name' => $name,
        'slug' => Str::slug($name),
        'product_code' => Str::random(8),
        'description' => $faker->text,
        'stock' => $faker->numberBetween(1, 5),
        'price' => $faker->randomFloat(2, 20, 50),
        'featured' => $faker->numberBetween(0, 1),
        'active' => $faker->numberBetween(0, 1),
        'photo' => $faker->imageUrl(),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
});
