<?php

namespace App\Orchid\Screens\Category;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

use App\Orchid\Layouts\Category\CategoryListLayout;

use App\Models\ProductType;

class CategoryScreen extends Screen
{
    /**
     * @var string
     */
    public $productTypes;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'productTypes' => ProductType::filters()
                ->defaultSort('id', 'desc')
                ->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Category Screen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make(__('Add'))
                ->icon('bs.plus-circle')
                ->href(route('platform.systems.category.create')),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            CategoryListLayout::class
        ];
    }
    /**
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Request $request)
    {
        ProductType::where('id', $request->id)->delete();
        Toast::info(__('Product Type was removed'));

        return redirect()->route('platform.systems.category');
    }
}

