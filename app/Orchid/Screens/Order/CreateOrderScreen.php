<?php

namespace App\Orchid\Screens\Order;

use App\Contracts\Service\ScheduleDeliveryServiceContract;
use App\Models\DaysWeekName;
use App\Models\DeliveryVariation;
use App\Models\Diet;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class CreateOrderScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Создание заказа';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(User $user): array
    {
        return ['user' => $user];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Сохранить')
                ->icon('save')
                ->method('createOrder'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::columns([
                Layout::rows([
                    Input::make('order.full_name')
                        ->title('ФИО'),
                    Input::make('order.phone')
                        ->title('Телефон')
                        ->mask('+7(999) 999-99-99')
                        ->placeholder('+7(xxx)-xxx-xx-xx'),
                    Relation::make('order.diet_id')
                        ->fromModel(Diet::class, 'title')
                        ->title('Рацион'),
                    Relation::make('order.delivery_variation_id')
                        ->fromModel(DeliveryVariation::class, 'title')
                        ->title('Расписание доставки'),
                ]),
                Layout::rows([
                    Relation::make('days')
                        ->fromModel(  DaysWeekName::class, 'title')
                        ->multiple()
                        ->title('Дни недели'),
                    DateTimer::make('order.delivery_start')
                        ->title('Дата начала доставки'),
                    DateTimer::make('order.delivery_end')
                        ->title('Дата окончания доставки'),
                ]),
            ]),
            Layout::rows([
                Quill::make('order.comment')
                    ->title('Комментарий')
            ])
        ];
    }

    public function createOrder(Order $order, Request $request, ScheduleDeliveryServiceContract $scheduleService)
    {
        $req = $request->validate([
            'order.full_name' => 'required',
            'order.phone' => 'required',
            'order.diet_id' => 'required',
            'order.delivery_variation_id' => 'required',
            'order.delivery_start' => 'required',
            'order.delivery_end' => 'required',
            'days' => 'exclude_if:order.delivery_variation_id,1|required',
        ]);
        $order->fill($req['order'])->save();
        if ($request->input('days')) {
            $order->days()->attach($request->input('days'));
        }
        $scheduleService->setSchedule($order);
        Alert::info('Заказ успешно создан');
        return redirect()->route('platform.index');
    }
}
