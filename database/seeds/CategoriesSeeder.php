<?php

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class)->create([
            'category_name' => 'Laços',
            'slug' => Str::slug('Laços'),
        ]);
        factory(Category::class)->create([
            'category_name' => 'Tiaras',
            'slug' => Str::slug('Tiaras'),
        ]);
        factory(Category::class)->create([
            'category_name' => 'Viseiras',
            'slug' => Str::slug('Viseiras'),
        ]);
        factory(Category::class)->create([
            'category_name' => 'Faixas Para Bebe',
            'slug' => Str::slug('Faixas Para Bebe'),
        ]);
        factory(Category::class, 20)->create();
    }
}
