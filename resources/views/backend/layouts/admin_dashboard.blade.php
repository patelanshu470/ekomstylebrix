@extends('backend.layouts.admin_master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card o-hidden card-hover">
                    <div class="card-header-title p-0">
                        <h4>This Month</h4>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                    <div class="custome-1-bg b-r-4 card-body">
                        <div class="media align-items-center static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Total-Sale</span>
                                <h4 class="mb-0 counter">${{ $monthly_total_sale ? $monthly_total_sale : 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                    <div class="custome-1-bg b-r-4 card-body">
                        <div class="media align-items-center static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Total-Costing</span>
                                <h4 class="mb-0 counter">${{ $monthly_all_order_costing ? $monthly_all_order_costing : 0 }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($monthly_all_order_return > 0)
                <div class="col-sm-6 col-xxl-3 col-lg-6">
                    <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                        <div class="custome-1-bg b-r-4 card-body">
                            <div class="media align-items-center static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">Returned Order Costing</span>
                                    <h4 class="mb-0 counter">${{ $monthly_all_order_return }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                    <div class="custome-1-bg b-r-4 card-body">
                        <div class="media align-items-center static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">P&L</span>
                                <h4 class="mb-0 counter">${{ $monthly_profit_loss ? $monthly_profit_loss : 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                    <div class="custome-1-bg b-r-4 card-body">
                        <div class="media align-items-center static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Cancel-Orders</span>
                                <h4 class="mb-0 counter">{{ $monthly_canceled_order ? $monthly_canceled_order : 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            {{-- recent order  --}}
            <div class="col-xl-12">
                <div class="card o-hidden card-hover">
                    <div class="card-header card-header-top card-header--2 px-0 pt-0">
                        <div class="card-header-title">
                            <h4>Recent Orders</h4>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div>
                            <div class="table-responsive">
                                <table class="table all-package theme-table" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>Order-No</th>
                                            <th>Sub-Total</th>
                                            <th>Grand-Total</th>
                                            <th>Transaction-ID</th>
                                            <th>Order-Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recent_orders as $data)
                                            <tr>
                                                <td> <a
                                                        href="{{ route('order.details', $data->id) }}">{{ $data->unique_no }}</a>
                                                </td>
                                                <td>{{ $data->subtotal }}</td>
                                                <td>{{ $data->grand_total }}</td>
                                                <td>{{ $data->transaction_id }}</td>
                                                <td>{{ $data->order_status }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end  --}}
            {{-- Yearly --}}
            <div class="col-12">
                <div class="card o-hidden card-hover">
                    <div class="card-header-title p-0">
                        <h4>This Yearly</h4>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                    <div class="custome-1-bg b-r-4 card-body">
                        <div class="media align-items-center static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Total-Sale</span>
                                <h4 class="mb-0 counter">${{ $yearly_total_sale ? $yearly_total_sale : 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                    <div class="custome-1-bg b-r-4 card-body">
                        <div class="media align-items-center static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Total-Costing</span>
                                <h4 class="mb-0 counter">${{ $yearly_all_order_costing ? $yearly_all_order_costing : 0 }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($yearly_all_order_return > 0)
                <div class="col-sm-6 col-xxl-3 col-lg-6">
                    <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                        <div class="custome-1-bg b-r-4 card-body">
                            <div class="media align-items-center static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">Returned Order Costing</span>
                                    <h4 class="mb-0 counter">${{ $yearly_all_order_return }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                    <div class="custome-1-bg b-r-4 card-body">
                        <div class="media align-items-center static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">P&L</span>
                                <h4 class="mb-0 counter">${{ $yearly_profit_loss ? $yearly_profit_loss : 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                    <div class="custome-1-bg b-r-4 card-body">
                        <div class="media align-items-center static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Cancel-Orders</span>
                                <h4 class="mb-0 counter">{{ $yearly_canceled_order ? $yearly_canceled_order : 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
