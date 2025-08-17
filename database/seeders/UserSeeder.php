<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 sample users
        User::factory(10)->create();
        
        // Create a specific test user
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'date_of_birth' => '1990-01-15',
            'phone_number' => '+1234567890',
            'gender' => 'male',
        ]);
        
        User::factory()->create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'date_of_birth' => '1985-06-20',
            'phone_number' => '+0987654321',
            'gender' => 'female',
        ]);
    }
}
