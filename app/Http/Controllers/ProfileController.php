<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;
use App\Models\Orders;

class ProfileController extends Controller
{
    public function profile()
    {
        // $user = auth()->user();
        // $user->email_verified_at = null;
        // $user->save();

        $reviews = Reviews::with('Product')->where('user_id', auth()->id())->get();
        $orders = Orders::with('item.product')->where('user_id', auth()->id())->get();

        foreach ($orders as $order) {
            $totalSum = 0;
            foreach ($order->item as $item) {
                $totalSum += $item->product->price * $item->quantity;
            }
            $order->total_sum = $totalSum;
        }
        return Inertia::render('auth/profile', ['reviews' => $reviews, 'orders' => $orders]);
    }
    public function update(Request $request)
    {
        $user = auth()->user();
        switch ($request->type) {
            case 'first_name':
                if ($request->first_name === '')
                    abort(404);

                if ($request->first_name === $user->first_name) {
                    return response()->json(['message' => "nothing"]);
                }
                $validator = Validator::make($request->all(), [
                    'first_name' => 'required|min:1',
                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => 'LongString']);
                }

                $user->update(['first_name' => $request->first_name]);
                return response()->json(['message' => 'true']);

            case 'last_name':
                if ($request->last_name === '')
                    abort(404);

                if ($request->last_name === $user->last_name) {
                    return response()->json(['message' => "nothing"]);
                }
                $validator = Validator::make($request->all(), [
                    'last_name' => 'required|min:1',
                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => 'LongString']);
                }

                $user->update(['last_name' => $request->last_name]);
                return response()->json(['message' => 'true']);

            case 'email':
                if ($request->email === '')
                    abort(404);

                if ($request->email === $user->email) {
                    return response()->json(['message' => "nothing"]);
                }
                $validator = Validator::make($request->all(), [
                    'email' => 'required|min:1',
                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => 'LongString']);
                }
                $validator = Validator::make($request->all(), [
                    'email' => 'email',
                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => 'NotEmail']);
                }

                $validator = Validator::make($request->all(), [
                    'email' => 'required|email|unique:users,email',
                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => 'Uses']);
                }

                $user->update(['email' => $request->email]);
                return response()->json(['message' => 'true']);

            case 'nickname':
                if ($request->nickname === '')
                    abort(404);

                if ($request->nickname == $user->nickname) {
                    return response()->json(['message' => "Nothing"]);
                }

                $validator = Validator::make($request->all(), [
                    'nickname' => 'required|unique:users,nickname',
                ]);
                if ($validator->fails() && count(str_split($request->nickname)) > 0) {
                    return response()->json(['error' => 'Uses']);
                }

                $user->update(['nickname' => $request->nickname]);
                return response()->json(['message' => 'true']);

            case 'image':
                if ($request->imageData == '')
                    abort(404);

                $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->imageData));
                $fileName = uniqid() . '.jpg';
                if (file_exists(public_path('/storage/src/profile/' . $user->img)) && $user->img != null)
                    unlink(public_path('/storage/src/profile/' . $user->img));
                File::put(public_path('/storage/src/profile/' . $fileName), $fileData);
                $user->update(['img' => $fileName]);
                return redirect()->back();

            default:
                abort(404);
        }

    }
}
