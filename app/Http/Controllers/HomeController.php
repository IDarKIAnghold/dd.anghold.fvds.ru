<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Products;
use App\Models\Orders;

class HomeController extends Controller
{
    public function index()
    {   
        $allProducts = Products::whereIn('type_id', [1, 2, 3, 4])->get();

        $classical = $allProducts->where('type_id', 1)->take(10);
        $acoustic = $allProducts->where('type_id', 2)->take(10);
        $electricguitar = $allProducts->where('type_id', 3)->take(10);
        $basguitar = $allProducts->where('type_id', 4)->take(10);

        return Inertia::render('index', [
            'classical' => $classical->values(),
            'acoustic' => $acoustic->values(),
            'electricguitar' => $electricguitar->values(),
            'basguitar' => $basguitar->values()
        ]);
    }



    public function about()
    {
        return Inertia::render('about');
    }

}
