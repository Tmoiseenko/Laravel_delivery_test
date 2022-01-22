<?php

namespace App\Orchid\Layouts\Shedules;

use Illuminate\Support\Carbon;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class FridayLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'friday';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', 'Id Заказа')
                ->render(function ($friday) {
                    return $friday->id;
                }),
            TD::make('name', 'ФИО заказчика')
                ->render(function ($friday) {
                    return $friday->order->full_name;
                }),
            TD::make('name', 'Кол-во порций')
                ->render(function ($friday) {
                    return $friday->diet_quantity;
                }),
            TD::make('name', 'Дата доставки')
                ->render(function ($friday) {
                    return Carbon::create($friday->date)->toDateString();
                }),
            TD::make('name', 'Название рациона')
                ->render(function ($friday) {
                    return $friday->order->diet->title;
                }),
            TD::make('name', 'Тип доставки')
                ->render(function ($friday) {
                    return $friday->order->deliveryType->title;
                }),
            TD::make('name', 'Комментарий')
                ->render(function ($friday) {
                    return $friday->order->comment;
                }),
        ];
    }
}
