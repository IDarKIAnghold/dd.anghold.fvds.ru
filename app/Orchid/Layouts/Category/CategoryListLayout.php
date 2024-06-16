<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Category;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Toast;

use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

use App\Models\ProductType;

class CategoryListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'productTypes';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name__ru', __('Name (Russian)'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (ProductType $productTypes) {
                    return Link::make($productTypes->name__ru)
                        ->route('platform.systems.category.edit', $productTypes->id);
                }),

            TD::make('name', __('Name (English)'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (ProductType $productTypes) {
                    return Link::make($productTypes->name)
                        ->route('platform.systems.category.edit', $productTypes->id);
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
                ->render(function (ProductType $productTypes) {
                    return DropDown::make()
                        ->icon('bs.three-dots-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.systems.category.edit', $productTypes->id)
                                ->icon('bs.pencil'),
                            Button::make(__('Delete'))
                                ->icon('bs.trash3')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('remove', [
                                    'id' => $productTypes->id,
                                ]),
                        ]);
                }),
        ];
    }
}
