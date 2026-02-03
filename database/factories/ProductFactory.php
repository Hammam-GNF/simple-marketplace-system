<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => ucfirst($this->faker->words(2, true)),
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->numberBetween(10_000, 2_000_000),
            'stock' => $this->faker->numberBetween(0, 100),
            'category_id' => Category::factory(),
        ];
    }
}
