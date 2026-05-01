<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Student User',
            'email' => 'student@gmail.com',
            'role' => 'student',
        ]);
        User::factory()->create([
            'name' => 'Teacher User',
            'email' => 'teacher@gmail.com',
            'role' => 'teacher',
        ]);
    }
}
