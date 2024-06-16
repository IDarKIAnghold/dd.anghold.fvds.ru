<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

use App\Models\Categorys;
use App\Models\Manufacturer;

class HandleInertiaRequests extends Middleware
{

    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'user' => $request->user() ? $request->user()->load('role') : null,
            'CategoryList' => Categorys::with(['ProductType' => function ($query) {
                $query->orderBy('name__ru', 'asc'); }])->get(),
        ];
    }
}
