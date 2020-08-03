<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Material;
use Faker\Factory;
use Illuminate\Support\Str;

$faker = Factory::create('pt_BR');

$factory->define(Material::class, function () use ($faker) {
    $name = $faker->name;
    return [
        'material_name' => $name,
        'slug' => Str::slug($name)
    ];
});
