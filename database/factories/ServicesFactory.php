<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Services>
 */
class ServicesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 'title', // string
        // 'slug', // string
        // 'description', // text
        // 'price', // float
        // 'priceType', // Enum: Nagotiation, Fixed // string
        // 'currency', // Enum: AED, USD // string
        // 'status', // Enum: requested, accepted, completed // string
        // 'level',  // Enum: Entry, Intermediate, Expert // string
        // 'deadline', // date time
        // 'is_featured', // boolean
        // 'commission', // int

        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(),
            'priceType' => $this->faker->randomElement(['Negotiable', 'Fixed']),
            'currency' => $this->faker->randomElement(['AED', 'USD']),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'level' => $this->faker->randomElement(['Entry', 'Intermediate', 'Expert']),
            'deadline' => $this->faker->dateTime,
            'is_featured' => $this->faker->boolean,
            'category_id' => $this->faker->numberBetween(1, 10),
            'sub_category_id' => $this->faker->numberBetween(1, 50),
            'location' => $this->faker->city,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'user_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
