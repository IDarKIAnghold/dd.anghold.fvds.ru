<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Reviews;
use App\Models\Products;

class ReviewsController extends Controller
{
    public function view(Request $request)
    {
        Products::where('slug', $request->product)->firstOrFail();
        return Inertia::render('auth/reviews');
    }
    public function addReview(Request $request)
    {
        if (empty($request->grade)) {
            $error_code = 'emptyGrade';
            $error_text = 'Вы не поставил оценку.';
            return redirect()->back()->withErrors(['error' => true, 'error_code' => $error_code, 'error_text' => $error_text])->with('type', 'login')->withInput();
        }

        if (empty($request->plus)) {
            $error_code = 'emptyPlus';
            $error_text = 'Поле достоинства должен быть заполнен.';
            return redirect()->back()->withErrors(['error' => true, 'error_code' => $error_code, 'error_text' => $error_text])->with('type', 'login')->withInput();
        }

        if (empty($request->minus)) {
            $error_code = 'emptyMinus';
            $error_text = 'Поле недостатки должен быть заполнен.';
            return redirect()->back()->withErrors(['error' => true, 'error_code' => $error_code, 'error_text' => $error_text])->with('type', 'login')->withInput();
        }

        $product = Products::where('slug', $request->slug)->first();

        $review = new Reviews();
        $review->product_id = $product->id;
        $review->user_id = auth()->id();
        $review->grade = $request->grade;
        $review->plus = $request->plus;
        $review->minus = $request->minus;
        $review->comment = $request->comment;
        $review->save();

        return redirect()->intended(route('product', $request->slug));
    }
}
