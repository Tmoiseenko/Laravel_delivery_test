<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i =30;
        while ($i != 0) {
            $order = Order::factory()->create([
                'diet_id' => rand(1, 4),
                'delivery_start' => Carbon::now()->subDays(rand(7, 25)),
                'delivery_end' => Carbon::now()->addDays(rand(7, 25)),
                'delivery_variation_id' => rand(1, 3),
            ]);

            if ($order->delivery_variation_id != 1) {
                $days = rand(1, 9)  % 2 === 0 ? [2, 4] : [1, 3, 5];
                $order->days()->attach($days);
            }

            $i--;
        }
    }
}
