<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Contracts\Service\ScheduleDeliveryServiceContract;
use App\Models\Order;
use App\Models\Schedule;
use App\Orchid\Layouts\MainLayout;
use App\Orchid\Layouts\Shedules\FridayLayout;
use App\Orchid\Layouts\Shedules\MondayLayout;
use App\Orchid\Layouts\Shedules\ThursdayLayout;
use App\Orchid\Layouts\Shedules\TuesdayLayout;
use App\Orchid\Layouts\Shedules\WednesdayLayout;
use App\Orchid\Screens\Order\MainScreen;
use Illuminate\Support\Carbon;
use Orchid\Platform\Models\Role;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class PlatformScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Get Started';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Welcome to your Orchid application.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(ScheduleDeliveryServiceContract $scheduleService): array
    {
        $schedules = $scheduleService->getSсhedule();

        return [
            'monday' => $schedules[1] ?? [],
            'tuesday' => $schedules[2] ?? [],
            'wednesday' => $schedules[3] ?? [],
            'thursday' => $schedules[4] ?? [],
            'friday' => $schedules[5] ?? [],
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Создать заказ')
                ->route('platform.orders.create')
                ->icon('note'),

        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::tabs([
                'Понедельник' => MondayLayout::class,
                'Вторник' => TuesdayLayout::class,
                'Среда' => WednesdayLayout::class,
                'Четверг' => ThursdayLayout::class,
                'Пятница' => FridayLayout::class,
                ])
        ];
    }
}
