<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\ReportUser;
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
            'name' => 'Перечень реализуемых образовательных программ среднего профессионального образования и информация по контингенту по состоянию на 01.10.2022',
            'link' => 'records'
        ]);

        $users = [2, 3, 4, 5, 6];

        foreach ($users as $user) {
            $report_user[] = [
                'user_id' => $user,
                'report_id' => 1
            ];
        }

        ReportUser::query()->insert($report_user);

        /*
        Report::query()->create([
            'name' => 'Сведения по численности студентов, относящихся к категории инвалиды и лица с ОВЗ, по специальностям, профессиям',
            'link' => 'records'
        ]);
        Report::query()->create([
            'name' => 'Распределение численности основного персонала по уровню образования и полу (без внешних совместителей и работающих по договорам гражданско-правового характера)',
            'link' => 'records'
        ]);
        Report::query()->create([
            'name' => 'Распределение персонала по стажу работы (без внешних совместителей и работающих по договорам гражданско-правового характера)',
            'link' => 'records'
        ]);
        */
    }
}
