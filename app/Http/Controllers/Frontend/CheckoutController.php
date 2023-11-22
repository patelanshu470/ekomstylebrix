<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\CouponUsedRecord;
use App\Models\Order;
use App\Models\OrderedProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function checkoutDetails(Request $request)
    {
        $cart_data = null;
        $cart_data = Cart::where('user_id', Auth()->user()->id)
        ->whereHas('product', function ($query) {
            $query->where('status', 1);
        })->get();

        $subTotal = null;
        $total = null;
        $singleSaved = [];
        foreach ($cart_data as $data) {
            #total 
            $sum = null;
            $totalSum = null;
            $sum = (($data->product->discount) ? $data->product->sell_price : $data->product->final_sell_price) * $data->quantity;
            $subTotal += $sum;
            $totalSum = $data->product->final_sell_price * $data->quantity;
            $total += $totalSum;
            #saved amount
            if ($data->product->discount) {
                $singleSaved[] = ($data->product->sell_price - $data->product->final_sell_price) * $data->quantity;
            }
        }
        $totalSaved = (count($singleSaved) > 0) ? array_sum($singleSaved) : 0;
        #user address 
        $address = Address::where('user_id', auth()->user()->id)->get();
        return view('frontend.checkout.checkout_details', compact('cart_data', 'totalSaved', 'total', 'subTotal', 'address'));
    }

    public function checkout(Request $request)
    {
        #if user doesn't have address
        $address = Address::where('user_id', auth()->user()->id)->get();
        if (count($address) == 0) {
            $rules = [
                'b_type' => 'required',
                'b_address' => 'required',
                'b_landmark' => 'required',
                'b_pincode' => 'required',
                'b_country' => 'required',
                'b_state' => 'required',
                'b_city' => 'required',
                'b_contact_number' => 'required',
            ];
            $customMessages = [
                'b_type.required' => 'This field is required.',
                'b_address.required' => 'This field is required.',
                'b_landmark.required' => 'This field is required.',
                'b_pincode.required' => 'This field is required.',
                'b_country.required' => 'This field is required.',
                'b_state.required' => 'This field is required.',
                'b_city.required' => 'This field is required.',
                'b_contact_number.required' => 'This field is required.',
            ];
            $validator = Validator::make($request->all(), $rules, $customMessages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $b_data = new Address();
            $b_data->user_id = Auth()->user()->id;
            $b_data->address_type = $request->b_type;
            $b_data->address = $request->b_address;
            $b_data->landmark = $request->b_landmark;
            $b_data->pincode = $request->b_pincode;
            $b_data->country = $request->b_country;
            $b_data->state = $request->b_state;
            $b_data->city = $request->b_city;
            $b_data->contact_number = $request->b_contact_number;
            $b_data->default = '1';
            $b_data->save();
            #assigning shipping address 
            $shipping_address = $request->b_address;
            $shipping_landmark = $request->b_landmark;
            $shipping_pincode = $request->b_pincode;
            $shipping_country = $request->b_country;
            $shipping_state = $request->b_state;
            $shipping_city = $request->b_city;
            $shipping_contact_number = $request->b_contact_number;
            $shipping_name = auth()->user()->name;
            $shipping_email = auth()->user()->email;
            #assigning billing address
            $billing_name = auth()->user()->name;
            $billing_email = auth()->user()->email;
            $billing_address = $request->b_address;
            $billing_landmark = $request->b_landmark;
            $billing_pincode = $request->b_pincode;
            $billing_country = $request->b_country;
            $billing_state = $request->b_state;
            $billing_city = $request->b_city;
            $billing_contact_number = $request->b_contact_number;
        }
        if ($request->address_id) {
            #shipping address
            $address = null;
            $address = Address::find($request->address_id);;
            $shipping_address = $address->address;
            $shipping_landmark = $address->landmark;
            $shipping_pincode = $address->pincode;
            $shipping_country = $address->country;
            $shipping_state = $address->state;
            $shipping_city = $address->city;
            $shipping_contact_number = $address->contact_number;
            $shipping_name = auth()->user()->name;
            $shipping_email = auth()->user()->email;

            #billing address
            $billing_address = $address->address;
            $billing_landmark = $address->landmark;
            $billing_pincode = $address->pincode;
            $billing_country = $address->country;
            $billing_state = $address->state;
            $billing_city = $address->city;
            $billing_contact_number = $address->contact_number;
            $billing_name = auth()->user()->name;
            $billing_email = auth()->user()->email;
        }
        if ($request->ship_diff_address == '1') {
            $rules = [
                's_address' => 'required',
                's_landmark' => 'required',
                's_pincode' => 'required',
                's_country' => 'required',
                's_state' => 'required',
                's_city' => 'required',
                's_contact_number' => 'required',
            ];
            $customMessages = [
                's_address.required' => 'Address field is required.',
                's_landmark.required' => 'Landmark field is required.',
                's_pincode.required' => 'Pincode field is required.',
                's_country.required' => 'Country field is required.',
                's_state.required' => 'State field is required.',
                's_city.required' => 'City field is required.',
                's_contact_number.required' => 'Contact Number field is required.',
            ];
            $validator = Validator::make($request->all(), $rules, $customMessages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            #assigning shipping address 
            $shipping_address = $request->s_address;
            $shipping_landmark = $request->s_landmark;
            $shipping_pincode = $request->s_pincode;
            $shipping_country = $request->s_country;
            $shipping_state = $request->s_state;
            $shipping_city = $request->s_city;
            $shipping_contact_number = $request->s_contact_number;
            $shipping_name = $request->s_name;
            $shipping_email = $request->s_email;
        }
        #order section
        $cart_data = null;
        $cart_data = Cart::where('user_id', Auth()->user()->id)
        ->whereHas('product', function ($query) {
            $query->where('status', 1);
        })->get();
        $subTotal = null;
        $total = null;
        $singleSaved = [];
        foreach ($cart_data as $data) {
            #total 
            $sum = null;
            $totalSum = null;
            $sum = (($data->product->discount) ? $data->product->sell_price : $data->product->final_sell_price) * $data->quantity;
            $subTotal += $sum;
            $totalSum = $data->product->final_sell_price * $data->quantity;
            $total += $totalSum;
            #saved amount
            if ($data->product->discount) {
                $singleSaved[] = ($data->product->sell_price - $data->product->final_sell_price) * $data->quantity;
            }
        }
        $totalSaved = (count($singleSaved) > 0) ? array_sum($singleSaved) : 0;
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->subtotal = $subTotal;
        $order->total_discount = $totalSaved;
        a:
        $rand_no = rand(10000, 999999);
        $created_name = 'E' . $rand_no;
        $check_name_available = DB::table('orders')->where([
            ['unique_no', '=', $created_name]
        ])->get('id');
        if (!empty($check_name_available)) {
            $order['unique_no'] = $created_name;
        } else {
            goto a;
        }
        $order->grand_total = $total;
        $order->payment_status = "pending";
        $order->ship_to_diff_address = ($request->ship_diff_address) ?  '1' : '0';
        $order->shipping_name = $shipping_name;
        $order->shipping_email = $shipping_email;
        $order->shipping_address = $shipping_address;
        $order->shipping_landmark = $shipping_landmark;
        $order->shipping_pincode = $shipping_pincode;
        $order->shipping_country = $shipping_country;
        $order->shipping_state = $shipping_state;
        $order->shipping_city = $shipping_city;
        $order->shipping_contact_number = $shipping_contact_number;
        $order->billing_name = $billing_name;
        $order->billing_email = $billing_email;
        $order->billing_address = $billing_address;
        $order->billing_landmark = $billing_landmark;
        $order->billing_pincode = $billing_pincode;
        $order->billing_country = $billing_country;
        $order->billing_state = $billing_state;
        $order->billing_city = $billing_city;
        $order->billing_contact_number = $billing_contact_number;
        $order->order_status = "inprogress";

        $currentDate = Carbon::now()->format('Y-m-d');
        $coupondata = Coupon::where([
            ['coupon_code', '=', $request->couponCode],
            ['status', '=', 1],
            ['expiry_date', '>=', $currentDate],
        ])->get()->first();

        if ($coupondata) {
            $usedCheck = CouponUsedRecord::where([['user_id', '=', auth()->user()->id], ['coupon_id', '=', $coupondata->id]])->get()->first();
            if (!$usedCheck) {
                $order->coupon_code = $coupondata->coupon_code;
                $order->coupon_discount = $coupondata->discount;
                //calculate coupon amount 
                $discountAmount = ($total * $coupondata->discount) / 100;
                $order->coupon_amount = $discountAmount;
                $order->grand_total = $total - $discountAmount;
            } 
        }
        $order->save();
        if ($order) {
            $cart_data = Cart::where('user_id', Auth()->user()->id)
            ->whereHas('product', function ($query) {
                $query->where('status', 1);
            })->get();
            foreach ($cart_data as $cart) {
                $product = new OrderedProduct();
                $product->user_id = auth()->user()->id;
                $product->order_id = $order->id;
                $product->product_id = $cart->product_id;
                $product->size = $cart->size;
                $product->quantity = $cart->quantity;
                $product->final_sell_price = $cart->product->final_sell_price;
                $product->discount =($cart->product->discount)? $cart->product->sell_price - $cart->product->final_sell_price:null;
                $product->sell_price = $cart->product->sell_price;
                $product->cost_price = $cart->product->cost_price;
                $product->payable_amount = $cart->product->final_sell_price * $cart->quantity;
                $product->save();
            }
        }
        return redirect()->route('payment.page', encrypt($order->id));
    }
    public function couponApply(Request $request)
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $data = Coupon::where([
            ['coupon_code', '=', $request->code],
            ['status', '=', 1],
            ['expiry_date', '>=', $currentDate],
        ])->get()->first();
        if ($data) {
            $usedCheck = CouponUsedRecord::where([['user_id', '=', auth()->user()->id], ['coupon_id', '=', $data->id]])->get()->first();
            if ($usedCheck) {
                return response()->json([
                    'result' => 'failed',
                    'message' => 'You have already used this coupon.',
                    'discount' => "used",
                ]);
            } else {
                return response()->json([
                    'result' => 'success',
                    'message' => 'Coupon is available',
                    'discount' => $data->discount,
                ]);
            }
        } else {
            return response()->json([
                'result' => 'failed',
                'message' => 'Coupon is unavailable',
            ]);
        }
    }
}
