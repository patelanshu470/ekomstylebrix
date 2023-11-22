@extends('backend.layouts.admin_master')
@section('content')
    <style>
        .table th {
            font-size: 14px;
        }
        .custom-icon {
            color: #417394 !important;
        }
        .theme-table tbody tr{
            background-color: #fff !important;
        }
        .theme-table tbody tr.child-tr{
            background-color: #f8f8f8 !important;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="title-header option-title" style="justify-content: start !important;">
                                    <h5>All Product</h5>
                                    <a href="{{ route('product.filter', ['status' => 'on']) }}"
                                        class="align-items-center btn btn-theme d-flex "
                                        style="margin-left: 12px !important;">
                                        Active
                                    </a>
                                    <a href="{{ route('product.filter', ['status' => 'off']) }}"
                                        class="align-items-center btn btn-theme d-flex"
                                        style="margin-left: 12px !important;">
                                        In-Active
                                    </a>
                                    <a href="{{ route('product') }}" class="align-items-center btn btn-theme d-flex"
                                        style="margin-left: 12px !important;background-color:#009688;">
                                        Reset
                                    </a>
                                </div>
                            </div>
                            <div class="col-6" style="display: grid;justify-content: end;">

                                <a href="{{ route('product.add') }}" class="align-items-center btn btn-theme d-flex"
                                    style="margin-left: 12px !important;height:fit-content;">
                                    <i data-feather="plus-square"></i>Add New
                                </a>

                            </div>
                        </div>
                        <div class="table-responsive category-table">
                            <div>
                                <table class="table  theme-table" id="datatable_id">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Color</th>
                                            {{-- <th>Sub-Category</th> --}}
                                            <th>Cost-Price</th>
                                            <th>Discount(%)</th>
                                            <th>Final-Sell-Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $data)
                                            <tr class="main-tr">
                                                <td class="d-flex  align-items-center">
                                                    <img style="object-fit: cover;width: 40px;height:40px;"
                                                        class="rounded-circle"
                                                        src="{{ $data->thumbnail ? $data->thumbnail : asset('public/no-image.png') }}"
                                                        alt="product-images">
                                                    <span class="p-2">{{ $data->sku }}</span>
                                                </td>
                                                {{-- <td>{{ $data->name }}</td> --}}
                                                <td>{{ $data->cat_id ? $data->category->name : 'N/A' }}</td>
                                                <td class="d-flex align-items-center" style="justify-content: left">
                                                    <img style="object-fit: cover;width: 40px;height:40px;"
                                                        class="rounded-circle"
                                                        src="{{ $data->color_image ? $data->color_image : asset('public/no-image.png') }}"
                                                        alt="product-images">
                                                    <span class="p-2">{{ $data->color }}</span>
                                                </td>
                                                {{-- <td>{{ $data->sub_cat_id ? $data->subCategory->name : 'N/A' }}</td> --}}
                                                <td>{{ $data->cost_price }}</td>
                                                <td>
                                                    @if ($data->discount == null)
                                                        0%
                                                    @else
                                                        {{ $data->discount }}%
                                                    @endif
                                                </td>
                                                <td>{{ $data->final_sell_price }}</td>
                                                <td>
                                                    <div class=" form-switch">
                                                        <input style="width: 37px;height: 20px;"
                                                            class="form-check-input status-checkbox"
                                                            {{ $data->status == 1 ? 'checked' : ' ' }}
                                                            id="{{ $data->id }}" data-product-id="{{ $data->id }}"
                                                            type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                                    </div>
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li>
                                                            <a href="{{ route('product.edit', $data->id) }}">
                                                                <i class="ri-pencil-line"></i>
                                                            </a>
                                                        </li>
                                                        {{-- <li>
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#deleteModel{{ $data->id }}">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </a>
                                                        </li> --}}
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
    {{-- @foreach ($datas as $data)
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
                         <a href="{{ route('product.delete', $data->id) }}"
                             class="btn btn-animation btn-md fw-bold">Yes</a>
                     </div>
                 </div>
             </div>
         </div>
    @endforeach --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- status change  --}}
    <script>
        $(document).ready(function() {
            $('.status-checkbox').change(function() {
                var catId = $(this).data('product-id');
                var status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: "{{ route('product.status') }}",
                    method: "get",
                    data: {
                        id: catId,
                        status: status,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.success);
                        }
                    },
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#datatable_id').DataTable({
                paging: true,
                ordering: true,
                order: [],
                info: false,
                responsive: true,
            });
        });
    </script>
@endsection
