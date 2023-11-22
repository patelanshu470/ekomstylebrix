<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\CouponUsedRecord;
use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\Payment;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Mail;

class PaymentController extends Controller
{
    public function clearCart()
    {
        $cart_data = Cart::where('user_id', auth()->user()->id)->get();
        $cart_data->each->delete();
    }
    public function paymentPage($order_id)
    {
        try {
            $order_id = decrypt($order_id);
        } catch (DecryptException $e) {
            throw new HttpResponseException(
                response()->view('errors.404', [], Response::HTTP_NOT_FOUND)
            );
        }
        $cart_data = null;
        $cart_data = OrderedProduct::where('order_id', $order_id)->get();
        $order_details = Order::find($order_id);
        $totalSaved = $order_details->total_discount;
        $total = $order_details->grand_total;
        $subTotal = $order_details->subtotal;
        $couponAmount = ($order_details->coupon_amount) ? $order_details->coupon_amount : 0;

        $order_id = encrypt($order_id);
        return view('frontend.payment.payment', compact('cart_data', 'totalSaved', 'total', 'subTotal', 'order_id', 'couponAmount'));
    }

    public function payment($order_id)
    {
        try {
            $order_id = decrypt($order_id);
        } catch (DecryptException $e) {
            throw new HttpResponseException(
                response()->view('errors.404', [], Response::HTTP_NOT_FOUND)
            );
        }
        $order = Order::find($order_id);
        $user_id = Auth::user()->id;
        #Stripe Payment
        \Stripe\Stripe::setApiKey(env('STRIPE_KEY'));
        $orderDetails = Order::find($order_id);
        $finalAmount = $orderDetails->grand_total * 100;
        $checkoutSession = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'unit_amount' => $finalAmount,
                        'product_data' => [
                            'name' => 'Order Total',
                        ],
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('payment.store', encrypt($order_id)),
            'cancel_url' => route('home'),
            'metadata' => [
                'user_id' => auth()->user()->id,
            ],
            'customer_email' => auth()->user()->email,
        ]);
        session(['checkout_session_id' => $checkoutSession->id]);
        return redirect()->away($checkoutSession->url);
    }

    public function paymentStore(Request $request, $order_id)
    {
        try {
            $order_id = decrypt($order_id);
        } catch (DecryptException $e) {
            throw new HttpResponseException(
                response()->view('errors.404', [], Response::HTTP_NOT_FOUND)
            );
        }
        #Empty Cart Error Handling
        $checkoutSessionId = session('checkout_session_id');
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $paymentIntent = \Stripe\Checkout\Session::retrieve($checkoutSessionId);
        $paymentIntentId = $paymentIntent->payment_intent;
        $paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);
        if ($paymentIntent['status'] == "succeeded") {
            $this->clearCart();
            $this->OrderMail();
            #updating payment status
            $data = null;
            $data = Order::find($order_id);
            $data->payment_status = $paymentIntent['status'];
            $data->transaction_id = $paymentIntentId;
            $data->order_status = "pending";
            $data->save();
            #updating payment table
            $pay = new Payment();
            $pay->amount = $paymentIntent->amount / 100;
            $pay->payment_status = $paymentIntent['status'];
            $pay->order_id = $order_id;
            $pay->transaction_id = $paymentIntentId;
            $pay->save();
            #expiring the coupon for this user if he ad used any
            if($data->coupon_code){
                $coupon=Coupon::where([['coupon_code','like',$data->coupon_code],['discount','=',$data->coupon_discount]])->get()->first();
                $expireCoupon=new CouponUsedRecord();
                $expireCoupon->coupon_id=$coupon->id;
                $expireCoupon->order_id=$order_id;
                $expireCoupon->user_id=auth()->user()->id;
                $expireCoupon->save();
            }
            #providing user unique order id instead of real
            $order_id=null;
            $order_id=$data->unique_no;
            return view('frontend.payment.payment_success', compact('order_id'));
        } else {
            #updating payment status
            $data = null;
            $data = Order::find($order_id);
            $data->payment_status = $paymentIntent['status'];
            $data->order_status = "canceled";
            $data->save();
            #updating payment table
            $pay = new Payment();
            $pay->amount = $paymentIntent->amount / 100;
            $pay->payment_status = $paymentIntent['status'];
            $pay->order_id = $order_id;
            $pay->transaction_id = $paymentIntentId;
            $pay->save();
            return redirect()->back()->with('error', 'Payment failed');
        }
    }

    public function OrderMail()
    {
        $order = Order::where([['user_id',auth()->user()->id],['payment_status','<>','pending']])->latest()->first();
        $data = array('tomail'=>$order->billing_email,'tonamemail'=>$order->billing_name);
        if($order){
            Mail::send('frontend.payment.order-mail', $data, function($message)use ($data) {
                $message->to($data['tomail'], 'rk')->subject
                   ('Your StyleBrix Order Confirmation');
                $message->from('support@stylebrix.com','StyleBrix');
             });
        }
        return view('frontend.payment.order-mail');
    }


}
