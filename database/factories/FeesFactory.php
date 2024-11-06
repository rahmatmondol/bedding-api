<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fees>
 */
class FeesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 'name', // string
        // 'description', // text
        // 'amount', // float
        // 'currency', // enum: AED, USD
        // 'status', // enum: Active, Inactive
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'amount' => $this->faker->randomFloat(),
            'currency' => $this->faker->randomElement(['AED', 'USD']),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
