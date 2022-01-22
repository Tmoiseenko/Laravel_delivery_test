<?php

namespace App\Orchid\Layouts\Shedules;

use Illuminate\Support\Carbon;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TuesdayLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'tuesday';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', 'Id Заказа')
                ->render(function ($tuesday) {
                    return $tuesday->id;
                }),
            TD::make('name', 'ФИО заказчика')
                ->render(function ($tuesday) {
                    return $tuesday->order->full_name;
                }),
            TD::make('name', 'Кол-во порций')
                ->render(function ($tuesday) {
                    return $tuesday->diet_quantity;
                }),
            TD::make('name', 'Дата доставки')
                ->render(function ($tuesday) {
                    return Carbon::create($tuesday->date)->toDateString();
                }),
            TD::make('name', 'Название рациона')
                ->render(function ($tuesday) {
                    return $tuesday->order->diet->title;
                }),
            TD::make('name', 'Тип доставки')
                ->render(function ($tuesday) {
                    return $tuesday->order->deliveryType->title;
                }),
            TD::make('name', 'Комментарий')
                ->render(function ($tuesday) {
                    return $tuesday->order->comment;
                }),
        ];
    }
}
