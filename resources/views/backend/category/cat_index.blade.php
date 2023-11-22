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
                            <h5>All Category</h5>
                            <form class="d-inline-flex">
                                <a href="{{ route('category.add') }}" class="align-items-center btn btn-theme d-flex">
                                    <i data-feather="plus-square"></i>Add New
                                </a>
                            </form>
                        </div>
                        <div class="table-responsive category-table">
                            <div>
                                <table class="table all-package theme-table" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $data)
                                            <tr>
                                                <td>{{ $data->name }}</td>
                                                <td>
                                                    <div class="category-icon" style="width: 65px;height:65px">
                                                        <img style="object-fit: cover;"
                                                            src="{{ $data->image ? $data->image : 'https://dummyimage.com/65x65/fff' }}"
                                                            alt="category-images">
                                                    </div>
                                                </td>
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
                                                            <a href="{{ route('category.edit', $data->id) }}">
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
                                                            <a href="{{ route('category.delete', $data->id) }}"
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- status change  --}}
    <script>
        $(document).ready(function() {
            $('.status-checkbox').change(function() {
                var catId = $(this).data('product-id');
                var status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: "{{ route('category.status') }}",
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
@endsection
