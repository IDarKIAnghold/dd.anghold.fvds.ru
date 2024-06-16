<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Products;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class ProductPriceLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('products.price')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Price'))
                ->placeholder(__('Price'))
                ->help(__('Product display price')),

            Input::make('products.discount')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Discount'))
                ->placeholder(__('Discount'))
                ->help(__('Product display discount')),
        ];
    }
}
