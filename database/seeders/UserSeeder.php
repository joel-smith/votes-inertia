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
        User::factory()->create([
            'name' => 'A User',
            'email' => 'alpha@example.com',
            'password'=> 'asdfasdf',
        ]);

        User::factory()->create([
            'name' => 'B User',
            'email' => 'bravo@example.com',
            'password'=> 'asdfasdf',
        ]);

    }
}
