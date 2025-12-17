<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->createMany([
            [
                'name' => 'Alfian',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'User',
                'email' => 'user@example.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Owner',
                'email' => 'owner@example.com',
                'password' => bcrypt('password'),
                'role' => 'owner',
                'email_verified_at' => now(),
            ],
        ],
        
    );

    }
}
