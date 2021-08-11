<?php

namespace Database\Factories;

use App\Models\Substance;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubstanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Substance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
        ];
    }
}
