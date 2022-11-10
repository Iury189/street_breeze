<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Mario Brother',
            'email' => 'mario@world.com',
            'role' => 1,
            'password' => bcrypt('$12345678;'),
        ]);
    }
}
