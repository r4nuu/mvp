<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all projects
        $projects = Project::all();
        
        foreach ($projects as $project) {
            // Create units for each project (between 5-20 units per project)
            $unitCount = fake()->numberBetween(5, 20);
            
            for ($i = 1; $i <= $unitCount; $i++) {
                Unit::create([
                    'project_id' => $project->id,
                    'unit_number' => $this->generateUnitNumber($i),
                    'building' => fake()->randomElement(['Block A', 'Block B', 'Tower 1', 'Tower 2', 'Main Building', null]),
                    'floor' => fake()->numberBetween(1, 15),
                    'view' => fake()->randomElement(['Sea View', 'Garden View', 'City View', 'Mountain View', 'Pool View', null]),
                    'area' => fake()->randomFloat(2, 45, 200),
                    'price' => fake()->numberBetween(80000, 800000),
                    'status' => fake()->randomElement(['available', 'available', 'available', 'reserved', 'sold']),
                ]);
            }
        }
    }
    
    private function generateUnitNumber($index): string
    {
        $prefixes = ['A', 'B', 'C', 'D'];
        $prefix = fake()->randomElement($prefixes);
        $number = str_pad($index * 10 + fake()->numberBetween(1, 9), 3, '0', STR_PAD_LEFT);
        
        return $prefix . '-' . $number;
    }
}
