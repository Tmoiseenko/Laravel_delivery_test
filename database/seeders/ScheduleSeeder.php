<?php

namespace Database\Seeders;

use App\Contracts\Service\ScheduleDeliveryServiceContract;
use App\Models\Order;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ScheduleDeliveryServiceContract $scheduleService)
    {
        $orders = Order::all();
        foreach ($orders as $order) {
            $scheduleService->setSchedule($order);
        }
    }
}
