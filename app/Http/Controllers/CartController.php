<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\CartItem;
use App\Models\Favorite;
use App\Models\Products;

class CartController extends Controller
{
    public function cart()
    {
        if (auth()->check()) {
            $user_id = auth()->id();

            $products = Products::with('type', 'manufacturer')->whereHas('cartItems', function ($query) use ($user_id) {
                $query->where('user_id', $user_id)->orderBy('created_at', 'desc');
            })->get();
            $carts = CartItem::where('user_id', $user_id)->get();
            $favorites = Favorite::where('user_id', $user_id)->get();
            $cart = [];
            $favorite = [];
            foreach ($carts as $cart_item) {
                if (!isset($cart[$cart_item['product_id']])) {
                    $cart[$cart_item['product_id']] = [
                        'product_id' => $cart_item['product_id'],
                        'quantity' => $cart_item['quantity']
                    ];
                }
            }
            foreach ($favorites as $favorite_item) {
                if (!isset($favorite[$favorite_item['product_id']])) {
                    $favorite[$favorite_item['product_id']] = [
                        'product_id' => $favorite_item['product_id'],
                    ];
                }
            }
        } else {
            $cart = session()->get('cart', []);
            $favorite = session()->get('favorite', []);
            $productIds = array_keys($cart);
            $products = Products::whereIn('id', $productIds)->get();
        }

        return Inertia::render('cart', ['products' => $products, 'cart' => $cart, 'favorite' => $favorite]);
    }


    public function checkCart(Request $request)
    {
        $product_id = $request->product_id;

        if (auth()->check()) {
            $user_id = auth()->id();

            $cartItem = CartItem::where('user_id', $user_id)
                ->where('product_id', $product_id)
                ->first();

            if ($cartItem)
                return response()->json(['message' => 'isset']);

        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$product_id]))
                return response()->json(['message' => 'isset']);
        }
    }

    public function addToCart(Request $request)
    {

        $product_id = $request->product_id;
        if (auth()->check()) {

            $user_id = auth()->id();

            $cartItem = CartItem::where('user_id', $user_id)
                ->where('product_id', $product_id)
                ->first();
            if (!$cartItem) {
                $cartItem = new CartItem();
                $cartItem->user_id = $user_id;
                $cartItem->product_id = $product_id;
                $cartItem->save();
            }
        } else {

            $cart = session()->get('cart', []);

            $product_id = $request->product_id;

            if (!isset($cart[$product_id])) {
                $cart[$product_id] = [
                    'product_id' => $product_id,
                    'quantity' => 1
                ];
            }

            session()->put('cart', $cart);
        }
    }

    public function removeFromCart(Request $request)
    {
        $product_id = $request->product_id;

        if (auth()->check()) {
            $user_id = auth()->id();
            CartItem::where('user_id', $user_id)->where('product_id', $product_id)->delete();
        } else {
            $cart = session()->get('cart', []);

            foreach ($cart as $index => $item) {
                if ($item['product_id'] == $product_id) {
                    unset($cart[$index]);
                    break;
                }
            }
            session()->put('cart', $cart);
        }
    }


    public function updateQuantity(Request $request)
    {
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        if (auth()->check()) {
            $user_id = auth()->id();
            CartItem::where('user_id', $user_id)->where('product_id', $product_id)->update(['quantity' => $quantity]);
        } else {
            $cart = session()->get('cart', []);

            foreach ($cart as $index => $item) {
                if ($item['product_id'] == $product_id) {
                    $cart[$index]['quantity'] = $quantity;
                    break;
                }
            }
            session()->put('cart', $cart);
        }
    }

    public function clearCart()
    {
        if (auth()->check()) {
            $user_id = auth()->id();
            CartItem::where('user_id', $user_id)->delete();
        } else {
            session()->forget('cart');
        }
    }

}
