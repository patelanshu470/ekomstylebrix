<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function paymentHistory(){
         $datas=Payment::orderBy('id', 'DESC')->get();
        return view('backend.payment.payment',compact('datas'));
    }
}
