<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Color;
use Faker\Factory;
use Illuminate\Support\Str;

$faker = Factory::create('pt_BR');

$factory->define(Color::class, function () use ($faker) {
    $name = $faker->safeColorName;
    return [
        'color_name' => $name,
        'slug' => Str::slug($name)
    ];
});
