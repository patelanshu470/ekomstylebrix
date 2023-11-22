<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\Payment;
use Illuminate\Http\Request;
use PDF;
use Mail;
class InvoiceController extends Controller
{
    public function orderInvoice($id){
        $orders = Order::where('unique_no',$id)->get()->first();
        $productOrder = OrderedProduct::where('order_id', $orders->id)->orderBy('id', 'asc')->get();
        $payment_data = Payment::where('order_id',$orders->id)->first();
        // return view('frontend.invoice.order_invoice', array('orders' =>  $orders,'productOrder'=>$productOrder,'payment'=>$payment_data));
        $pdf = PDF::loadView('frontend.invoice.order_invoice', array('orders' =>  $orders,'productOrder'=>$productOrder,'payment'=>$payment_data));
        return $pdf->download($orders->unique_no.'.pdf');

    }

    public function sendInvoice($id){

        $orders = Order::where('unique_no',$id)->get()->first();
        $productOrder = OrderedProduct::where('order_id', $orders->id)->orderBy('id', 'asc')->get();
        $payment_data = Payment::where('order_id',$orders->id)->first();
        $pdf = PDF::loadView('frontend.invoice.order_invoice', array('orders' =>  $orders,'productOrder'=>$productOrder,'payment'=>$payment_data));

        $data = [
            'tomail' => $orders->billing_email,
            'tonamemail' => $orders->billing_name,
            'order_no'=>$orders->unique_no,
        ];
        Mail::send('backend.email.invoice_email', $data, function ($message) use ($data, $pdf) {
            $message->to($data['tomail'], $data['tonamemail'])->subject('Order Invoice.');
            $message->from(getenv('MAIL_FROM_ADDRESS'), config('MAIL_USERNAME'));
            $message->attachData($pdf->output(), 'invoice.pdf');
        });
        return back()->with('success','Invoice send successfully.');
    }
}
