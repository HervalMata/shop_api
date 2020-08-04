<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(ColorsSeeder::class);
        $this->call(MaterialsSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(ProductPhotosSeeder::class);
    }
}
