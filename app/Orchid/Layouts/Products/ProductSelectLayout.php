<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Products;

use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Select;

use App\Models\ProductType;
use App\Models\Manufacturer;

class ProductSelectLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        $manufacturers = Manufacturer::orderBy('name', 'asc')->get()->pluck('name', 'id')->toArray();
        $productTypes = ProductType::orderBy('category_id', 'asc')->orderBy('name__ru', 'asc')->get()->pluck('name__ru', 'id')->toArray();

        return [
            Select::make('products.manufacturer_id')
                ->options($manufacturers)
                ->title('Manufacturer')
                ->empty('Not selected')
                ->required(),

            Select::make('products.type_id')
                ->options($productTypes)
                ->title('Product Type')
                ->empty('Not selected')
                ->required(),
        ];
    }
}
