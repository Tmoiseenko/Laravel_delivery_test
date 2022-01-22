<?php

namespace Database\Seeders;

use App\Models\DaysWeekName;
use Database\Factories\DaysWeekNameFactory;
use Illuminate\Database\Seeder;

class DaysWeekNamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daysWeek = [
            'Понедельник',
            'Вторник',
            'Среда',
            'Четверг',
            'Пятница',
            'Суббота',
            'Воскресение',
        ];

        foreach ($daysWeek as $day) {
            DaysWeekName::factory()->create(['title' => $day]);
        }
    }
}
