<?php

namespace App\Orchid\Layouts\Shedules;

use Illuminate\Support\Carbon;
use Orchid\Platform\Models\Role;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class MondayLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'monday';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', 'Id Заказа')
                ->render(function ($monday) {
                    return $monday->id;
                }),
            TD::make('name', 'ФИО заказчика')
                ->render(function ($monday) {
                    return $monday->order->full_name;
                }),
            TD::make('name', 'Кол-во порций')
                ->render(function ($monday) {
                    return $monday->diet_quantity;
                }),
            TD::make('name', 'Дата доставки')
                ->render(function ($monday) {
                    return Carbon::create($monday->date)->toDateString();
                }),
            TD::make('name', 'Название рациона')
                ->render(function ($monday) {
                    return $monday->order->diet->title;
                }),
            TD::make('name', 'Тип доставки')
                ->render(function ($monday) {
                    return $monday->order->deliveryType->title;
                }),
            TD::make('name', 'Комментарий')
                ->render(function ($monday) {
                    return $monday->order->comment;
                }),
        ];
    }
}
