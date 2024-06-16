<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;

use App\Models\Favorite;

class FavoriteController extends Controller
{
   public function view()
   {
      $user_id = auth()->id();
      $favorite = Favorite::with('product')->where('user_id', $user_id)->get();
      return Inertia::render('favorite', [
         'favorite' => $favorite
      ]);
   }

   public function addToFavorite(Request $request)
   {
      $product_id = $request->product_id;
      if (auth()->check()) {

         $user_id = auth()->id();

         $favoriteItem = Favorite::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();
         if (!$favoriteItem) {
            $favoriteItem = new Favorite();
            $favoriteItem->user_id = $user_id;
            $favoriteItem->product_id = $product_id;
            $favoriteItem->save();
         }

      } else {

         $favorite = session()->get('favorite', []);

         $product_id = $request->product_id;

         if (!isset($favorite[$product_id])) {
            $favorite[$product_id] = [
               'product_id' => $product_id,
            ];
         }

         session()->put('favorite', $favorite);
      }
   }

   public function removeFromFavorite(Request $request)
   {
      $product_id = $request->product_id;
      if (auth()->check()) {
         $user_id = auth()->id();
         Favorite::where('user_id', $user_id)->where('product_id', $product_id)->delete();
      } else {
         $favorite = session()->get('favorite', []);

         foreach ($favorite as $index => $item) {
            if ($item['product_id'] == $product_id) {
               unset($favorite[$index]);
               break;
            }
         }
         session()->put('favorite', $favorite);
      }
   }

   public function checkFavorite(Request $request)
   {
      $product_id = $request->product_id;
      if (auth()->check()) {
         $user_id = auth()->id();

         $favorite = Favorite::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();

         if ($favorite)
            return response()->json(['message' => 'isset']);

      } else {
         $favorite = session()->get('favorite', []);

         if (isset($favorite[$product_id]))
            return response()->json(['message' => 'isset']);
      }
   }
}
