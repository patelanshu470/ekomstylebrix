@extends('backend.layouts.admin_master')
@section('content')

<style>
    .design{
        text-align: left !important;
    }
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
                            <h5>All Users</h5>
                        </div>
                        <div class="table-responsive category-table">
                            <div>
                                <table class="table all-package theme-table"  id="table_id">
                                    <thead>
                                        <tr>
                                            <th class="design" class="design">Name</th>
                                            <th class="design">Email</th>
                                            <th class="design">Phone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $data)
                                            <tr>
                                                <td class="design">
                                                    <img style="object-fit: cover;width: 40px;height:40px;"
                                                    class="rounded-circle"
                                                    src="{{ $data->profile_image ? $data->profile_image : asset('public/no-image.png') }}"
                                                    alt="product-images">
                                                    {{ $data->name }}
                                                </td>
                                                <td class="design">{{ $data->email }}</td>
                                                <td class="design">{{ $data->mobile }}</td>
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
