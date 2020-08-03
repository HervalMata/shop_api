<?php

use App\Models\Color;
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
        factory(Product::class, 100)
            ->create()
            ->each(function (Product $product) use ($colors) {
                for ($i = 1; $i < 3; $i++) {
                    $colorId = $colors->random()->id;
                    $product->colors()->attach($colorId);
                }
            });
    }
}
