<?php

namespace App\Orchid\Screens\Product;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Select;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Action;

use App\Models\Products;

class AttributesEditScreen extends Screen
{
    public $products;
    public function query(Products $products): array
    {
        return [
            'products' => $products,
        ];
    }

    public function name(): ?string
    {
        return 'Product Attributes Edit';
        // return $this->products->ProductAttributes[0]->attributes->name;
    }

    public function description(): ?string
    {
        return '';
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('save'),
        ];
    }

    public function layout(): array
    {
        $fields = [];

        // Сортируем атрибуты по полю name в порядке возрастания
        $sortedAttributes = collect($this->products->ProductAttributes)->sortBy('attributes.name')->values();

        foreach ($sortedAttributes as $attribute) {
            if (stristr(mb_strtolower($attribute->attributes->name), 'наличие')) {
                $fields[] = Layout::rows([
                    Select::make("productAttributes.{$attribute->attributes_id}.value")
                        ->title($attribute->attributes->name)
                        ->options([
                            'Нет' => 'Нет',
                            'Да' => 'Да',
                        ])
                        ->empty('null')
                        ->value($attribute->value)
                ]);
            } else {
                $fields[] = Layout::rows([
                    Input::make("productAttributes.{$attribute->attributes_id}.value")
                        ->title($attribute->attributes->name)
                        ->value($attribute->value)
                ]);
            }
        }

        return [
            Layout::block($fields)
                ->title(__('Product Attributes'))
                ->description(__('Edit the product attributes below.'))
        ];
    }


    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, Products $products)
    {
        $productAttributesData = $request->input('productAttributes', []);

        foreach ($productAttributesData as $attributeId => $value) {
            $productAttribute = $products->productAttributes()->where('attributes_id', $attributeId)->first();
            $productAttribute->value = $value['value'];
            $productAttribute->save();
        }

        Toast::info(__('Attributes ' . $products->name . ' Saved'));

        return redirect()->route('platform.systems.products');
    }

}
