<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Tanggol Di Maggiba',
            'email' => 'tanggol123@example.com',
            'role' => 'user',
            'password' => 'tanggol123',
        ]);

        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin123@example.com',
            'role' => 'admin',
            'password' => 'admin123',
        ]);
    }
}
