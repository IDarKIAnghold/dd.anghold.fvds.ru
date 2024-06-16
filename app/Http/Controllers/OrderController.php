<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\CartItem;
use App\Models\Products;
use App\Models\Orders;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function view()
    {

        if (auth()->check()) {
            $user_id = auth()->id();
            $carts = CartItem::where('user_id', $user_id)->get();
            $cart = [];
            foreach ($carts as $cart_item) {
                if (!isset($cart[$cart_item['product_id']])) {
                    $cart[$cart_item['product_id']] = [
                        'product_id' => $cart_item['product_id'],
                        'quantity' => $cart_item['quantity']
                    ];
                }
            }
            $totalPrice = CartItem::with('product')
                ->where('user_id', $user_id)
                ->whereHas('product', function ($query) {
                    $query->where('count', '>', 0);
                })
                ->get()
                ->sum(function ($cartItem) {
                    return $cartItem->product->price * $cartItem->quantity;
                });
        } else {
            $cart = session()->get('cart', []);
            $totalPrice = 0;

            foreach ($cart as $product_id => $cart_item) {
                $product = Products::find($product_id);
                if ($product && $product->count > 0) {
                    $totalPrice += $product->price * $cart_item['quantity'];
                }
            }
        }

        return Inertia::render('orders/order', [
            'totalPrice' => $totalPrice,
            'cart' => $cart,
        ]);
    }

    public function viewDone()
    {
        return Inertia::render('orders/orderDone', );
    }

    public function setOrder(Request $request)
    {
        if (empty($request->first_name) || empty($request->last_name) || empty($request->phone) || empty($request->address)) {
            $error_code = 'empty';
            $error_text = 'Все поля должны быть заполнены.';
            return response()->json(['error' => true, 'error_code' => $error_code, 'error_text' => $error_text]);
        }
        if (auth()->check()) {
            $cartItems = CartItem::with('product')
                ->where('user_id', auth()->id())
                ->whereHas('product', function ($query) {
                    $query->where('count', '>', 0);
                })
                ->get();
        } else {
            $cartItems = session()->get('cart', []);
            $productIds = collect($cartItems)->pluck('product_id')->toArray();
            $product = Products::find($productIds);
            foreach ($product as $key => $value) {
                $cartItems[$value->id]['product'] = $product[$key];
                if ($cartItems[$value->id]['product']->count <= 0) {
                    unset($cartItems[$value->id]);
                }
            }
        }
        $order = Orders::create([
            'user_id' => auth()->check() ? auth()->id() : null,
            'full_name' => $request->first_name . ' ' . $request->last_name,
            'phone_number' => $request->phone,
            'address' => $request->address,
        ]);

        foreach ($cartItems as $key => $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem['product_id'],
                'quantity' => $cartItem['quantity'],
                'price' => $cartItem['product']->price,
            ]);

            $product = Products::find($cartItem['product_id']);
            $product->count -= $cartItem['quantity'];
            $product->save();
        }

        if ($order) {
            if (auth()->check()) {
                CartItem::whereIn('id', $cartItems->pluck('id'))->delete();
            } else {
                $cart = session()->get('cart', []);
                foreach ($cartItems as $cartItem) {
                    unset($cart[$cartItem['product_id']]);
                }
                session()->put('cart', $cart);
            }
            return response('true');
        } {
            $error_code = 'error';
            $error_text = 'Ой что-то пошло не так';
            return response()->json(['error' => true, 'error_code' => $error_code, 'error_text' => $error_text]);
        }
    }
}
