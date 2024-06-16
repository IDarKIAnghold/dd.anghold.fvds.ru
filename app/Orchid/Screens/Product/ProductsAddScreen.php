<?php

namespace App\Orchid\Screens\Product;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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

class ProductsAddScreen extends Screen
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
        return 'Product Create';

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
        function translit_sef($value)
        {
            $converter = array(
                'а' => 'a',
                'б' => 'b',
                'в' => 'v',
                'г' => 'g',
                'д' => 'd',
                'е' => 'e',
                'ё' => 'e',
                'ж' => 'zh',
                'з' => 'z',
                'и' => 'i',
                'й' => 'y',
                'к' => 'k',
                'л' => 'l',
                'м' => 'm',
                'н' => 'n',
                'о' => 'o',
                'п' => 'p',
                'р' => 'r',
                'с' => 's',
                'т' => 't',
                'у' => 'u',
                'ф' => 'f',
                'х' => 'h',
                'ц' => 'c',
                'ч' => 'ch',
                'ш' => 'sh',
                'щ' => 'sch',
                'ь' => '',
                'ы' => 'y',
                'ъ' => '',
                'э' => 'e',
                'ю' => 'yu',
                'я' => 'ya',
            );

            $value = mb_strtolower($value);
            $value = strtr($value, $converter);
            $value = mb_ereg_replace('[^-0-9a-z]', '-', $value);
            $value = mb_ereg_replace('[-]+', '-', $value);
            $value = trim($value, '-');

            return $value;

        }
        $products->fill($request->get('products'));
        $products->slug = translit_sef($products->name);

        if (isset($request->products['attachments'])) {
            $attachment = [];
            $attachments = [];
            $img = [];

            foreach ($request->products['attachments'] as $key) {
                $attachment[] = Attachment::find($key);
            }
            $attachment = collect($attachment)->sortBy('sort')->toArray();
            foreach ($attachment as $key) {
                $attachments[] = $key['id'];
            }
            foreach ($attachments as $key) {
                $Attachment = Attachment::find($key);
                $img[] = $Attachment->name . '.' . $Attachment->extension;
            }

            $products->img = json_encode($img);
            $products->attachments = json_encode($attachments);
        }
        $products->save();

        $category = ProductType::with('category')->findOrFail($products->type_id);
        $attributes = Attributes::where('category_id', $category->category->id)->get();
        foreach ($attributes as $key) {
            ProductAttributes::create([
                'attributes_id' => $key->id,
                'product_id' => $products->id,
                'value' => null,
            ]);
        }

        Toast::info(__($products->name . ' Save'));

        return redirect()->route('platform.systems.products.attributes', $products->id);
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
