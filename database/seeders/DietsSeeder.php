<?php

namespace Database\Seeders;

use App\Models\Diet;
use Illuminate\Database\Seeder;

class DietsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $variation = ['Базовое', 'Разнообразное', 'Премиум', 'Вегитарианское'];
        foreach ($variation as $item) {
            Diet::factory()->create(['title' => $item]);
        }
    }
}
