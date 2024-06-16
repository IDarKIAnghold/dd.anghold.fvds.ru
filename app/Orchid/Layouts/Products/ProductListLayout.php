<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Products;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;

use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

use App\Models\Products;

class ProductListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'products';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', __('Name'))
                ->sort()
                ->filter(Input::make())
                ->render(function (Products $products) {
                    return Link::make($products->name)
                        ->route('platform.systems.products.edit', $products->id);
                }),

            // TD::make('Slug', __('Slug'))
            //     ->sort()
            //     ->filter(Input::make())
            //     ->render(function (Products $products) {
            //         return Link::make('' . $products->slug)
            //             ->route('platform.systems.products.edit', $products->id);
            //     }),

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
                ->render(fn(Products $products) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Link::make(__('Edit'))
                            ->route('platform.systems.products.edit', $products->id)
                            ->icon('bs.pencil'),
                        Link::make(__('Edit attributes'))
                            ->icon('bs')
                            ->href(route('platform.systems.products.attributes', $products->id)),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove', [
                                'id' => $products->id,
                            ]),
                    ])),
        ];
    }
}
