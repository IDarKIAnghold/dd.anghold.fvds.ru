<?php

namespace App\Orchid\Screens\Product;

use Orchid\Screen\Screen;

use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

use App\Orchid\Layouts\Products\ProductListLayout;
use App\Models\Products;

class ProductsScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'products' => Products::filters()
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
        return 'Product List';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('bs.plus-circle')
                ->href(route('platform.systems.products.create')),
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
            ProductListLayout::class
        ];
    }
    /**
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Request $request)
    {
        Products::where('id', $request->id)->delete();
        Toast::info(__('Product Type was removed'));

        return redirect()->route('platform.systems.products');
    }

}
