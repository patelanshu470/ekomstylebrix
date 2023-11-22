@extends('backend.layouts.admin_master')
@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <style>
        .alert-danger{
            background: red;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Profile-Setting</h5>
                                </div>
                                <form method="POST" enctype="multipart/form-data" class="theme-form theme-form-2 mega-form"
                                    id="parentCatAdd" action="{{ route('password.setting.update') }}">
                                    @csrf

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Old-Password</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="old_password" type="password"
                                                placeholder="Enter old password">
                                        </div>
                                    </div>
                                    @error('old_password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">New-Password</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="new_password" type="password"
                                                placeholder="Enter new password">
                                        </div>
                                    </div>
                                    @error('new_password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="mb-4 row align-items-center">
                                        <button type="submit" class="btn btn-solid">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- -------------- Image preview ------------------>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="{{asset('public/cust_backend/setting/password.js')}}"></script>

  

@endsection
