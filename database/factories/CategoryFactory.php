<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use const Faker\Generator\Provider\pt_BR as faker_pt;

$factory->define(Category::class, function (Faker $faker) {
    $faker->locale(faker_pt);
    $name = $faker->word;
    return [
        'category_name' => $name,
        'slug' => Str::slug($name),
    ];
});
