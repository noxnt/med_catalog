<?php

namespace Database\Seeders;

use App\Models\Maker;
use App\Models\Product;
use App\Models\Substance;
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
        Maker::factory(5)->create();
        Substance::factory(30)->create();
        Product::factory(70)->create();
    }
}
