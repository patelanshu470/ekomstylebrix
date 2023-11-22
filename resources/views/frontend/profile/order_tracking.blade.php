@extends('frontend.layouts.home_master')
@section('frontendContent')
    @if ($order->canceled_at)
        <style>
            .order-detail .progtrckr li.progtrckr-done:before {
                background-color: #ff0000 !important;
            }
            #custom_reason-error,
            #reason-error {
                color: red !important;
            }
            /* attention:  */
            @media (max-width: 768px) {
                .overflow-custom{
                    overflow:auto !important;
                }
                .res-reason{
                    margin-left: inherit;
                }
            }
        </style>
    @endif
    <style>
        @media (width: 1440px) {
            .col-xl-3 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 50% !important;
            }
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/custom/tracking/tracking.css') }}">
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Order Tracking</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="#">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Order Tracking</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="order-detail">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-12 col-xl-12 col-lg-12">
                    <div class="row g-sm-4 g-3" style="justify-content: end;">
                        @if ($order->delivered_at)
                            <div class="col-xl-9 col-sm-9" style="display:flex;margin-bottom:45px;">
                                <a href="{{ route('order.invoice', $order->unique_no) }}"
                                    style="border-radius:25px;background-color:#417394;"
                                    class="btn  btn-md text-white fw-bold " tabindex="0">Invoice
                                    <i class="fa-solid fa-file-invoice icon"></i>
                                </a>
                            </div>
                        @endif
                        @if ($order->confirmed_at == null and $order->canceled_at == null)
                            <div class="col-xl-3 col-sm-3" style="display:flex;justify-content: end;margin-bottom:45px;">
                                <button data-bs-toggle="modal" data-bs-target="#add-address"
                                    style="border-radius:25px;width:50%;background-color:red;"
                                    class="btn  btn-md text-white fw-bold " tabindex="0">Cancel Order
                                    <i class="fa-solid fa-xmark icon"></i></button>
                            </div>
                        @else
                            <div class="col-xl-3 col-sm-3" style="display:flex;justify-content: end;margin-bottom:45px;">
                            </div>
                        @endif
                    </div>
                    <div class="row g-sm-4 g-3">
                        <div class="col-xl-3 col-lg-6 col-sm-6">
                            <div class="order-details-contain">
                                <div class="order-tracking-icon">
                                    <i data-feather="package" class="text-content"></i>
                                </div>
                                <div class="order-details-name">
                                    <h5 class="text-content">Tracking Code</h5>
                                    <h2 class="theme-color">{{ $order->tracking_id ? $order->tracking_id : 'N/A' }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-6">
                            <div class="order-details-contain">
                                <div class="order-tracking-icon">
                                    <i class="text-content" data-feather="crosshair"></i>
                                </div>
                                <div class="order-details-name">
                                    <h5 class="text-content">Order-Details</h5>
                                    <h4>Total-Items:<span class="address details"
                                            style="font-weight: 400;margin-left:10px;color: #417394;">
                                            @php
                                                $item = App\Models\OrderedProduct::where('order_id', $order->id)->get();
                                            @endphp
                                            <strong>{{ count($item) }}</strong></span></h4>
                                    <h4>Sub-Total:<span class="address details"
                                            style="font-weight: 400;margin-left:10px;color: #417394;">
                                            <strong>${{ $order->subtotal }}</strong></span></h4>
                                    <h4>Total-Discount:<span class="address details"
                                            style="font-weight: 400;margin-left:10px;color: #417394;">
                                            <strong>${{ $order->total_discount }}</strong></span></h4>
                                    @if ($order->coupon_amount)
                                        <h4>Coupon-Discount:<span class="address details"
                                                style="font-weight: 400;margin-left:10px;color: #417394;">
                                                <strong>${{ $order->coupon_amount }}</strong></span></h4>
                                    @endif
                                    <h4>Grand-Total:<span class="address details"
                                            style="font-weight: 400;margin-left:10px;color: #417394;">
                                            <strong>${{ $order->grand_total }}</strong></span></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-6">
                            <div class="order-details-contain">
                                <div class="order-tracking-icon">
                                    <svg width="25px" height="auto" stroke="currentColor"
                                        class="feather feather-calendar text-content" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 256 256"
                                        xml:space="preserve">
                                        <defs>
                                        </defs>
                                        <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;"
                                            transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                            <path
                                                d="M 67.245 21.439 c -1.104 0 -2 -0.896 -2 -2 V 2.136 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 17.303 C 69.245 20.543 68.35 21.439 67.245 21.439 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 2 71.518 c -1.104 0 -2 -0.896 -2 -2 V 2.136 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 67.382 C 4 70.622 3.104 71.518 2 71.518 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 77.622 89.864 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 c 3.931 0 7.237 -2.721 8.137 -6.377 H 67.245 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 H 88 c 1.104 0 2 0.896 2 2 C 90 84.312 84.447 89.864 77.622 89.864 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 67.245 79.487 c -1.104 0 -2 -0.896 -2 -2 V 53.169 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 24.318 C 69.245 78.592 68.35 79.487 67.245 79.487 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 12.377 89.864 C 5.553 89.864 0 84.312 0 77.487 v -7.97 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 7.97 c 0 4.619 3.758 8.377 8.377 8.377 c 1.104 0 2 0.896 2 2 S 13.482 89.864 12.377 89.864 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 77.622 89.864 H 12.377 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 h 65.245 c 1.104 0 2 0.896 2 2 S 78.727 89.864 77.622 89.864 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 12.377 89.864 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 c 4.619 0 8.377 -3.758 8.377 -8.377 c 0 -1.104 0.896 -2 2 -2 h 44.49 c 1.104 0 2 0.896 2 2 s -0.896 2 -2 2 H 24.593 C 23.635 85.364 18.521 89.864 12.377 89.864 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 41.739 52.07 H 15.876 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 h 25.863 c 1.104 0 2 0.896 2 2 S 42.844 52.07 41.739 52.07 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 71.038 40.392 c -1.073 0 -1.949 -0.845 -1.998 -1.906 c -1.061 -0.049 -1.906 -0.925 -1.906 -1.998 c 0 -1.104 0.896 -2 2 -2 c 2.153 0 3.904 1.751 3.904 3.904 C 73.038 39.496 72.143 40.392 71.038 40.392 z M 69.134 38.487 h 0.01 H 69.134 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 67.245 31.748 c -1.104 0 -2 -0.896 -2 -2 V 27.39 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 2.358 C 69.245 30.852 68.35 31.748 67.245 31.748 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 69.134 38.487 h -3.778 c -2.153 0 -3.904 -1.751 -3.904 -3.904 v -2.931 c 0 -2.153 1.751 -3.904 3.904 -3.904 h 3.778 c 2.153 0 3.904 1.751 3.904 3.904 c 0 1.104 -0.896 2 -2 2 c -1.072 0 -1.948 -0.844 -1.998 -1.904 h -3.589 v 2.74 h 3.683 c 1.104 0 2 0.896 2 2 S 70.238 38.487 69.134 38.487 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 67.245 47.586 c -1.104 0 -2 -0.896 -2 -2 v -2.358 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 2.358 C 69.245 46.69 68.35 47.586 67.245 47.586 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 69.134 45.228 h -3.778 c -2.153 0 -3.904 -1.751 -3.904 -3.904 c 0 -1.104 0.896 -2 2 -2 c 1.072 0 1.948 0.844 1.998 1.904 h 3.589 v -2.836 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 2.932 C 73.038 43.476 71.287 45.228 69.134 45.228 z M 65.451 41.323 h 0.01 H 65.451 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 54.271 64.202 H 15.876 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 h 38.395 c 1.104 0 2 0.896 2 2 S 55.375 64.202 54.271 64.202 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 59.09 11.045 c -0.46 0 -0.92 -0.158 -1.293 -0.474 l -6.863 -5.814 l -6.862 5.814 c -0.746 0.632 -1.84 0.632 -2.586 0 l -6.863 -5.814 l -6.863 5.814 c -0.746 0.632 -1.84 0.632 -2.586 0 l -6.863 -5.814 l -6.862 5.814 c -0.746 0.632 -1.84 0.632 -2.586 0 L 0.707 3.662 C -0.136 2.948 -0.24 1.686 0.474 0.843 C 1.188 -0.001 2.45 -0.104 3.293 0.61 l 6.863 5.814 l 6.862 -5.814 c 0.746 -0.632 1.84 -0.632 2.586 0 l 6.863 5.814 L 33.33 0.61 c 0.746 -0.632 1.84 -0.632 2.586 0 l 6.863 5.814 l 6.862 -5.814 c 0.746 -0.632 1.84 -0.632 2.586 0 l 6.863 5.814 l 6.862 -5.814 c 0.843 -0.713 2.104 -0.61 2.819 0.233 c 0.714 0.843 0.609 2.105 -0.233 2.819 l -8.155 6.909 C 60.01 10.887 59.55 11.045 59.09 11.045 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 67.245 55.169 c -10.402 0 -18.865 -8.463 -18.865 -18.865 s 8.463 -18.865 18.865 -18.865 c 10.401 0 18.864 8.463 18.864 18.865 S 77.646 55.169 67.245 55.169 z M 67.245 21.439 c -8.196 0 -14.865 6.668 -14.865 14.865 s 6.669 14.865 14.865 14.865 S 82.109 44.5 82.109 36.304 C 82.109 28.107 75.441 21.439 67.245 21.439 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 34.69 39.939 H 15.876 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 H 34.69 c 1.104 0 2 0.896 2 2 S 35.794 39.939 34.69 39.939 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 41.739 27.808 H 15.876 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 h 25.863 c 1.104 0 2 0.896 2 2 S 42.844 27.808 41.739 27.808 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                        </g>
                                    </svg>
                                </div>
                                <div class="order-details-name">
                                    <h5 class="text-content">Billing-Details</h5>
                                    <h4>Name:<span class="address" style="font-weight: 400;margin-left:10px;">
                                            <strong style="font-size: initial;">{{ $order->billing_name }}</strong></span></h4>
                                    <h4>Email:<span class="address" style="font-weight: 400;margin-left:10px;">
                                            <strong style="font-size: initial;">{{ $order->billing_email }}</strong></span></h4>
                                    <h4>Contact-Number:<span class="address" style="font-weight: 400;margin-left:10px;">
                                            <strong style="font-size: initial;">{{ $order->billing_contact_number }}</strong></span></h4>
                                    <h4>Address:<span class="address" style="font-weight: 400;margin-left:10px;">
                                            <strong style="font-size: initial;">{{ $order->billing_address }}</strong></span></h4>
                                    <h4>LandMark:<span class="address" style="font-weight: 400;margin-left:10px;">
                                            <strong style="font-size: initial;">{{ $order->billing_landmark }}</strong></span></h4>
                                    <h4>Pin-Code:<span class="address" style="font-weight: 400;margin-left:10px;">
                                            <strong style="font-size: initial;">{{ $order->billing_pincode }}</strong> </span></h4>
                                    <h4>City:<span class="address" style="font-weight: 400;margin-left:10px;">
                                            <strong style="font-size: initial;">{{ $order->billing_city }}</strong> </span></h4>
                                    <h4>State:<span class="address" style="font-weight: 400;margin-left:10px;">
                                            <strong style="font-size: initial;">{{ $order->billing_state }}</strong> </span></h4>
                                    <h4>Country:<span class="address" style="font-weight: 400;margin-left:10px;">
                                            <strong style="font-size: initial;">{{ $order->billing_country }}</strong> </span></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-6">
                            <div class="order-details-contain">
                                <div class="order-tracking-icon">
                                    <i class="text-content" data-feather="map-pin"></i>
                                </div>
                                <div class="order-details-name">
                                    <h5 class="text-content">Shipping-Address</h5>
                                    <h4>Name:<span class="address" style="font-weight: 400;margin-left:10px;">
                                            <strong style="font-size: initial;" >{{ $order->shipping_name }}</strong></span></h4>
                                    <h4>Email:<span class="address" style="font-weight: 400;margin-left:10px;">
                                            <strong style="font-size: initial;">{{ $order->shipping_email }}</strong></span></h4>
                                    <h4>Contact-Number:<span class="address" style="font-weight: 400;margin-left:10px;">
                                            <strong style="font-size: initial;">{{ $order->shipping_contact_number }}</strong></span></h4>
                                    <h4>Address:<span class="address" style="font-weight: 400;margin-left:10px;">
                                            <strong style="font-size: initial;">{{ $order->shipping_address }}</strong></span></h4>
                                    <h4>LandMark:<span class="address" style="font-weight: 400;margin-left:10px;">
                                            <strong style="font-size: initial;">{{ $order->shipping_landmark }}</strong></span></h4>
                                    <h4>Pin-Code:<span class="address" style="font-weight: 400;margin-left:10px;">
                                            <strong style="font-size: initial;">{{ $order->shipping_pincode }}</strong> </span></h4>
                                    <h4>City:<span class="address" style="font-weight: 400;margin-left:10px;">
                                            <strong style="font-size: initial;">{{ $order->shipping_city }}</strong> </span></h4>
                                    <h4>State:<span class="address" style="font-weight: 400;margin-left:10px;">
                                            <strong style="font-size: initial;">{{ $order->shipping_state }}</strong> </span></h4>
                                    <h4>Country:<span class="address" style="font-weight: 400;margin-left:10px;">
                                            <strong style="font-size: initial;">{{ $order->shipping_country }}</strong> </span></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 overflow-hidden overflow-custom">
                            @if ($order->canceled_at)
                                <ol class="progtrckr">
                                    <li class="progtrckr-{{ $order->canceled_at ? 'done' : 'todo' }}" >
                                        <h5>Canceled</h5>
                                        <span>Canceled by: {{ $order->canceled_by == 'admin' ? 'Seller' : 'You' }} at
                                            {{ $order->canceled_at ? $order->canceled_at : 'N/A' }}</span>
                                        <h5 class="res-reason" > <strong>{{ $order->reason->reason }}</strong> </h5>
                                    </li>
                                </ol>
                            @else
                                <ol class="progtrckr">
                                    {{-- <li class="progtrckr-{{ $order->call_at ? 'done' : 'todo' }}">
                                        <h5>Call</h5>
                                        <h6>{{ $order->call_at ? $order->call_at : 'N/A' }}</h6>
                                    </li> --}}
                                    <li class="progtrckr-{{ $order->confirmed_at ? 'done' : 'todo' }}">
                                        <h5>Confirmed</h5>
                                        <h6>{{ $order->confirmed_at ? $order->confirmed_at : 'N/A' }}</h6>
                                    </li>
                                    {{-- <li
                                        class="progtrckr-{{ ($order->packed_at or $order->shipped_at) ? 'done' : 'todo' }}">
                                        <h5>Packed</h5>
                                        <h6>{{ $order->packed_at ? $order->packed_at : 'N/A' }}</h6>
                                    </li> --}}
                                    <li class="progtrckr-{{ $order->shipped_at ? 'done' : 'todo' }}">
                                        <h5>Shipped</h5>
                                        <h6>{{ $order->shipped_at ? $order->shipped_at : 'N/A' }}</h6>
                                    </li>
                                    <li class="progtrckr-{{ $order->delivered_at ? 'done' : 'todo' }}">
                                        <h5>Delivered</h5>
                                        <h6>{{ $order->delivered_at ? $order->delivered_at : 'N/A' }}</h6>
                                    </li>
                                </ol>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="order-table-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table order-tab-table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name & Size</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Discount</th>
                                    <th>Subtotal</th>
                                    <th>Review</th>
                                    <th>Return</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- attention:  --}}
                                @foreach ($products as $product)
                                    <tr>
                                        <td><img src="{{ $product->product->thumbnail }}" alt="" style="width: 65px;"></td>
                                        <td style="color: black">{{ $product->product->name }} <br>
                                            <b>Size:-</b>{{ $product->size }}</td>
                                        <td style="color: black">${{ $product->sell_price }}</td>
                                        <td style="color: black">{{ $product->quantity }}</td>
                                        <td style="color: black">${{ $product->discount }}</td>
                                        <td style="color: black">${{ $product->payable_amount }}</td>
                                        <td style="color: black">
                                            @php
                                                $dublicate_check = App\Models\ProductReview::where([['product_id', '=', $product->product_id], ['user_id', '=', Auth()->user()->id]])
                                                    ->get()
                                                    ->first();
                                            @endphp
                                            @if ($order->order_status == 'delivered')
                                                @if ($dublicate_check)
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#edit-address{{ $product->id }}">
                                                        <div class="product-rating">
                                                            @if ($product->product->review[0]->rating == null)
                                                                <ul class="rating">
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                </ul>
                                                            @elseif($product->product->review[0]->rating == '1')
                                                                <ul class="rating">
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                </ul>
                                                            @elseif($product->product->review[0]->rating == '2')
                                                                <ul class="rating">
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                </ul>
                                                            @elseif($product->product->review[0]->rating == '3')
                                                                <ul class="rating">
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                </ul>
                                                            @elseif($product->product->review[0]->rating == '4')
                                                                <ul class="rating">
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                </ul>
                                                            @elseif($product->product->review[0]->rating == '5')
                                                                <ul class="rating">
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                </ul>
                                                            @endif
                                                        </div>
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#add-review{{ $product->id }}">
                                                        <div class="product-rating">

                                                            @if ($product->product->rating == null)
                                                                <ul class="rating">
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                </ul>
                                                            @elseif($product->product->rating->rating == '1')
                                                                <ul class="rating">
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                </ul>
                                                            @elseif($product->product->rating == '2')
                                                                <ul class="rating">
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                </ul>
                                                            @elseif($product->product->rating == '3')
                                                                <ul class="rating">
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                </ul>
                                                            @elseif($product->product->rating == '4')
                                                                <ul class="rating">
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                </ul>
                                                            @elseif($product->product->rating == '5')
                                                                <ul class="rating">
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                </ul>
                                                            @endif
                                                        </div>
                                                    </button>
                                                @endif
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td style="color: black">
                                            @if ($order->delivered_at and now()->diffInDays($order->delivered_at) <= 4)
                                                <a style="background-color:#ff7272;"
                                                    href="{{ route('return.product', $product->id) }}"
                                                    class="btn  btn-md text-white fw-bold ">Return
                                                    <i class="fa-solid fa-truck icon"></i></a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- cancel form  --}}
        @if ($order->confirmed_at == null and $order->canceled_at == null)
            <div class="modal fade theme-modal " id="add-address" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down  modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cancel Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="modal-body ">
                            <form action="{{ route('order.cancel', $order->id) }}" method="get" id="cancelForm">
                                <div>
                                    <div class="accordion-body">
                                        <div class="row g-2">
                                            <div class="col-12">
                                                <div class="payment-method">
                                                    <div class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                        <select class="form-select" id="reason" name="reason"
                                                            aria-label="">
                                                            <option value="" selected="" disabled="">Select
                                                                Cancel Reason</option>
                                                            <option>Ordered by mistake</option>
                                                            <option>Ordered wrong product</option>
                                                            <option>Delivery date too long</option>
                                                            <option>Shipping or handling costs too high</option>
                                                            <option>Concerns about product quality or safety</option>
                                                            <option>Payment issues</option>
                                                            <option>Shipping address incorrect or incomplete</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="checkout-detail">
                                                <div class="accordion accordion-flush custom-accordion"
                                                    id="accordionFlushExample">
                                                    <div class="accordion-item">
                                                        <div class="accordion-header" id="flush-headingOne"
                                                            style="argin-left: -23px; margin-bottom: 19px;">
                                                            <div class="accordion-button collapsed" style="padding:0px;">
                                                                <div class="custom-form-check form-check mb-0 common-checkbox"
                                                                    style="padding: 0px !important;">
                                                                    <div class="form-floating  theme-form-floating">
                                                                        <div
                                                                            class="form-check form-switch switch-radio ms-auto">
                                                                            <input class="form-check-input"
                                                                                id="collaspe_btn"
                                                                                data-bs-toggle="collapse"
                                                                                data-bs-target="#flush-collapseOne"
                                                                                name="is_custom_reason" value="1"
                                                                                type="checkbox" role="switch"
                                                                                style="width:37px;height:20px;margin-lef:0px !important;"
                                                                                id="redio3" aria-checked="false">
                                                                            <label class="form-check-label"
                                                                                style="margin-top:2px;margin-left:10px;"
                                                                                for="redio3">Custom Reason?</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                            data-bs-parent="#accordionFlushExample">
                                                            <div class="accordion-body" style="padding:0px !important;">
                                                                <div class="row ">
                                                                    <div class="col-12">
                                                                        <div class="payment-method">
                                                                            <div
                                                                                class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                                                <textarea class="form-control" id="custom_reason" name="custom_reason" placeholder=""></textarea></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-animation btn-md fw-bold"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit"
                                            class="btn theme-bg-color btn-md text-white">Submit</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{-- end  --}}
    </section>
    @foreach ($products as $product)
        {{-- add  --}}
        <div class="modal fade theme-modal " id="add-review{{ $product->id }}" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Write a Review</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <form action="{{ route('add.review') }}" method="post" id="ratingAddForm{{ $product->id }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div>
                                <div class="accordion-body">
                                    <div class="row g-2">
                                        <div class="col-12">
                                            <div class="payment-method">
                                                <div class="row" style="justify-content: center">
                                                    <div class="form-group col-sm-12 col-12"
                                                        style="margin-bottom: -57px;margin-top:-22px;">
                                                        <div class="avatar-upload">
                                                            <div class="avatar-edit">
                                                                <input type='file' id="imageUpload{{ $product->id }}"
                                                                    class="file-input{{ $product->id }}"
                                                                    name="review_image" accept=".png, .jpg, .jpeg" />
                                                                <label for="imageUpload{{ $product->id }}"></label>
                                                            </div>
                                                            <label class="form-label-title mb-0">Image</label>
                                                            <div class="avatar-preview">
                                                                <div id="banner{{ $product->id }}"
                                                                    class="image{{ $product->id }}"
                                                                    style="background-image: url('{{ asset('public/no-image.png') }}');">
                                                                </div>
                                                            </div>
                                                            <span class="thumbnail-error" style="color:red"></span>

                                                            <div class="star-rating">
                                                                <input type="radio" id="add-5-stars{{ $product->id }}"
                                                                    name="rating" value="5" />
                                                                <label for="add-5-stars{{ $product->id }}"
                                                                    class="star">&#9733;</label>
                                                                <input type="radio" id="add-4-stars{{ $product->id }}"
                                                                    name="rating" value="4" />
                                                                <label for="add-4-stars{{ $product->id }}"
                                                                    class="star">&#9733;</label>
                                                                <input type="radio" id="add-3-stars{{ $product->id }}"
                                                                    name="rating" value="3" />
                                                                <label for="add-3-stars{{ $product->id }}"
                                                                    class="star">&#9733;</label>
                                                                <input type="radio" id="add-2-stars{{ $product->id }}"
                                                                    name="rating" value="2" />
                                                                <label for="add-2-stars{{ $product->id }}"
                                                                    class="star">&#9733;</label>
                                                                <input type="radio" id="add-1-star{{ $product->id }}"
                                                                    name="rating" value="1" />
                                                                <label for="add-1-star{{ $product->id }}"
                                                                    class="star{{ $product->id }}">&#9733;</label>
                                                            </div>
                                                            <span class="rating-required"
                                                                style="color:red;margin-left: 23px;"></span>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <input type="hidden" name="product_id" value="{{ $product->product_id }}"
                                            required />

                                        <div class="col-12 mt-3">
                                            <div class="payment-method">
                                                <div class="form-floating theme-form-floating">
                                                    <textarea class="form-control" placeholder="" name="description" id="floatingTextarea2" style="height: 150px"></textarea>
                                                </div>
                                                <label for="floatingTextarea2">Write Your review</label>
                                            </div>
                                        </div>
                                        <span class="description-required" style="color:red"></span>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-animation btn-md fw-bold"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn theme-bg-color btn-md text-white">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- edit model  --}}
        @php
            $ratingCheck = App\Models\ProductReview::where([['product_id', '=', $product->product_id], ['user_id', '=', Auth()->user()->id]])
                ->get()
                ->first();
        @endphp
        @if ($ratingCheck)
            <div class="modal fade theme-modal" id="edit-address{{ $product->id }}" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down  modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Review</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="modal-body ">
                            <form action="{{ route('update.review') }}" method="post" enctype="multipart/form-data"
                                id="ratingEditForm{{ $product->id }}">
                                @csrf
                                <div>
                                    <div class="accordion-body">
                                        <div class="row g-2">
                                            <div class="col-12">
                                                <div class="payment-method">
                                                    <div class=" row " style="justify-content: center">
                                                        <div class="form-group col-sm-12 col-12"
                                                            style="margin-bottom: -57px;margin-top:-22px;">
                                                            <div class="avatar-upload">
                                                                <div class="avatar-edit">
                                                                    <input type='file'
                                                                        id="imageUploadEdit{{ $product->id }}"
                                                                        class="file-input{{ $product->id }}"
                                                                        name="review_image" accept=".png, .jpg, .jpeg" />
                                                                    <label
                                                                        for="imageUploadEdit{{ $product->id }}"></label>
                                                                </div>
                                                                <label class="form-label-title mb-0">Image</label>
                                                                <div class="avatar-preview">
                                                                    <div id="bannerEdit{{ $product->id }}"
                                                                        class="image{{ $product->id }}"
                                                                        style="background-image: url('{{ $product->product->review[0]->image ? $product->product->review[0]->image : asset('public/no-image.png') }}');">
                                                                    </div>
                                                                </div>
                                                                <span class="thumbnail-error" style="color:red"></span>
                                                                <div class="star-rating">
                                                                    <input type="radio"
                                                                        id="5-stars{{ $product->product_id }}"
                                                                        name="rating"
                                                                        {{ $product->product->review[0]->rating == '5' ? 'checked' : '' }}
                                                                        value="5" />
                                                                    <label for="5-stars{{ $product->product_id }}"
                                                                        class="star">&#9733;</label>
                                                                    <input type="radio"
                                                                        id="4-stars{{ $product->product_id }}"
                                                                        name="rating"
                                                                        {{ $product->product->review[0]->rating == '4' ? 'checked' : '' }}
                                                                        value="4" />
                                                                    <label for="4-stars{{ $product->product_id }}"
                                                                        class="star">&#9733;</label>
                                                                    <input type="radio"
                                                                        id="3-stars{{ $product->product_id }}"
                                                                        name="rating"
                                                                        {{ $product->product->review[0]->rating == '3' ? 'checked' : '' }}
                                                                        value="3" />
                                                                    <label for="3-stars{{ $product->product_id }}"
                                                                        class="star">&#9733;</label>
                                                                    <input type="radio"
                                                                        id="2-stars{{ $product->product_id }}"
                                                                        name="rating"
                                                                        {{ $product->product->review[0]->rating == '2' ? 'checked' : '' }}
                                                                        value="2" />
                                                                    <label for="2-stars{{ $product->product_id }}"
                                                                        class="star">&#9733;</label>
                                                                    <input type="radio"
                                                                        id="1-star{{ $product->product_id }}"
                                                                        name="rating"
                                                                        {{ $product->product->review[0]->rating == '1' ? 'checked' : '' }}
                                                                        value="1" />
                                                                    <label for="1-star{{ $product->product_id }}"
                                                                        class="star">&#9733;</label>
                                                                </div>
                                                                <span class="rating-required"
                                                                    style="color:red;margin-left: 23px;"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="product_id" value="{{ $product->product_id }}"
                                                required />
                                            <div class="col-12">
                                                <div class="payment-method">
                                                    <div class="form-floating theme-form-floating">
                                                        <textarea class="form-control" placeholder="Leave a comment here" name="description" id="floatingTextarea2"
                                                            style="height: 150px">@php echo $product->product->review[0]->description @endphp</textarea>
                                                    </div>
                                                    <label for="floatingTextarea2">Write Your review</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-animation btn-md fw-bold"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn theme-bg-color btn-md text-white">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="{{ asset('public/frontend/custom/tracking/tracking.js') }}"></script>
    <script>
        $(document).ready(function() {
            @foreach ($products as $product)
                $("#imageUpload{{ $product->id }}").change(function() {
                    readURL(this, 'banner{{ $product->id }}');
                });
                $("#imageUploadEdit{{ $product->id }}").change(function() {
                    readURL(this, 'bannerEdit{{ $product->id }}');
                });
            @endforeach
            function readURL(input, previewId) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#' + previewId).css('background-image', 'url(' + e.target.result + ')');
                        $('#' + previewId).hide();
                        $('#' + previewId).fadeIn(650);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>
    {{-- validation  --}}
    @foreach ($products as $product)
        {{--  add form validation --}}
        <script>
            $('#ratingAddForm{{ $product->id }}').validate({
                rules: {
                    description: {
                        required: true,
                    },
                    product_id: {
                        required: true,
                    },
                    rating: {
                        required: true,
                    },
                },
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#ratingAddForm{{ $product->id }}').submit(function(e) {
                    if (!$('input[name="rating"]:checked').length) {
                        e.preventDefault();
                        $('.rating-required').text('Please select a rating.');
                        // alert('Please select a rating.');
                    }
                });
            });
        </script>
        {{-- Edit form validate  --}}
        <script>
            $('#ratingEditForm{{ $product->id }}').validate({
                rules: {
                    description: {
                        required: true,
                    },
                    product_id: {
                        required: true,
                    },
                    rating: {
                        required: true,
                    },
                },
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#ratingEditForm{{ $product->id }}').submit(function(e) {
                    if (!$('input[name="rating"]:checked').length) {
                        e.preventDefault();
                        $('.rating-required').text('Please select a rating.');
                        // alert('Please select a rating.');
                    }
                });
            });
        </script>
    @endforeach
    <script>
        @if (Session::has('errors'))
            var errors = @json(Session::get('errors'));
            var errorMessage = '';
            for (var key in errors) {
                if (errors.hasOwnProperty(key)) {
                    errorMessage += errors[key].join('<br>');
                }
            }
            alert(errorMessage);
        @endif
    </script>
@endsection
