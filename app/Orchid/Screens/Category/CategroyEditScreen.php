<?php

namespace App\Orchid\Screens\Category;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Orchid\Layouts\Category\CategorySelectLayout;
use App\Orchid\Layouts\Category\CategoryInputLayout;

use App\Models\ProductType;

class CategroyEditScreen extends Screen
{
    public $productTypes;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(ProductType $productTypes): iterable
    {
        return [
            'productTypes' => $productTypes
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Categroy Edit';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('save'),

            Button::make(__('Remove'))
                ->icon('bs.trash3')
                ->method('remove')
                ->canSee($this->productTypes->exists),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::block([
                CategorySelectLayout::class
            ])->title('Select a category')->description(''),

            Layout::block([
                CategoryInputLayout::class
            ])->title('Select a category')->description('')
        ];
    }
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, ProductType $productTypes)
    {
        $productTypes->fill($request->get('productTypes'));
        $productTypes->name = mb_strtolower(str_replace(' ', '-', $productTypes->name));
        $productTypes->save();
        Toast::info(__('Product Type was saved'));

        return redirect()->route('platform.systems.category');
    }
    /**
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(ProductType $productTypes)
    {
        $productTypes->delete();

        Toast::info(__('Product Type was removed'));

        return redirect()->route('platform.systems.category');
    }
}
