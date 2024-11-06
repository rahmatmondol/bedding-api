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
            'title' => $this->faker->title,
            'slug' => $this->faker->slug,
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(),
            'priceType' => $this->faker->randomElement(['Nagotiation', 'Fixed']),
            'currency' => $this->faker->randomElement(['AED', 'USD']),
            'status' => $this->faker->randomElement(['requested', 'accepted', 'completed']),
            'level' => $this->faker->randomElement(['Entry', 'Intermediate', 'Expert']),
            'deadline' => $this->faker->dateTime,
            'is_featured' => true,
            'commission' => $this->faker->randomNumber(),
        ];
    }
}
