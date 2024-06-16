<?php

namespace App\Orchid\Screens\Product;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

use App\Helpers\StringHelper;

use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Upload;

use App\Orchid\Layouts\Products\ProductImageLayout;
use App\Orchid\Layouts\Products\ProductNameLayout;
use App\Orchid\Layouts\Products\ProductContentLayout;
use App\Orchid\Layouts\Products\ProductPriceLayout;
use App\Orchid\Layouts\Products\ProductSelectLayout;

use App\Models\ProductAttributes;
use App\Models\Products;
use App\Models\ProductType;
use App\Models\Attributes;
use App\Models\Attachment;

class ProductsEditScreen extends Screen
{
    /**
     * @var Products
     */
    public $products;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Products $products): array
    {
        return [
            'products' => $products,
        ];
    }
    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        // return $this->products->exists;
        return 'Product Edit';

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

            Button::make(__('Remove'))
                ->icon('bs.trash3')
                ->method('remove')
                ->canSee($this->products->exists),

            Link::make(__('Edit attributes'))
                ->canSee($this->products->exists)
                ->icon('bs')
                ->href(route('platform.systems.products.attributes', $this->products->id))
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
            Layout::block([
                ProductImageLayout::class
            ])->title('Image')->description(''),

            Layout::block([
                ProductNameLayout::class,
            ])->title('Name')->description(''),

            Layout::block([
                ProductContentLayout::class,
            ])->title('Content and description')->description(''),

            Layout::block([
                ProductPriceLayout::class
            ])->title('Price and discount')->description(''),

            Layout::block([
                ProductSelectLayout::class
            ])->title('Manafacturer and type')->description(''),

            Layout::block([])->title(' ')->description(' '),
            Layout::block([])->title(' ')->description(' '),
        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, Products $products)
    {
        $products->fill($request->get('products'));
        $stringHelper = new StringHelper();
        $products->slug = $stringHelper->translit_sef($products->name);

        $category = ProductType::with('category')->findOrFail($products->type_id);
        $attributes = Attributes::where('category_id', $category->category->id)->get();

        if ($category->category->id != $this->products->type->category->id || !$products->ProductAttributes()->exists()) {
            DB::table('product_attributes')->where('product_id', $this->products->id)->delete();
            $products->ProductAttributes()->createMany($attributes->map(fn($attr) => ['attributes_id' => $attr->id]));
        }

        if (isset($request->products['attachments'])) {
            $attachments = collect($request->products['attachments'])
                ->map(fn($id) => Attachment::find($id))
                ->sortBy('sort')
                ->pluck('id');

            $products->img = json_encode($attachments->map(fn($id) => Attachment::find($id)->name . '.' . Attachment::find($id)->extension)->all());
            $products->attachments = json_encode($attachments->all());
        }

        $products->save();
        Toast::info(__($products->name . ' Save'));

        return redirect()->route('platform.systems.products');
    }

    /**
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Products $products)
    {
        $products->delete();

        Toast::info(__('Product was removed'));

        return redirect()->route('platform.systems.products');
    }
}
