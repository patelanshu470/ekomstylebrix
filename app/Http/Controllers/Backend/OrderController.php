<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CanceledOrder;
use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\Product;
use App\Models\ReturnOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function allOrders()
    {
        $datas = Order::orderBy('id', 'DESC')->get();
        return view('backend.order.all_orders', compact('datas'));
    }

    public function pendingOrders()
    {
        $datas = Order::where('order_status', 'pending')->get()->sortByDesc('id');
        return view('backend.order.pending_orders', compact('datas'));
    }

    public function confirmedOrders()
    {
        $datas = Order::where('order_status', 'confirmed')->get()->sortByDesc('id');
        return view('backend.order.confirm_orders', compact('datas'));
    }

    public function completeOrders()
    {
        $datas = Order::where('order_status', 'delivered')->get()->sortByDesc('id');
        return view('backend.order.completed_orders', compact('datas'));
    }
    public function canceledOrders()
    {
        $datas = Order::where('order_status', 'canceled')->get()->sortByDesc('id');
        return view('backend.order.canceled_orders', compact('datas'));
    }

    public function packedOrders()
    {
        $datas = Order::where('order_status', 'packed')->get()->sortByDesc('id');
        return view('backend.order.packed_orders', compact('datas'));
    }
    public function shippedOrders()
    {
        $datas = Order::where('order_status', 'shipped')->get()->sortByDesc('id');
        return view('backend.order.shipped_orders', compact('datas'));
    }




    public function callStatus(Request $request)
    {
        $data = Order::find($request->id);
        if ($request->status == 1) {
            $now = Carbon::now();
            $data->call_at = $now;
            $data->save();
        } else {
            $data->call_at = null;
            $data->save();
        }
        return response()->json([
            'success' => 'Called the customer.'
        ]);
    }


    public function orderDetails($id)
    {
        $datas = Order::find($id);
        $orderProducts = OrderedProduct::where('order_id', $id)->get();
        return view('backend.order.order_details', compact('datas', 'orderProducts'));
    }
    public function orderStatus(Request $request)
    {
        $order = Order::find($request->order_id);
        $OrderProduct = OrderedProduct::where('order_id', $request->order_id)->get();
        #condition check
        if ($request->status == "shipped") {
            if ($order->confirmed_at == null) {
                return response()->json(['error' => 'Order first Confirmed then shipped.']);
            }
        }
        if ($request->status == "packed") {
            if ($order->confirmed_at == null) {
                return response()->json(['error' => 'Order first Confirmed then packed.']);
            }
        }
        if ($request->status == "delivered") {
            if ($order->shipped_at == null) {
                return response()->json(['error' => 'Order first Shipped then delivered.']);
            }
        }
        #end
        $order->order_status = $request->status;
        $order->save();


        if ($request->status == "canceled") {
            $orderCancel = new CanceledOrder();
            $orderCancel->order_id = $request->order_id;
            $orderCancel->user_id = Auth()->user()->id;
            $orderCancel->reason = $request->canceled_reason;
            $orderCancel->canceled_by = 'admin';
            $orderCancel->save();
            #updating in Order table
            $now = Carbon::now();
            $order = Order::find($request->order_id);
            $order->canceled_at = $now;
            $order->canceled_by = 'admin';
            $order->save();
            return response()->json(['success' => 'Order is Canceled.']);
        }
        if ($request->status == "confirmed") {
            $now = Carbon::now();
            $order = Order::find($request->order_id);
            $order->confirmed_at = $now;
            $order->save();
            #Reducing quantiy
            foreach ($OrderProduct as $product) {
                $data = Product::find($product->product_id);
                $data->quantity = $data->quantity - $product->quantity;
                $data->save();
            }
            return response()->json(['success' => 'Order is Confirmed.']);
        }
        if ($request->status == "packed") {
            $now = Carbon::now();
            $order = Order::find($request->order_id);
            $order->packed_at = $now;
            $order->save();
            return response()->json(['success' => 'Order is packed.']);
        }
        if ($request->status == "shipped") {
            $now = Carbon::now();
            $order = Order::find($request->order_id);
            $order->shipped_at = $now;
            $order->tracking_id = $request->tracking_id;
            $order->save();
            return response()->json(['success' => 'Order is shipped.']);
        }
        if ($request->status == "delivered") {
            $now = Carbon::now();
            $order = Order::find($request->order_id);
            $order->delivered_at = $now;
            $order->save();
            return response()->json(['success' => 'Order is delivered.']);
        }
    }
    public function checkNewOrder()
    {
        $data = Order::where([['read_at', '=', null], ['order_status', '=', 'pending']])->first();
        if ($data) {
            $data->read_at = 1;
            $data->save();
            if (!$data == null) {
                return response()->json($data);
            }
        }
    }
    public function returnOrder()
    {
        $datas = ReturnOrder::orderBy('id', 'DESC')->get();
        return view('backend.order.return_orders', compact('datas'));
    }
    public function returnOrderUpdate(Request $request, $id)
    {
          $data = ReturnOrder::find($id);
        if ($data->status == "pending") {
            $data->status = $request->status;
            $data->reject_reason = $request->reject_reason;
            $data->save();

            $orderProduct=OrderedProduct::where([['order_id','=',$data->order_id],['product_id','=',$data->product_id]])->get()->first();
            $orderProduct->returned_id=$data->id;
            $orderProduct->returned_status=$request->status;
            $orderProduct->save();

            return back()->with('success', 'Return request has been approved');
        }
        return back()->with('error', 'Invalid Request');
    }
}
