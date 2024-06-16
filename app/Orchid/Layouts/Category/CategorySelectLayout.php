<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Category;
use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;

use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

use App\Models\ProductType;
use App\Models\Categorys;
class CategorySelectLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        $categorys = Categorys::get()->pluck('name_ru', 'id')->toArray();
        return [
            Select::make('productTypes.category_id')
                ->options($categorys)
                ->title('Category')
                ->empty('Not selected')
                ->required(),
        ];
    }
}

