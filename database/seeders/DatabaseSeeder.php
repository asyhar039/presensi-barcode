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
        // User::factory(10)->create();

        // create or update admin user
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'), // credentials below
            ]
        );

        // seed sample student
        $this->call(\Database\Seeders\StudentSeeder::class);
    }
}
