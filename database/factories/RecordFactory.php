<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Record>
 */
class RecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'report_id' => 1,
            'user_id' => $this->faker->numberBetween(2, 4),
            'program' => $this->faker->randomElement(['ППССЗ', 'ППКРС']),
            'category' => $this->faker->randomElement(['ТОП-50', 'актуализированные', 'остальные', 'Профессионалитет']),
            'profession' => $this->faker->randomElement(['05.01.01 - Гидрометнаблюдатель', '05.02.01 - Картография', '05.02.03 - Метеорология', '08.01.23 - Бригадир-путеец', '08.01.22 - Мастер путевых машин']),
            'duration' => '3 года 10 месяцев',
            'form' => $this->faker->randomElement(['очная', 'заочная', 'очно-заочная']),
            'course' => $this->faker->numberBetween(1, 4),
            'avg_score' => $this->faker->randomFloat(2, 2, 5),
            'KCP' => $this->faker->numberBetween(15, 50),
            'students_federal' => $this->faker->numberBetween(15, 50),
            'students_subject' => $this->faker->numberBetween(15, 50),
            'students_target' => $this->faker->numberBetween(15, 50),
            'students_paid' => $this->faker->numberBetween(15, 50),
            'students_foreigner' => $this->faker->numberBetween(15, 50),
            'students_orphan' => $this->faker->numberBetween(15, 50),
            'students_without_care' => $this->faker->numberBetween(15, 50),
            'need' => $this->faker->numberBetween(15, 50),
            'provided' => $this->faker->numberBetween(15, 50),
            'refused' => $this->faker->numberBetween(15, 50),
            'release' => $this->faker->numberBetween(15, 50),
            'GIA' => $this->faker->numberBetween(15, 50),
            'interim_certification' => $this->faker->numberBetween(15, 50),
            'basic_level' => $this->faker->numberBetween(15, 50),
            'professional_level' => $this->faker->numberBetween(15, 50),
        ];
    }
}
