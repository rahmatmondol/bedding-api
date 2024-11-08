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
            'last_name' => $this->faker->lastName,
            'country' => $this->faker->country,
            'bio' => $this->faker->text,
            'image' => $this->faker->imageUrl(),
            'location' => $this->faker->city,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'language' => $this->faker->randomElement(['English', 'Arabic']),
        ];
    }
}
