<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Manufacturers;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;

use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

use App\Models\Manufacturer;

class ManufacturersListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'manufacturers';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', __('name'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Manufacturer $manufacturers) {
                    return Link::make($manufacturers->name)
                        ->route('platform.systems.manufacturers.edit', $manufacturers->id);
                }),

            TD::make('created_at', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->sort(),

            TD::make('updated_at', __('Last edit'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->sort(),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn(Manufacturer $manufacturer) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.systems.manufacturers.edit', $manufacturer->id)
                            ->icon('bs.pencil'),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove', [
                                'id' => $manufacturer->id,
                            ]),
                    ])),
        ];
    }
}
