@extends('backend.layouts.admin_master')
@section('content')
    <style>
        .selection {
            width: 100%;
        }
        .table th {
            font-size: 14px !important;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>Reports</h5>
                            <div class="row">
                                <div class="col-md-6 col-sm-12" style="font-size: 20px !important;">
                                    <form action="{{ route('report') }}" id="monthForm">
                                        <select class="js-example-basic-single  form-control monthSelect" name="month"
                                            id="monthSelect">
                                            <option value=" " disabled selected>Select Month</option>
                                            <option {{ request()->input('month') === 'January' ? 'selected' : '' }}>January
                                            </option>
                                            <option {{ request()->input('month') === 'February' ? 'selected' : '' }}>
                                                February</option>
                                            <option {{ request()->input('month') === 'March' ? 'selected' : '' }}>March
                                            </option>
                                            <option {{ request()->input('month') === 'April' ? 'selected' : '' }}>April
                                            </option>
                                            <option {{ request()->input('month') === 'May' ? 'selected' : '' }}>May</option>
                                            <option {{ request()->input('month') === 'June' ? 'selected' : '' }}>June
                                            </option>
                                            <option {{ request()->input('month') === 'July' ? 'selected' : '' }}>July
                                            </option>
                                            <option {{ request()->input('month') === 'August' ? 'selected' : '' }}>August
                                            </option>
                                            <option {{ request()->input('month') === 'September' ? 'selected' : '' }}>
                                                September</option>
                                            <option {{ request()->input('month') === 'October' ? 'selected' : '' }}>October
                                            </option>
                                            <option {{ request()->input('month') === 'November' ? 'selected' : '' }}>
                                                November</option>
                                            <option {{ request()->input('month') === 'December' ? 'selected' : '' }}>
                                                December</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <a href="{{ route('report', ['year' => Carbon\Carbon::now()->year]) }}"
                                        class="btn btn-solid year">This Year</a>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('report') }}" method="get" id="reportForm">
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <input type="text" class="form-control" name="daterange" readonly
                                        value="{{ request()->input('daterange') }}" />
                                </div>
                                <div class="col-md-1 col-sm-12" style="margin-left:-10px;">
                                    <button type="submit" class="btn btn-solid">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (count($all_orders) > 0)
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="title-header option-title">
                                <h5>Orders</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="main-tiles border-5 border-0  card-hover card o-hidden"
                                        style="background-color: #4173941f;">
                                        <div class="custome-1-bg b-r-4 card-body">
                                            <div class="media align-items-center static-top-widget">
                                                <div class="media-body p-0">
                                                    <span class="m-0">Total Sale</span>
                                                    <h4 class="mb-0 counter">${{ $total_sale }}
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="main-tiles border-5 border-0  card-hover card o-hidden"
                                        style="background-color: #4173941f;">
                                        <div class="custome-1-bg b-r-4 card-body">
                                            <div class="media align-items-center static-top-widget">
                                                <div class="media-body p-0">
                                                    <span class="m-0">Total Costing</span>
                                                    <h4 class="mb-0 counter">${{ $all_order_costing }}

                                                    </h4>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($all_order_return > 0)
                                    <div class="col-md-3 col-sm-12">
                                        <div class="main-tiles border-5 border-0  card-hover card o-hidden"
                                            style="background-color: #4173941f;">
                                            <div class="custome-1-bg b-r-4 card-body">
                                                <div class="media align-items-center static-top-widget">
                                                    <div class="media-body p-0">
                                                        <span class="m-0">Total Return Costing</span>
                                                        <h4 class="mb-0 counter">${{ $all_order_return }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endif


                                <div class="col-md-3 col-sm-12">
                                    <div class="main-tiles border-5 border-0  card-hover card o-hidden"
                                        style="background-color: #4173941f;">
                                        <div class="custome-1-bg b-r-4 card-body">
                                            <div class="media align-items-center static-top-widget">
                                                <div class="media-body p-0">
                                                    <span class="m-0">Net P&L</span>
                                                    <h4 class="mb-0 counter">${{ $profit_loss }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive category-table">
                                <div>
                                    <table class="table all-package theme-table" id="table_id">
                                        <thead>
                                            <tr>
                                                <th>Order-No</th>
                                                <th>Sub-Total</th>
                                                <th>Grand-Total</th>
                                                <th>Transaction-ID</th>
                                                <th>Confirmed-Date</th>
                                                <th>Delivered-Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($all_orders as $data)
                                                <tr>
                                                    <td> <a
                                                            href="{{ route('order.details', $data->id) }}">{{ $data->unique_no }}</a>
                                                    </td>
                                                    <td>{{ $data->subtotal }}</td>
                                                    <td>{{ $data->grand_total }}</td>
                                                    <td>{{ $data->transaction_id }}</td>
                                                    <td>{{ $data->confirmed_at }}</td>
                                                    <td>{{ $data->delivered_at }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body" style="text-align: center;">
                            No data found
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        jQuery.noConflict();
        jQuery(document).ready(function($) {
            var currentDate = moment();
            var startOfMonth = currentDate.clone().startOf('month');
            var endOfMonth = currentDate.clone().endOf('month');
            $('input[name="daterange"]').daterangepicker({
                startDate: startOfMonth,
                endDate: endOfMonth,
                opens: 'left',
                locale: {
                    format: 'DD-MM-YYYY'
                }
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                    .format('YYYY-MM-DD'));
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#monthSelect').change(function() {
                $('#monthForm').submit(); // Submit the form when a month is selected
            });
        });
    </script>
@endsection
