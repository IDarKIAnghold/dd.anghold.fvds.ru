<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Categorys;
use App\Models\ProductType;
use App\Models\Products;
use App\Models\Manufacturer;
use App\Models\Attributes;
use App\Models\ProductAttributes;

class GetController extends Controller
{
    public function catalogType(Request $request)
    {
        $filter = [];
        $category = ProductType::where('name', $request->type)->firstOrFail();
        $type = $request->type;
        $page = $request->has('page') && $request->page > 1 ? $request->page : 1;
        $limit = $request->has('limit') ? $request->limit : 16;
        $offset = $limit * ($page - 1);

        $query = Products::with('type', 'manufacturer')
            ->whereHas('type', function ($query) use ($type) {
                $query->where('name', $type);
            });

        $productIdsOnPage = $query->pluck('id')->toArray();
        $AbsoluteminPrice = Products::with('type')
            ->whereHas('type', function ($query) use ($type) {
                $query->where('name', $type);
            })->min('price');
        $AbsolutemaxPrice = Products::with('type')->whereHas('type', function ($query) use ($type) {
            $query->where('name', $type);
        })->max('price');

        //Запросы с Фильтрами
        $attributesIdOnFilter = [];
        $attributesValueOnFilter = [];
        foreach ($request->all() as $key => $value) {
            $attr = Attributes::where('name', mb_strtolower(str_replace('_', ' ', $key)))->first();
            if ($attr) {
                $attributesIdOnFilter[] = $attr->id;
                $attributesValueOnFilter[] = explode('-', $value);
            }
        }
        if (!empty($attributesIdOnFilter) && !empty($attributesValueOnFilter)) {
            foreach ($attributesIdOnFilter as $index => $attributeId) {
                $query->whereHas('ProductAttributes', function ($subQuery) use ($attributeId, $attributesValueOnFilter, $index) {
                    $subQuery->where('attributes_id', $attributeId)
                        ->whereIn('value', $attributesValueOnFilter[$index]);
                });
            }
        }

        if ($request->has('brand') && $request->brand != '') {
            $brands = explode("-", $request->brand);
            $query->whereIn('manufacturer_id', function ($subquery) use ($brands) {
                $subquery->select('id')
                    ->from('manufacturers')
                    ->whereIn('name', $brands);
            });
        }

        if ($request->has('price') && $request->price != '') {
            [$minPriceSearch, $maxPriceSearch] = explode('-', $request->price);
            $query->whereBetween('price', [(int) $minPriceSearch, (int) $maxPriceSearch]);
        }

        $uniqueAttributes = ProductAttributes::whereIn('product_id', $productIdsOnPage)->select('attributes_id', 'value')->distinct()->get();

        $formattedAttributes = [];

        foreach ($uniqueAttributes as $attribute) {
            $attributeName = Attributes::findOrFail($attribute->attributes_id)->name;
            if (array_key_exists($attributeName, $formattedAttributes) && $attribute->value != null) {
                $formattedAttributes[$attributeName][] = $attribute->value;
            } else if (!array_key_exists($attributeName, $formattedAttributes) && $attribute->value != null) {
                $formattedAttributes[$attributeName] = [$attribute->value];
            }
        }

        //Настройка Фильтров
        $minPrice = $query->min('price');
        $maxPrice = $query->max('price');

        $manufacturers = Products::whereHas('type', function ($query) use ($type) {
            $query->where('name', $type);
        })->pluck('manufacturer_id')->unique()->toArray();
        $manufacturerDetails = Manufacturer::whereIn('id', $manufacturers)->get();

        if ($AbsoluteminPrice && $AbsolutemaxPrice) {
            $filter['AbsoluteminPrice'] = $AbsoluteminPrice;
            $filter['AbsolutemaxPrice'] = $AbsolutemaxPrice;
        }
        if ($minPrice && $maxPrice) {
            $filter['minPrice'] = $minPrice;
            $filter['maxPrice'] = $maxPrice;
        }
        if ($manufacturerDetails->toArray()) {
            $filter['manufacturers'] = $manufacturerDetails->toArray();
        }
        if ($formattedAttributes) {
            $filter['attributes_filter'] = $formattedAttributes;
        }

        //Вывод данных
        $count = ceil($query->count() / $limit);
        $catalog = $query->offset($offset)->limit($limit)->get();

        if (count($filter) == 0) {
            $filter = '';
        }

        return Inertia::render('catalog', [
            'catalog' => $catalog,
            'filter' => $filter,
            'pageCount' => $count,
            'page' => $page,
            'name' => $category->name__ru,
            'type' => $type,
            'request' => 'type'
        ]);
    }

    public function catalogCategory(Request $request)
    {

        $category = Categorys::where('name', $request->type)->firstOrFail();

        $catalog = ProductType::whereHas('category', function ($query) use ($request) {
            $query->where('name', $request->type);
        })->orderBy('name__ru', 'asc')->get();
        return Inertia::render('catalog', [
            'catalog' => $catalog,
            'name' => $category->name_ru,
            'request' => 'category'
        ]);

    }

    public function product(Request $request)
    {
        $product = Products::with([
            'type',
            'manufacturer',
            'reviews.user',
            'productAttributes.attributes',
        ])
            ->where('slug', $request->slug)
            ->withAvg('reviews', 'grade')
            ->firstOrFail();

        return Inertia::render('product', [
            'product' => $product,
            'states' => $request->state == null ? '' : $request->state,
        ]);
    }
}
