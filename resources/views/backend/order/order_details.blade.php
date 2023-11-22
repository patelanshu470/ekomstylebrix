@extends('backend.layouts.admin_master')
@section('content')
<style>
    .table th {
        font-size: 14px !important;
    }
    .cart-section tbody tr.table-order td{
            min-width: 100%;
        }
</style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="title-header title-header-block package-card">
                            <div>
                                <h5>Order #{{ $datas->unique_no }}
                                    @if ($datas->canceled_at)
                                        <span style="color:red;">Canceled by
                                            {{ $datas->canceled_by == 'admin' ? 'You' : 'User' }}</span>
                                    @endif
                                </h5>

                                @if($datas->delivered_at)
                                <div class="row" style="justify-content: end">
                                    <div class="col-md-2 col-xl-2 col-sm-3">
                                        <a href="{{ route('order.invoice.admin', $datas->unique_no) }}"
                                            style="border-radius:25px;background-color:#0da487;margin-bottom:5px;"
                                            class="btn  btn-md text-white fw-bold " tabindex="0">Invoice
                                            <i class="fa-solid fa-file-invoice icon"></i>
                                        </a>
                                    </div>
                                    <div class="col-md-2 col-xl-2 col-sm-3">
                                        <a href="{{ route('order.invoice.send.admin', $datas->unique_no) }}"
                                            style="border-radius:25px;background-color:#417394;margin-bottom:5px;"
                                            class="btn  btn-md text-white fw-bold " tabindex="0">Email Invoice
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                style="vertical-align: inherit !important;" class="feather feather-mail">
                                                <path
                                                    d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                                </path>
                                                <polyline points="22,6 12,13 2,6"></polyline>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                @endif

                            </div>
                            <div class="card-order-section">
                                <ul>
                                    <li>{{ $datas->created_at }}</li>
                                    <li>{{ count($orderProducts) }} items</li>
                                    <li>Total ${{ $datas->grand_total }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="bg-inner cart-section ">
                            <div class="row g-4">
                                <div class="col-xl-8">
                                    <div class="table-responsive table-details">
                                        <table class="table cart-table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th colspan="4">Items</th>
                                                    <th class="text-end" colspan="1">
                                                        <select style="border-color: #efefef !important;" id="changeStatus"
                                                            data-order_id={{ $datas->id }} class="status-change-select"
                                                            name="status">
                                                            <option value=" " disabled selected>Select Status</option>
                                                            <option value="canceled" class="canceled-class"
                                                                {{ $datas->order_status == 'canceled' ? 'selected' : ' ' }}>
                                                                Cancel</option>
                                                            <option value="confirmed" class="confirmed-class"
                                                                {{ $datas->order_status == 'confirmed' ? 'selected' : ' ' }}>
                                                                Confirmed</option>
                                                            <option value="packed" class="packed-class"
                                                                {{ $datas->order_status == 'packed' ? 'selected' : ' ' }}>
                                                                Packed</option>
                                                            <option value="shipped" class="shipped-class"
                                                                {{ $datas->order_status == 'shipped' ? 'selected' : ' ' }}>
                                                                Shipped</option>
                                                            <option value="delivered" class="delivered-class"
                                                                {{ $datas->order_status == 'delivered' ? 'selected' : ' ' }}>
                                                                Delivered</option>
                                                        </select>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orderProducts as $product)
                                                    <tr class="table-order">
                                                        <td>
                                                            <a href="javascript:void(0)">
                                                                <img style="object-fit: contain;" src="{{ $product->product->thumbnail }}"
                                                                    class="img-fluid blur-up lazyload" alt="">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <p>Product Name</p>
                                                            <h5>{{ Str::limit($product->product->name, 15) }}</h5>
                                                        </td>
                                                        <td>
                                                            <p>Size</p>
                                                            <h5>{{ $product->size }}</h5>
                                                        </td>
                                                        <td>
                                                            <p>Quantity</p>
                                                            <h5>{{ $product->quantity }}</h5>
                                                        </td>
                                                        <td>
                                                            <p>Price</p>
                                                            <h5>${{ $product->final_sell_price }}</h5>
                                                        </td>
                                                        @if ($product->returned_status)
                                                            <td>
                                                                <p>Return Request</p>
                                                                <h5 style="color:
                                                                @if ($product->returned_status == 'pending') orange;
                                                                @elseif($product->returned_status == 'rejected')#f44336;
                                                                @elseif($product->returned_status == 'approved')#0da487; @endif">{{ $product->returned_status }}</h5>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr class="table-order">
                                                    <td colspan="4">
                                                        <h5>Subtotal :</h5>
                                                    </td>
                                                    <td>
                                                        <h4>${{ $datas->subtotal }}</h4>
                                                    </td>
                                                </tr>
                                                <tr class="table-order">
                                                    <td colspan="4">
                                                        <h5>Total-Discount :</h5>
                                                    </td>
                                                    <td>
                                                        <h4>- ${{ $datas->total_discount }}</h4>
                                                    </td>
                                                </tr>
                                                @if($datas->coupon_amount)
                                                <tr class="table-order">
                                                    <td colspan="4">
                                                        <h5>Coupon-Discount :</h5>
                                                    </td>
                                                    <td>
                                                        <h4>${{ $datas->coupon_amount }}</h4>
                                                    </td>
                                                </tr>
                                                @endif
                                                <tr class="table-order">
                                                    <td colspan="4">
                                                        <h4 class="theme-color fw-bold">Total-Price :</h4>
                                                    </td>
                                                    <td>
                                                        <h4 class="theme-color fw-bold">${{ $datas->grand_total }}</h4>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="order-success">
                                        <div class="row g-4">
                                            <h4>summery</h4>
                                            <ul class="order-details">
                                                <li><b>Order ID:</b> &nbsp;{{ $datas->unique_no }}</li>
                                                <li><b>Order Date:</b> &nbsp;{{ $datas->created_at }}</li>
                                                <li><b>Order Total:</b> &nbsp;${{ $datas->grand_total }}</li>
                                            </ul>
                                            <h4>shipping address</h4>
                                            <ul class="order-details">
                                                <li>{{ $datas->shipping_address }}</li>
                                                <li>{{ $datas->shipping_city }},{{ $datas->shipping_state }},{{ $datas->shipping_country }}
                                                </li>
                                                <li>{{ $datas->shipping_pincode }},Contact No.
                                                    {{ $datas->shipping_contact_number }}</li>
                                            </ul>
                                            <div class="payment-mode">
                                                <h4>Payment Status</h4>
                                                <strong style="margin-top: 6px;">
                                                    @if ($datas->payment_status == "succeeded")
                                                        <span style="background-color:#00800047;color:black;padding: 5px;border-radius: 5px;">SUCCEED</span>
                                                    @elseif ($datas->payment_status == "pending")
                                                        <span style="background-color:#ffeb3b70;color:black;padding: 5px;border-radius: 5px;">PENDING</span>
                                                    @else
                                                        N/A
                                                    @endif
                                                </strong><br>
                                                @if ($datas->transaction_id)
                                                    Transaction ID: <strong style="margin-top: 6px;color:orange">
                                                        {{ $datas->transaction_id }}</strong>
                                                @endif
                                            </div>
                                            <div class="payment-mode">
                                                <h4 class="mb-1">Canceled Details</h4>
                                                @if ($datas->canceled_at)
                                                    <b>Canceled by:</b> <span style="color:red;">
                                                        {{ $datas->canceled_by == 'admin' ? 'You' : 'User' }}</span><br>
                                                    <b>Reason:</b> <span style="color:red;"> {{ $datas->reason->reason }}</span>
                                                @endif
                                            </div>
                                            <div class="delivery-sec">
                                                <h3 style="font-size: 16px;">expected date of delivery: <span>
                                                    @if ($datas->confirmed_at)
                                                        {{ date('Y-m-d', strtotime($datas->confirmed_at . ' +7 days')) }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </span>
                                                </h3>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if ($datas->call_at == null)
        <script>
            $(document).ready(function() {
                $('#changeStatus').on('change', function() {
                    Swal.fire({
                        title: 'Customer Confirmation is pending.',
                        text: 'Please call the customer for changing status.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Go to Confirmation page!',
                        allowOutsideClick: false,
                        showCloseButton: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('pending.orders') }}";
                        }
                    });
                });
            });
        </script>
    @else
        <script>
            $(document).ready(function() {
                $('#changeStatus').on('change', function() {
                    var status = this.value;
                    if (status == 'confirmed' || status == "packed" || status == "delivered") {
                        var statusName = status;
                        Swal.fire({
                            title: 'Confirmation!',
                            text: 'Are you sure you want to ' + statusName + ' Order',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes!',
                            cancelButtonText: "No, cancel please!",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                var status = this.value;
                                var order_id = $(this).data('order_id');
                                toastr.options = {
                                    "closeButton": true,
                                    "newestOnTop": true,
                                    "positionClass": "toast-top-right"
                                };
                                $.ajax({
                                    type: "GET",
                                    dataType: "json",
                                    url: "{{ route('order.status') }}",
                                    data: {
                                        'status': status,
                                        'order_id': order_id
                                    },
                                    success: function(data) {
                                        if (data.success) {
                                            if (statusName == 'confirmed') {
                                                $('.canceled-class').prop('disabled', true);
                                            }
                                            if (statusName == 'packed') {
                                                $('.canceled-class').prop('disabled', true);
                                                $('.confirmed-class').prop('disabled',
                                                    true);
                                            }
                                            if (statusName == 'delivered') {
                                                $('.canceled-class').prop('disabled', true);
                                                $('.confirmed-class').prop('disabled',
                                                    true);
                                                $('.packed-class').prop('disabled', true);
                                                $('.shipped-class').prop('disabled', true);
                                                $('#changeStatus').prop('disabled', true);
                                            }
                                            toastr.success(data.success);
                                        }
                                        if (data.error) {
                                            toastr.error(data.error);
                                        }
                                    }
                                });
                            } else
                                return false;
                        });
                    }
                    if (status == "shipped") {
                        var statusName = status;
                        Swal.fire({
                            title: 'Confirmation!',
                            text: 'Are you sure you want to ' + statusName + ' Order',
                            input: 'text',
                            inputLabel: 'Tracker ID',
                            inputValue: '',
                            inputPlaceholder: 'Enter Order Tracker ID',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes!',
                            cancelButtonText: "No, cancel please!",
                            inputValidator: (value) => {
                                if (!value) {
                                    return 'Please enter Order Tracker ID'
                                }
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                var status = this.value;
                                var order_id = $(this).data('order_id');
                                var inputVal = result.value;
                                toastr.options = {
                                    "closeButton": true,
                                    "newestOnTop": true,
                                    "positionClass": "toast-top-right"
                                };
                                $.ajax({
                                    type: "GET",
                                    dataType: "json",
                                    url: "{{ route('order.status') }}",
                                    data: {
                                        'status': status,
                                        'order_id': order_id,
                                        'tracking_id': inputVal
                                    },
                                    success: function(data) {
                                        if (data.success) {
                                            $('.canceled-class').prop('disabled', true);
                                            $('.confirmed-class').prop('disabled', true);
                                            $('.packed-class').prop('disabled', true);
                                            toastr.success(data.success);
                                        }
                                        if (data.error) {
                                            toastr.error(data.error);
                                        }
                                    }
                                });
                            } else
                                return false;
                        });
                    }
                    if (status == "canceled") {
                        var statusName = status;
                        Swal.fire({
                            title: 'Confirmation!',
                            text: 'Are you sure you want to ' + statusName + ' Order',
                            input: 'text',
                            inputLabel: 'Cancaled Reason',
                            inputValue: '',
                            inputPlaceholder: 'Enter your Canceled Reason',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes!',
                            cancelButtonText: "No, cancel please!",
                            inputValidator: (value) => {
                                if (!value) {
                                    return 'Please enter Canceled Reason'
                                }
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                var status = this.value;
                                var order_id = $(this).data('order_id');
                                var inputVal = result.value;
                                toastr.options = {
                                    "closeButton": true,
                                    "newestOnTop": true,
                                    "positionClass": "toast-top-right"
                                };
                                $.ajax({
                                    type: "GET",
                                    dataType: "json",
                                    url: "{{ route('order.status') }}",
                                    data: {
                                        'status': status,
                                        'order_id': order_id,
                                        'canceled_reason': inputVal
                                    },

                                    success: function(data) {
                                        if (data.success) {
                                            $('#changeStatus').prop('disabled', true);
                                            toastr.success(data.success);
                                        }
                                        if (data.error) {
                                            toastr.error(data.error);
                                        }
                                    }
                                });
                            } else
                                return false;
                        });
                    }
                });
                // {{-- disabling the select tag on refresh is selected value is cancelred  --}}
                statusValue = $('#changeStatus').val();
                if (statusValue == 'canceled') {
                    $('#changeStatus').prop('disabled', true);
                }
                if (statusValue == 'confirmed') {
                    $('.canceled-class').prop('disabled', true);
                }
                if (statusValue == 'packed') {
                    $('.canceled-class').prop('disabled', true);
                    $('.confirmed-class').prop('disabled', true);
                }
                if (statusValue == 'shipped') {
                    $('.canceled-class').prop('disabled', true);
                    $('.confirmed-class').prop('disabled', true);
                    $('.packed-class').prop('disabled', true);
                }
                if (statusValue == 'delivered') {
                    $('.canceled-class').prop('disabled', true);
                    $('.confirmed-class').prop('disabled', true);
                    $('.packed-class').prop('disabled', true);
                    $('.shipped-class').prop('disabled', true);
                    $('#changeStatus').prop('disabled', true);
                }
            });
        </script>
    @endif
@endsection
