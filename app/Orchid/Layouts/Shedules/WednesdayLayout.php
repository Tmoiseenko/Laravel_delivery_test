<?php

namespace App\Orchid\Layouts\Shedules;

use Illuminate\Support\Carbon;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class WednesdayLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'wednesday';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', 'Id Заказа')
                ->render(function ($wednesday) {
                    return $wednesday->id;
                }),
            TD::make('name', 'ФИО заказчика')
                ->render(function ($wednesday) {
                    return $wednesday->order->full_name;
                }),
            TD::make('name', 'Кол-во порций')
                ->render(function ($wednesday) {
                    return $wednesday->diet_quantity;
                }),
            TD::make('name', 'Дата доставки')
                ->render(function ($wednesday) {
                    return Carbon::create($wednesday->date)->toDateString();
                }),
            TD::make('name', 'Название рациона')
                ->render(function ($wednesday) {
                    return $wednesday->order->diet->title;
                }),
            TD::make('name', 'Тип доставки')
                ->render(function ($wednesday) {
                    return $wednesday->order->deliveryType->title;
                }),
            TD::make('name', 'Комментарий')
                ->render(function ($wednesday) {
                    return $wednesday->order->comment;
                }),
        ];
    }
}
