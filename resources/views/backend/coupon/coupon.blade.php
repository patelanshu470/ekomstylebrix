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
                            <h5>All Coupon</h5>
                            <form class="d-inline-flex">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModalToggle2"
                                    class="align-items-center btn btn-theme d-flex">
                                    <i data-feather="plus-square"></i>Add New
                                </a>
                            </form>
                        </div>
                        <div class="table-responsive category-table">
                            <div>
                                <table class="table all-package theme-table" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>Header-Text</th>
                                            <th>Image</th>
                                            <th>Coupon-code</th>
                                            <th>Discount(%)</th>
                                            <th>Expiry-Date</th>
                                            <th>Is-Featured?</th>
                                            <th>Status</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $data)
                                            <tr>
                                                <td>{{ $data->header_text }}</td>
                                                <td>
                                                    <div class="category-icon" style="width: 65px;height:65px">
                                                        <img style="object-fit: cover;"
                                                            src="{{ $data->image ? $data->image : 'https://dummyimage.com/65x65/fff' }}"
                                                            alt="category-images">
                                                    </div>
                                                </td>
                                                <td>{{ $data->coupon_code }}</td>
                                                <td>{{ $data->discount }} %</td>
                                                <td>{{ $data->expiry_date }} </td>
                                                <td>{{ $data->is_feature ? 'Yes' : 'No' }} </td>
                                                <td>
                                                    <div class=" form-switch">
                                                        <input style="width: 37px;height: 20px;"
                                                            class="form-check-input status-checkbox"
                                                            {{ $data->status == 1 ? 'checked' : ' ' }}
                                                            id="{{ $data->id }}" data-id="{{ $data->id }}"
                                                            type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{route('coupon.send',$data->id)}}"  style="background-color:#0785ff !important;"
                                                    class="align-items-center btn btn-theme d-flex">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                                    Send
                                                </a>
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li>
                                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#editModel{{$data->id}}">
                                                                <i class="ri-pencil-line"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#deleteModel{{ $data->id }}">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <!-- Delete Modal Box Start -->
                                            <div class="modal fade theme-modal remove-coupon"
                                                id="deleteModel{{ $data->id }}" aria-hidden="true" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header d-block text-center">
                                                            <h5 class="modal-title w-100" id="exampleModalLabel22">Are You
                                                                Sure ?</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="remove-box">
                                                                <p>Are you sure,you want to delete this record?</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-animation btn-md fw-bold"
                                                                data-bs-dismiss="modal">No</button>
                                                            <a href="{{ route('coupon.delete', $data->id) }}"
                                                                class="btn btn-animation btn-md fw-bold">Yes</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
    {{-- add model  --}}
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Add Coupon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" enctype="multipart/form-data" class="theme-form theme-form-2 mega-form"
                    id="banner4formAdd" action="{{ route('coupon.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0" style="margin-right: -110px;">Feature this
                                    coupon?</label>
                                <div class="col-sm-9">
                                    <div class=" form-switch">
                                        <input style="width: 37px;height: 20px;" value="1" name="is_feature"
                                            class="form-check-input" id="featureBtn" type="checkbox" role="switch">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4 row " style="justify-content: center">
                                <div class="form-group col-sm-6 col-6">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="imageUpload4" name="image"
                                                accept=".png, .jpg, .jpeg" />
                                            <label for="imageUpload4"></label>
                                        </div>
                                        <label class="form-label-title mb-0">Background-Image</label>
                                        <div class="avatar-preview">
                                            <div id="banner4"
                                                style="background-image: url('{{ asset('public/no-image.png') }}');">
                                            </div>
                                        </div>
                                        <label class="form-label-title mb-0">Recommended-Size:(1550x140 px)</label>
                                        <span class="banner4-error" style="color:red"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Header-Text</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="header_text" type="text"
                                        placeholder="50 % off on someting..">
                                </div>
                            </div>
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Discount(%)</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="discount" type="number" id="discount"
                                        placeholder="discount %">
                                </div>
                            </div>
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Coupon-code</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="coupon_code" type="text" id="couponCode"
                                        placeholder="coupon code">
                                    <span class="coupon-error"></span>
                                </div>
                            </div>
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Expiry-Date</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="expiry_date" type="date">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit_btn" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- edit model  --}}
    @foreach ($datas as $data)
        <div class="modal fade" id="editModel{{$data->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
            tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Edit Coupon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" enctype="multipart/form-data" class="theme-form theme-form-2 mega-form"
                        id="banner4formEdit{{$data->id}}" action="{{ route('coupon.update',$data->id) }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0" style="margin-right: -110px;">Feature this coupon?</label>
                                    <div class="col-sm-9">
                                        <div class=" form-switch">
                                            <input style="width: 37px;height: 20px;" value="1" name="is_feature" {{($data->is_feature == '1')? "checked":" "}}
                                                class="form-check-input" id="featureBtn" type="checkbox" role="switch">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row " style="justify-content: center">
                                    <div class="form-group col-sm-6 col-6">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input type='file' id="imageUpload4Edit{{$data->id}}" name="image"
                                                    accept=".png, .jpg, .jpeg" />
                                                <label for="imageUpload4Edit{{$data->id}}"></label>
                                            </div>
                                            <label class="form-label-title mb-0">Background-Image</label>
                                            <div class="avatar-preview">
                                                <div id="banner4Edit{{$data->id}}"
                                                    style="background-image: url('{{ $data->image }}');">
                                                </div>
                                            </div>
                                            <label class="form-label-title mb-0">Recommended-Size:(1550x140 px)</label>
                                            <span class="banner4-errorEdit{{$data->id}}" style="color:red"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Header-Text</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="header_text" type="text" value="{{$data->header_text}}"
                                            placeholder="50 % off on someting..">
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Discount(%)</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="discount" type="number" id="discount{{$data->id}}" value="{{$data->discount}}"
                                            placeholder="discount %">
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Coupon-code</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="coupon_code" type="text" id="couponCode{{$data->id}}" data-id="{{$data->id}}" value="{{$data->coupon_code}}"
                                            placeholder="coupon code">
                                        <span class="coupon-error{{$data->id}}"></span>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Expiry-Date</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" value="{{$data->expiry_date}}" name="expiry_date" type="date">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="submit_btn{{$data->id}}" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{-- end edit-model  --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="{{asset('public/cust_backend/coupon/coupon.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('#couponCode').on('keyup', function() {
                var code = this.value;
                $.ajax({
                    url: "{{ route('coupon.check') }}",
                    type: "GET",
                    data: {
                        code: code,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result);
                        if (result.data == null) {
                            $('.coupon-error').text('Coupon is available.').css('color',
                                'green');
                            $('#submit_btn').attr('disabled', false);
                        } else {
                            $('.coupon-error').text('Coupon is already in use.').css('color',
                                'red');
                            $('#submit_btn').attr('disabled', true);
                        }
                    }
                });
            });
        });
    </script>

    {{-- status change  --}}
    <script>
        $(document).ready(function() {
            $('.status-checkbox').change(function() {
                var catId = $(this).data('id');
                var status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: "{{ route('coupon.status') }}",
                    method: "POST",
                    data: {
                        id: catId,
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

    @foreach ($datas as $data)
    <script>
        $('#banner4formEdit{{$data->id}}').validate({
            rules: {
                expiry_date: {
                    required: true,
                },
                coupon_code: {
                    required: true,
                },
                discount: {
                    required: true,
                },
                header_text: {
                    required: true,
                },
            },
        });
        $("#imageUpload4Edit{{$data->id}}").change(function() {
            readURL(this, 'banner4Edit{{$data->id}}');
        });

        $(document).ready(function() {
            $('#discount{{$data->id}}').on('input', function() {
                var val = parseInt($(this).val(), 10);
                if (isNaN(val) || val < 0) {
                    $(this).val(0);
                } else if (val > 100) {
                    $(this).val(100);
                }
            });
        });

        $(document).ready(function() {
            $('#couponCode{{$data->id}}').on('keyup', function() {
                var code = this.value;
              var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('coupon.check') }}",
                    type: "GET",
                    data: {
                        code: code,
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result);
                        if (result.data == null) {
                            $('.coupon-error{{$data->id}}').text('Coupon is available.').css('color',
                                'green');
                            $('#submit_btn{{$data->id}}').attr('disabled', false);
                        } else {
                            $('.coupon-error{{$data->id}}').text('Coupon is already in use.').css('color',
                                'red');
                            $('#submit_btn{{$data->id}}').attr('disabled', true);
                        }
                    }
                });
            });
        });
    </script>
    @endforeach

@endsection
