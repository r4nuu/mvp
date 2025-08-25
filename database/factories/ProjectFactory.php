<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company() . ' ' . fake()->randomElement(['Residences', 'Towers', 'Gardens', 'Plaza', 'Heights', 'View', 'Court']),
            'address' => fake()->streetAddress() . ', ' . fake()->city() . ', ' . fake()->state() . ' ' . fake()->postcode(),
            'year_of_creation' => fake()->numberBetween(2000, now()->year),
            'owner_phone_number' => fake()->optional(0.7)->phoneNumber(), // 70% chance of having a phone number
        ];
    }
}
