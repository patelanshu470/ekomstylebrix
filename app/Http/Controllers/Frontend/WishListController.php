<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WishListController extends Controller
{
    public function wishList()
    {
        $wishlists = Wishlist::where('user_id', Auth()->user()->id)
        ->whereHas('product', function ($query) {
            $query->where('status', 1);
        })
        ->get();
        return view('frontend.wishlist.wishlist', compact('wishlists'));
    }
    public function addToWishList(Request $request)
    {
        if ($request->ajax()) {
            if (!Auth::check()) {
                Session::put('wishlist_data', ['product_id' => $request->product_id]);
                Session::save();
            }
            if (Auth::check()) {
                $user_id = Auth::user()->id;
                $product_id = $request->product_id;
                $product = Product::find($product_id);

                $cartData = Wishlist::where([['product_id', '=', $product_id], ['user_id', '=', $user_id]])->first();
                if ($cartData) {
                    $cartData->delete();
                    $cart_total = Wishlist::where('user_id', $user_id)->count();
                    return response()->json([
                        'result' => 'fail',
                        'message' => 'Product Removed to Wishlist!',
                        'cart_total'=>$cart_total,
                    ]);
                } else {
                    $cartData = null;
                    $cartData = new Wishlist();
                    $cartData->product_id = $product_id;
                    $cartData->user_id = $user_id;
                    $result = $cartData->save();
                }
                if ($result) {
                    $wishlist_item_id=$cartData->id;
                    $cart_total = Wishlist::where('user_id', $user_id)->count();
                    return response()->json([
                        'result' => 'success',
                        'message' => 'Product added to wish successfully!',
                        'cart_total' => $cart_total,
                        'wishlist_item_id'=>$wishlist_item_id
                    ]);
                } else {
                    return response()->json([
                        'result' => 'fail',
                        'message' => 'Failed to add the product to Wishlist.',
                    ]);
                }
            } else {
                return response()->json([], 401);
            }
        } else {
            return response()->json([], 400);
        }
    }

    public function removeToWishList(Request $request)
    {
        if ($request->ajax()) {
            if (!Auth::check()) {
                Session::put('wishlist_data', ['product_id' => $request->product_id]);
                Session::save();
            }
            if (Auth::check()) {
                $user_id = Auth::user()->id;
                $product_id = $request->product_id;
                $product = Product::find($product_id);

                $cartData = Wishlist::where([['product_id', '=', $product_id], ['user_id', '=', $user_id]])->first();
                if ($cartData) {
                    $cartData->delete();
                    $cart_total = Wishlist::where('user_id', $user_id)->count();
                    return response()->json([
                        'result' => 'success',
                        'message' => 'Product Removed to Wishlist!',
                        'cart_total'=>$cart_total,
                    ]);
                } else {
                    $cartData = null;
                    $cartData = new Wishlist();
                    $cartData->product_id = $product_id;
                    $cartData->user_id = $user_id;
                    $result = $cartData->save();
                }
                if ($result) {
                    $wishlist_item_id=$cartData->id;
                    $cart_total = Wishlist::where('user_id', $user_id)->count();
                    return response()->json([
                        'result' => 'fail',
                        'message' => 'Product added to wish successfully!',
                        'cart_total' => $cart_total,
                        'wishlist_item_id'=>$wishlist_item_id
                    ]);
                } else {
                    return response()->json([
                        'result' => 'fail',
                        'message' => 'Failed to add the product to Wishlist.',
                    ]);
                }
            } else {
                return response()->json([], 401);
            }
        } else {
            return response()->json([], 400);
        }
    }

    public function deleteWishList(Request $request,$id)
    {
        $data = Wishlist::findOrFail($id);
        $data->delete();
        $wishlist_total = Wishlist::where('user_id', Auth()->user()->id)->count();
        return back()->with('error','Product Removed to Wishlist');
    }
}
