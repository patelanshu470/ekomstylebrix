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
                            <h5>Return Request</h5>
                        </div>
                        <div class="table-responsive category-table">
                            <div>
                                <table class="table all-package theme-table" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Order-No</th>
                                            <th>Product</th>
                                            <th>Size</th>
                                            <th>Return Reason</th>
                                            <th>Status</th>
                                            <th>Request-Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $data)
                                            <tr>
                                                <td>{{ $data->user->name }}</td>
                                                <td>{{ $data->order->unique_no }}</td>
                                                <td>{{ $data->product->name }}</td>
                                                <td>{{ $data->size }}</td>
                                                <td>{{ $data->return_reason }}</td>
                                                <td class="status-close">
                                                    <span
                                                        style="background-color:
                                                    @if ($data->status == 'pending') #ffeb3b70;color:black;
                                                    @elseif($data->status == 'rejected')#f443365c;color:black;
                                                    @elseif($data->status == 'approved')#00800047;color:black; @endif">{{ $data->status }}</span>
                                                </td>
                                                <td>{{ $data->created_at }}</td>
                                                <td>
                                                    <ul>
                                                        <li>
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#returnModel{{ $data->id }}">
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
    @foreach ($datas as $data)
        <div class="modal fade" id="returnModel{{ $data->id }}" aria-hidden="true"
            aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Return Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" enctype="multipart/form-data" class="theme-form theme-form-2 mega-form"
                        id="banner4formEdit{{ $data->id }}" action="{{ route('return.order.update', $data->id) }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="mb-4 row " style="justify-content: center">
                                    <div class="form-group col-sm-6 col-6">
                                        <video controls width="100%">
                                            <source src="{{ $data->attachement }}"
                                                type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Product</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="" readonly type="text"
                                            value="{{ $data->product->name }}">
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">User</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" readonly value="{{ $data->user->name }}">
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Return-Reason</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" readonly value="{{ $data->return_reason }}">
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Requested-Date</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" readonly value="{{ $data->created_at }}">
                                    </div>
                                </div>
                                @if($data->status=="pending")
                                <div class="mb-4 row align-items-center" id="rejectReason{{$data->id}}">
                                    <label class="form-label-title col-sm-3 mb-0">Reject-Reason</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="reject_reason"></textarea>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Status</label>
                                    <div class="col-sm-9">
                                        <select class=" w-100 " name="status" id="requestStatus{{$data->id}}">
                                            <option value="pending" {{($data->status == "pending")? "selected":" "}}>Pending</option>
                                            <option value="approved" {{($data->status == "approved")? "selected":" "}}>Approve</option>
                                            <option value="rejected" {{($data->status == "rejected")? "selected":" "}}>Reject</option>
                                        </select>
                                    </div>
                                </div>
                                @endif


                            </div>
                        </div>
                        @if($data->status=="pending")
                            <div class="modal-footer">
                                <button type="submit" id="submit_btn{{ $data->id }}"
                                    class="btn btn-primary">Submit</button>
                            </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    @foreach($datas as $data)
    <script>
        $(document).ready(function() {
            var rejectOption = $('#requestStatus{{$data->id}} option[value="reject"]');
            var rejectReasonTextarea = $('#rejectReason{{$data->id}}');
            rejectReasonTextarea.hide();
            $('#requestStatus{{$data->id}}').change(function() {
                if ($(this).val() === 'rejected') {
                    rejectReasonTextarea.show();
                } else {
                    rejectReasonTextarea.hide();
                }
            });
        });
    </script>
    @endforeach

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
