<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderedProduct;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function report(Request $request)
    {
        #Custom-Date
        $all_orders = [];
        $total_sale = null;
        $restro_data = null;
        $all_order_costing = null;
        $profit_loss = null;
        if ($request->daterange) {
            #For getting all the confirm order in given date range
            $dates = explode(" - ", $request->daterange);
            $start_date = \Carbon\Carbon::createFromFormat('d-m-Y', $dates[0])->startOfDay();
            $end_date = \Carbon\Carbon::createFromFormat('d-m-Y', $dates[1])->endOfDay();
            $all_orders = Order::where([
                ['payment_status', '=', 'Succeeded'],
                ['order_status', '<>', 'canceled'],
                ['created_at', '>=', $start_date],
                ['created_at', '<=', $end_date]
            ])->get();
            #For getting Total amount of sell and total costing of that order id
            $total_sale = null;
            $all_order_return = 0;
            foreach ($all_orders as $order) {
                #For getting Total amount of sell
                $total_sale = $total_sale + (float)$order->grand_total;
                $single_order[] = OrderedProduct::where([['order_id', '=', $order->id]])->get();
                $all_order_costing = 0;
                $all_order_return = 0;
                foreach ($single_order as $singles) {
                    $single_cost = 0;
                    $single_return_cost=0;
                    foreach ($singles as $single) {
                        $single_cost = $single_cost + $single->cost_price;
                        #calculating Return orders
                        if($single->returned_status == "approved"){
                            $single_return_cost = $single_return_cost + $single->payable_amount;
                        }
                    }
                    $all_order_costing = $all_order_costing + $single_cost;
                    $all_order_return = $all_order_return + $single_return_cost;
                }
            }
            
            #getting profit or loss
            $profit_loss = null;
            $profit_loss = ($total_sale - $all_order_costing)-$all_order_return;

            return view('backend.report.report', compact('all_order_return','all_order_costing', 'profit_loss', 'all_orders', 'total_sale'));
        }

        #Monthly
        $all_orders = [];
        $total_sale = null;
        $restro_data = null;
        $restro_total_product = null;
        $all_order_costing = null;
        $profit_loss = null;
        if ($request->month) {
            $selectedMonth = $request->month;
            $currentYear = now()->year;
            // Convert the selected month name to a numerical value using Carbon
            $monthNumber = \Carbon\Carbon::parse($selectedMonth)->month;
            // Create start and end dates for the selected month of the current year
            $start_date = \Carbon\Carbon::create($currentYear, $monthNumber, 1)->startOfMonth();
            $end_date = \Carbon\Carbon::create($currentYear, $monthNumber, 1)->endOfMonth();
            $all_orders = Order::where([
                ['payment_status', '=', 'Succeeded'],
                ['order_status', '<>', 'canceled'],
                ['created_at', '>=', $start_date],
                ['created_at', '<=', $end_date]
            ])->get();

            #For getting Total amount of sell and total costing of that order id
            $total_sale = null;
            $all_order_return = 0;

            foreach ($all_orders as $order) {
                #For getting Total amount of sell
                $total_sale = $total_sale + (float)$order->grand_total;
                $single_order[] = OrderedProduct::where([['order_id', '=', $order->id]])->get();
                $all_order_costing = 0;
                $all_order_return = 0;

                foreach ($single_order as $singles) {
                    $single_cost = 0;
                    $single_return_cost=0;

                    foreach ($singles as $single) {
                        $single_cost = $single_cost + $single->cost_price;
                          #calculating Return orders
                          if($single->returned_status == "approved"){
                            $single_return_cost = $single_return_cost + $single->payable_amount;
                        }
                    }
                    $all_order_costing = $all_order_costing + $single_cost;
                    $all_order_return = $all_order_return + $single_return_cost;

                }
            }
            #getting profit or loss
            $profit_loss = null;
            $profit_loss = ($total_sale - $all_order_costing)-$all_order_return;
            return view('backend.report.report', compact('all_order_return','all_order_costing', 'profit_loss', 'all_orders', 'total_sale'));
        }

        #Yearly
        $all_orders = [];
        $total_sale = null;
        $restro_data = null;
        $restro_total_product = null;
        $all_order_costing = null;
        $profit_loss = null;
        if ($request->year) {

            $selectedYear = now()->year;
            $start_date = \Carbon\Carbon::create($selectedYear, 1, 1)->startOfYear();
            $end_date = \Carbon\Carbon::create($selectedYear, 12, 31)->endOfYear();
            $all_orders = Order::where([
                ['payment_status', '=', 'Succeeded'],
                ['order_status', '<>', 'canceled'],

                ['created_at', '>=', $start_date],
                ['created_at', '<=', $end_date]
            ])->get();
            #For getting Total amount of sell and total costing of that order id
            $total_sale = null;
            $all_order_return = 0;

            foreach ($all_orders as $order) {
                #For getting Total amount of sell
                $total_sale = $total_sale + (float)$order->grand_total;
                $single_order[] = OrderedProduct::where([['order_id', '=', $order->id]])->get();
                $all_order_costing = 0;
                $all_order_return = 0;

                foreach ($single_order as $singles) {
                    $single_cost = 0;
                    $single_return_cost=0;

                    foreach ($singles as $single) {
                        $single_cost = $single_cost + $single->cost_price;
                          #calculating Return orders
                          if($single->returned_status == "approved"){
                            $single_return_cost = $single_return_cost + $single->payable_amount;
                            
                        }
                    }
                    $all_order_costing = $all_order_costing + $single_cost;
                    $all_order_return = $all_order_return + $single_return_cost;
                }
            }
            #getting profit or loss
            $profit_loss = null;
            $profit_loss = ($total_sale - $all_order_costing)-$all_order_return;

            return view('backend.report.report', compact('all_order_return','all_order_costing', 'profit_loss', 'all_orders', 'total_sale'));
        }

        #if not any of the above 
        $all_orders = [];
        $total_sale = null;
        $restro_data = null;
        $restro_total_product = null;
        $all_order_costing = null;
        $profit_loss = null;

        $currentMonth = Carbon::now();
        $start_date = Carbon::now()->startOfMonth();
        $end_date = Carbon::now()->endOfMonth();

        $all_orders = Order::where([
            ['payment_status', '=', 'Succeeded'],
            ['order_status', '<>', 'canceled'],

            ['created_at', '>=', $start_date],
            ['created_at', '<=', $end_date]
        ])->get();
        #For getting Total amount of sell and total costing of that order id
        $total_sale = null;
        $all_order_return = 0;

        foreach ($all_orders as $order) {
            #For getting Total amount of sell
            $total_sale = $total_sale + (float)$order->grand_total;
            $single_order[] = OrderedProduct::where([['order_id', '=', $order->id]])->get();
            $all_order_costing = 0;
            $all_order_return = 0;

            foreach ($single_order as $singles) {
                $single_cost = 0;
                $single_return_cost=0;

                foreach ($singles as $single) {
                    $single_cost = $single_cost + $single->cost_price;
                      #calculating Return orders
                      if($single->returned_status == "approved"){
                        $single_return_cost = $single_return_cost + $single->payable_amount;
                    }
                }
                $all_order_costing = $all_order_costing + $single_cost;
                $all_order_return = $all_order_return + $single_return_cost;

            }
        }
        #getting profit or loss
        $profit_loss = null;
        $profit_loss = ($total_sale - $all_order_costing)-$all_order_return;

        return view('backend.report.report', compact('all_order_return','all_order_costing', 'profit_loss', 'all_orders', 'total_sale'));
    }
}
