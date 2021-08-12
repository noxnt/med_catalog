<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Maker;
use App\Models\Substance;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3) . rand(0, 500),
            'substance_id' => Substance::get()->random()->id,
            'maker_id' => Maker::get()->random()->id,
            'price' => rand(50, 1000),
        ];
    }
}
