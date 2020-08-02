<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Support\Str;

$faker = Factory::create('pt_BR');

$factory->define(Category::class, function () use ($faker) {
    $name = $faker->word();
    return [
        'category_name' => $name,
        'slug' => Str::slug($name),
        'active' => $faker->numberBetween(0, 1),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
});
