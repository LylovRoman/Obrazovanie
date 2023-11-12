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
            'name' => 'Министерство образования Оренбургской области',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);
        User::query()->create([
            'login' => 'ONT',
            'name' => 'Орский Нефтяной Техникум',
            'password' => bcrypt('password'),
            'role' => 'user'
        ]);
        User::query()->create([
            'login' => 'OTT',
            'name' => 'Орский Технический Техникум',
            'password' => bcrypt('password'),
            'role' => 'user'
        ]);
        User::query()->create([
            'login' => 'MGU',
            'name' => 'Московский Гуманитарный Университет',
            'password' => bcrypt('password'),
            'role' => 'user'
        ]);
    }
}
