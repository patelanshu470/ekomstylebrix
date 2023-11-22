@extends('backend.layouts.admin_master')
@section('content')
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
                            <h5>Pending Orders</h5>
                        </div>
                        <div class="table-responsive category-table">
                            <div>
                                <table class="table all-package theme-table" id="table_id">
                                    <thead>
                                        <tr>
                                            {{-- <th>ID</th> --}}
                                            <th>Order-No</th>
                                            <th>Grand-Total</th>
                                            <th>Billing-Name</th>
                                            <th>Shipping-Name</th>
                                            <th>Tracking-ID</th>
                                            <th>Payment-Status</th>
                                            <th>Order-Status</th>
                                            <th>Call-Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $data)
                                            <tr>
                                                {{-- <td>{{$data->id}}</td> --}}
                                                <td>{{$data->unique_no}}</td>
                                                <td>${{$data->grand_total}}</td>
                                                <td>{{$data->billing_name}}<br>
                                                    Ph: {{$data->billing_contact_number}}
                                                </td>
                                                <td>{{$data->shipping_name}}<br>
                                                    Ph: {{$data->shipping_contact_number}}
                                                </td>
                                                <td>{{($data->tracking_id)? $data->tracking_id:"N/A"}}</td>
                                                <td>
                                                    @if ($data->payment_status == "succeeded")
                                                        Succeed
                                                    @elseif ($data->payment_status == "pending")
                                                        Pending
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td class="status-close">
                                                    <span style="background-color:
                                                    @if($data->order_status=='pending')#ffeb3b70;color:black;
                                                    @elseif($data->order_status == 'confirmed')#673ab778;color:black;
                                                    @elseif($data->order_status == 'shipped')#008eff70;color:black;
                                                    @elseif($data->order_status == 'packed')#bca67878;color:black;
                                                    @elseif($data->order_status == 'canceled')#f443365c;color:black;
                                                    @elseif($data->order_status == 'delivered')#00800047;color:black;
                                                    @endif"
                                                    >{{($data->order_status)? $data->order_status:"N/A"}}</span>
                                                </td>
                                                <td>
                                                    <div class=" form-switch">
                                                        <input style="width: 37px;height: 20px;" value="1"
                                                            class="form-check-input status-checkbox"
                                                            {{ $data->call_at != null ? 'checked' : ' ' }}
                                                            id="{{ $data->id }}" data-orderid="{{ $data->id }}"
                                                            type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                                    </div>
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li>
                                                            <a href="{{ route('order.details', $data->id) }}" >
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- status change  --}}
    <script>
        $(document).ready(function() {
            $('.status-checkbox').change(function() {
                var orderID = $(this).data('orderid');
                var status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: "{{ route('call.status') }}",
                    method: "get",
                    data: {
                        id: orderID,
                        status: status,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(response.success);
                        if (response.success) {
                            toastr.success(response.success);
                        }
                    },
                });
            });
        });
    </script>
@endsection
