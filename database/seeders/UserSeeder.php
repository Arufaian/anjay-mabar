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
        User::factory()->create([
            'name' => 'Alfian',
            'email' => 'test@example.com',
            'password' => bcrypt('@Admin123'),
            'role' => 'admin',
        ]);

    }
}
