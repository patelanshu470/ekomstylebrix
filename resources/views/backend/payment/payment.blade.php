@extends('backend.layouts.admin_master')
@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/cust_backend/coupon/coupon.css') }}">
    <style>
        .table th {
            font-size: 14px !important;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>All Payments</h5>

                        </div>
                        <div class="table-responsive category-table">
                            <div>
                                <table class="table all-package theme-table" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Order-ID</th>
                                            <th>Amount</th>
                                            <th>Transection-ID</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $key => $data)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td> <a href="{{route('order.details',$data->order_id)}}" >{{ $data->order->unique_no}}</a> </td>
                                                <td>${{ $data->amount }}</td>
                                                <td>{{ $data->transaction_id }}</td>
                                                <td>{{ $data->payment_status }}</td>

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


@endsection
