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
        User::query()->create([
            'login' => 'Admin',
            'name' => 'Министерство',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);
        User::query()->create([
            'login' => 'ONT',
            'name' => 'Орский Нефтяной Техникум',
            'password' => bcrypt('password'),
            'role' => 'user'
        ]);
    }
}
