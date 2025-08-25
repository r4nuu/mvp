<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unit>
 */
class UnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $views = ['Sea View', 'Garden View', 'City View', 'Mountain View', 'Pool View', 'Street View', null];
        $buildings = ['Block A', 'Block B', 'Tower 1', 'Tower 2', 'Main Building', null];
        
        return [
            'project_id' => \App\Models\Project::factory(),
            'unit_number' => fake()->randomElement(['A', 'B', 'C']) . '-' . fake()->numberBetween(101, 999),
            'building' => fake()->randomElement($buildings),
            'floor' => fake()->numberBetween(1, 20),
            'view' => fake()->randomElement($views),
            'area' => fake()->randomFloat(2, 50, 250), // Area between 50-250 sq meters
            'price' => fake()->numberBetween(100000, 1000000), // Price between $100k-$1M
            'status' => fake()->randomElement(['available', 'available', 'available', 'reserved', 'sold']), // More likely to be available
        ];
    }
}
