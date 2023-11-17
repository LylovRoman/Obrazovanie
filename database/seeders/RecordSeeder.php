<?php

namespace Database\Seeders;

use App\Models\Record;
use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Seeder;

class RecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Record::factory(10)->create();
    }
}
