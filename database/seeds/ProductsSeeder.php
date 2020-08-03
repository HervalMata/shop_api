<?php

use App\Models\Color;
use App\Models\Material;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = Color::all();
        $materials = Material::all();
        factory(Product::class, 100)
            ->create()
            ->each(function (Product $product) use ($colors, $materials) {
                for ($i = 1; $i < 4; $i++) {
                    $colorId = $colors->random()->id;
                    $materialId = $materials->random()->id;
                    $product->colors()->attach($colorId);
                    $product->materials()->attach($materialId);
                }
            });
    }
}
