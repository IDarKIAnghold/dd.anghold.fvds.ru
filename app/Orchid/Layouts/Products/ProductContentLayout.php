<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Products;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class ProductContentLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('products.content')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Content'))
                ->placeholder(__('Content'))
                ->help(__('Product display content')),

            TextArea::make('products.description')
                ->rows(10)
                ->type('text')
                ->max(1000)
                ->required()
                ->title(__('Description'))
                ->placeholder(__('Description'))
                ->help(__('Product display description')),
        ];
    }
}
