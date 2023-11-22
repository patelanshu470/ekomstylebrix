<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\OrderedProduct;
use App\Models\ReturnOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ReturnController extends Controller
{
    public function returnProduct($id)
    {

        // id validation is pending
        $order = OrderedProduct::where([['user_id', '=', auth()->user()->id], ['id', '=', $id]])->get()->first();
        if (!$order) {
            return back()->with('error', 'Invalid Request');
        }
        $dublicate_return = ReturnOrder::where([
            ['user_id', '=', auth()->user()->id],
            ['product_id', '=', $order->product_id],
            ['order_id', '=', $order->order_id]
        ])
        ->get()->first();
        // if ($dublicate_return) {
        //     return back()->with('error', 'You had already returned this product');
        // }

        $data = OrderedProduct::find($id);
        return view('frontend.profile.return', compact('data','order','dublicate_return'));
    }
    public function returnProductDetails(Request $request, $id)
    {
        // if user change no. from url
        $order = OrderedProduct::where([['user_id', '=', auth()->user()->id], ['id', '=', $id]])->get()->first();
        $order_no=$order->order->unique_no;
       if (!$order) {
            return back()->with('error', 'Invalid Request');
        }
        $dublicate_return = ReturnOrder::where([
            ['user_id', '=', auth()->user()->id],
            ['product_id', '=', $order->product_id],
            ['order_id', '=', $order->order_id]
        ])->get()->first();
        if ($dublicate_return) {
            return back()->with('error', 'You had already returned this product');
        }
        $data = new ReturnOrder();
        if ($request->hasFile('attachement')) {
            $uploadFile = $request->file('attachement');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->store('return/attachement', 's3');
            $return_attachement = Storage::disk('s3')->url($path);
            $data['attachement'] = $return_attachement;
            $data->save();
        }
        $data->user_id = Auth()->user()->id;
        $data->order_id = $order->order_id;
        $data->product_id = $order->product_id;
        $data->size = $order->size;
        $data->status = "pending";
        if ($request->is_custom_reason) {
            $data->is_custom = '1';
            $data->return_reason = $request->custom_reason;
        } else {
            $data->is_custom = '0';
            $data->return_reason = $request->reason;
        }
        $data->save();
        return redirect()->route('order.tracking',$order_no)->with('success', 'Your return request is under review,we will get back to you in 24hrs');
    }
}
