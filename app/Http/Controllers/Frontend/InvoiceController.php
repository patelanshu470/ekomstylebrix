<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\Payment;
use Illuminate\Http\Request;
use PDF;

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
}
