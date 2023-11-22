@extends('backend.layouts.admin_master')
@section('content')
    <!-- Add these links in the <head> section of your HTML -->
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
                            <h5>All Review</h5>
                        </div>
                        <div class="table-responsive category-table">
                            <div>
                                <table class="table all-package theme-table" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>User-Name</th>
                                            <th>Product</th>
                                            <th>Review-Date</th>
                                            <th>Review-Image</th>
                                            <th>Stars</th>
                                            <th>Review</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($datas as $data)
                                            <tr>
                                                <td>{{ $data->user->name }}</td>
                                                <td>{{ $data->product->sku }}</td>
                                                <td>{{ $data->created_at }}</td>
                                                <td>

                                                    <div class="category-icon" style="width: 65px;height:65px">
                                                        <img style="object-fit: cover;"
                                                            src="{{ $data->image ? $data->image : 'https://dummyimage.com/65x65/fff' }}"
                                                            alt="category-images">
                                                    </div>
                                                </td>
                                                <td>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $data->rating)
                                                            <i class="fa-solid fa-star"
                                                                style="color: #FEBD2F;font-size: 13px;"></i>
                                                        @else
                                                            <i class="fa-regular fa-star"
                                                                style="color: #FEBD2F;font-size: 13px;"></i>
                                                        @endif
                                                    @endfor
                                                </td>
                                                <td>
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="{{ $data->description }}">
                                                        {{ Str::limit($data->description, 50) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class=" form-switch">
                                                        <input style="width: 37px;height: 20px;"
                                                            class="form-check-input status-checkbox"
                                                            {{ $data->status == 1 ? 'checked' : ' ' }}
                                                            id="{{ $data->id }}" data-id="{{ $data->id }}"
                                                            type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                                    </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        //  attention:
        $(document).ready(function() {
            $('.status-checkbox').change(function() {
                var id = $(this).data('id');
                var status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: "{{ route('review.status') }}",
                    method: "get",
                    data: {
                        id: id,
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
    {{-- toolTip  --}}
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
