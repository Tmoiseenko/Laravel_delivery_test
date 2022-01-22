<?php

namespace App\Contracts\Service;

use App\Models\Order;

interface ScheduleDeliveryServiceContract
{
    public function getSсhedule();
    public function setSchedule(Order $order);
}
