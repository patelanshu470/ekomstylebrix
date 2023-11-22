<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(
                [
                    'size' => 'required',
                ],
            );

            if (!Auth::check()) {
                Session::put('cart_data', ['product_id' => $request->product_id, 'quantity' => $request->quantity,'size' => $request->size]);
                Session::save();
            }
            if (Auth::check()) {
                $user_id = Auth::user()->id;
                $product_id = $request->product_id;
                $qty = $request->quantity;
                $size = $request->size;
                $product = Product::find($product_id);
                $cartData = Cart::where([['product_id', '=', $product_id], ['user_id', '=', $user_id],['size', '=', $size]])->first();

                if ($cartData) {
                    if ($cartData->quantity >= 5) {
                        return response()->json([
                            'result' => 'fail',
                            'message' => 'You Can Order upto 5 quantity only.',
                        ]);
                    } else {
                        $cartData->quantity += $qty;
                        $result = $cartData->save();
                    }
                } else {
                    $cartData = new Cart();
                    $cartData->product_id = $product_id;
                    $cartData->quantity = $qty;
                    $cartData->size = $size;
                    $cartData->user_id = $user_id;
                    $result = $cartData->save();
                }

                if ($result) {
                    $cart_total = Cart::where('user_id', $user_id)->count();

                    return response()->json([
                        'result' => 'success',
                        'message' => 'Product added to cart successfully!',
                        'cart_total' => $cart_total,
                    ]);
                } else {
                    return response()->json([
                        'result' => 'fail',
                        'message' => 'Failed to add the product to cart.',
                    ]);
                }
            } else {
                // User is not authenticated, return a 401 status code
                return response()->json([], 401);
            }
        } else {
            return response()->json([], 400);
        }
    }
    public function viewCart(){
        $cart_data=null;

        // $cart_data=Cart::where('user_id',Auth()->user()->id)->get();
        $cart_data = Cart::where('user_id', Auth()->user()->id)
        ->whereHas('product', function ($query) {
            $query->where('status', 1);
        })->get();
        $subTotal=null;
        $total=null;
        $singleSaved=[];
        foreach($cart_data as $data){
            #total
            $sum=null;
            $totalSum=null;
            $sum=(($data->product->discount)? $data->product->sell_price:$data->product->final_sell_price) * $data->quantity;
            $subTotal+=$sum;
            $totalSum=$data->product->final_sell_price * $data->quantity;
            $total+=$totalSum;
            #saved amount
            if($data->product->discount)
            {
                $singleSaved[]=($data->product->sell_price-$data->product->final_sell_price) * $data->quantity;
            }
        }
         $totalSaved=(count($singleSaved)>0)? array_sum($singleSaved):0;
        return view('frontend.cart.cart',compact('cart_data','subTotal','total','totalSaved'));
    }

    public function deleteCart(Request $request){
        $data = Cart::findOrFail($request->id);
        $data->delete();

        $cart_total = Cart::where('user_id', auth()->user()->id)->count();
        return response()->json([
            'result' => 'success',
            'cart_total' => $cart_total,
        ]);

        return response()->json([
            'success' => 'Successfully removed from cart.'
        ]);
    }

    public function updateCart(Request $request){
        $data = Cart::findOrFail($request->id);
        $data->quantity=$request->quantity;
        $data->save();
        return response()->json([
            'success' => 'Successfully removed from cart.'
        ]);
    }
}
