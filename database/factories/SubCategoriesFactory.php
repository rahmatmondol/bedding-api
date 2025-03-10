<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategories>
 */
class SubCategoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->sentence(),
            'category_id' => $this->faker->numberBetween(1, 10),
            'image' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
