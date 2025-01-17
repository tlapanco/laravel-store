<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
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
            'name' => fake()->words(4, true),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 0, 1000),
            'status' => fake()->boolean(50),
            'category_id' => Category::factory(),
            'deleted_at' => $this->randomTrashed(),
            
        ];
    }

    private function randomTrashed()
    {
        if (fake()->boolean(50) == true)
        {
            return now();
        } else {
            return null;
        }

    }
}
