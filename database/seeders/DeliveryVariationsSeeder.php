<?php

namespace Database\Seeders;

use App\Models\DaysWeekName;
use App\Models\DeliveryVariation;
use Database\Factories\DaysWeekNameFactory;
use Illuminate\Database\Seeder;

class DeliveryVariationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $variation = ['Ежедневная', 'Через день на один день', 'Через день на два дня'];
        foreach ($variation as $item) {
            DeliveryVariation::factory()->create(['title' => $item]);
        }
    }
}
