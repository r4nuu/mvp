<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 15 sample projects
        Project::factory(15)->create();
        
        // Create some specific test projects
        Project::factory()->create([
            'name' => 'Sunset Gardens Residences',
            'address' => '123 Main Street, Downtown, State 12345',
            'year_of_creation' => 2020,
            'number_of_available_units' => 120,
            'owner_phone_number' => '+1-555-0123',
        ]);
        
        Project::factory()->create([
            'name' => 'Modern City Towers',
            'address' => '456 Oak Avenue, Midtown, State 67890',
            'year_of_creation' => 2022,
            'number_of_available_units' => 75,
            'owner_phone_number' => null, // No phone number
        ]);
        
        Project::factory()->create([
            'name' => 'Riverside Heights',
            'address' => '789 River Road, Riverdale, State 54321',
            'year_of_creation' => 2018,
            'number_of_available_units' => 200,
            'owner_phone_number' => '+1-555-9876',
        ]);
    }
}
