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
            'active' => 1
        ]);
        factory(Category::class)->create([
            'category_name' => 'Tiaras',
            'slug' => Str::slug('Tiaras'),
            'active' => 1
        ]);
        factory(Category::class)->create([
            'category_name' => 'Viseiras',
            'slug' => Str::slug('Viseiras'),
            'active' => 1
        ]);
        factory(Category::class)->create([
            'category_name' => 'Faixas Para Bebe',
            'slug' => Str::slug('Faixas Para Bebe'),
            'active' => 1
        ]);
        factory(Category::class, 20)->create();
    }
}
