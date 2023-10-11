<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Report::query()->create([
            'name' => 'Отчёт',
            'user_id' => 2,
        ]);
        Report::query()->create([
            'name' => 'Важный отчёт',
            'user_id' => 2,
        ]);
    }
}
