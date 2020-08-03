<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Color;
use Faker\Factory;

$faker = Factory::create('pt_BR');

$factory->define(Color::class, function () use ($faker) {
    return [
        'color_name' => $faker->safeColorName
    ];
});
