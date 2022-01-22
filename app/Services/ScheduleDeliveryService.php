<?php

namespace App\Services;

use App\Contracts\Service\ScheduleDeliveryServiceContract;
use App\Models\Order;
use App\Models\Schedule;
use Illuminate\Support\Carbon;

class ScheduleDeliveryService implements ScheduleDeliveryServiceContract
{
    public function getSсhedule()
    {
        $shedules = Schedule::with('order')->where('date', '>=', Carbon::now()->startOfWeek()->toDateString())
            ->where('date', '<=', Carbon::now()->endOfWeek()->toDateString())
            ->get();
        $schedulesSortedByDays = [];
        foreach ($shedules as $item) {
            $schedulesSortedByDays[Carbon::create($item->date)->dayOfWeek][] = $item;
        }
        return $schedulesSortedByDays;
    }

    public function setSchedule(Order $order)
    {
        $start = Carbon::create($order->delivery_start);
        $end = Carbon::create($order->delivery_end);
        $dateCount = $end->diffInDays($start) + 1;
        switch ($order->delivery_variation_id) {
            case 1:
                while ($dateCount !== 0) {
                    $schedule = new Schedule();
                    if (!in_array($start->dayOfWeekIso, [6, 7])) {
                        $schedule->fill([
                            'order_id' => $order->id,
                            'diet_quantity' => 1,
                            'date' => $start
                        ])->save();
                    }
                    $start->addDay(1);
                    $dateCount--;
                }
                break;
            case 2:
                while ($dateCount !== 0) {
                    $schedule = new Schedule();
                    if (!in_array($start->dayOfWeekIso, [6, 7])
                        && $order->days()->pluck('days_week_name_id')->contains($start->dayOfWeekIso)
                        && $end >= $start) {
                        $schedule->fill([
                            'order_id' => $order->id,
                            'diet_quantity' => 1,
                            'date' => $start
                        ])->save();
                    }
                    $start->addDay(1);
                    $dateCount--;
                }
                break;
            case 3;
                while ($dateCount !== 0 || $end >= $start) {
                    $schedule = new Schedule();
                    if (!in_array($start->dayOfWeekIso, [6, 7])
                        && $order->days()->pluck('days_week_name_id')->contains($start->dayOfWeekIso)
                        && $end >= $start) {
                        $schedule->fill([
                            'order_id' => $order->id,
                            'diet_quantity' => 2,
                            'date' => $start
                        ])->save();
                    }
                    $start->addDay(1);
                    $dateCount--;
                }
                break;
        }
    }
}
