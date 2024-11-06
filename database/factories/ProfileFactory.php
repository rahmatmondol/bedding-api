<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 'lastName', // string
        // 'country', // string
        // 'bio', // text
        // 'language', // enum: English, Arabic // string
        // 'image_id', // int
        // 'location_id', // int
        return [
            'lastName' => $this->faker->lastName,
            'country' => $this->faker->country,
            'bio' => $this->faker->text,
            'language' => $this->faker->randomElement(['English', 'Arabic']),
        ];
    }
}
