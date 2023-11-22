@extends('backend.layouts.admin_master')
@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/cust_backend/category/add.css') }}">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Add Category</h5>
                                </div>
                                <form method="POST" enctype="multipart/form-data" class="theme-form theme-form-2 mega-form"
                                    id="parentCatAdd" action="{{ route('category.store') }}">
                                    @csrf
                                    <div class="mb-4 row ">
                                        <div class="form-group col-sm-12 col-12">
                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type='file' id="imageUpload" name="image" required
                                                        accept=".png, .jpg, .jpeg" />
                                                    <label for="imageUpload"></label>
                                                </div>
                                                <div class="avatar-preview">
                                                    <div id="imagePreview"
                                                        style="background-image: url(https://dummyimage.com/150x150/fff);">
                                                    </div>
                                                    <div id="imagePreview">
                                                    </div>
                                                </div>
                                                <span class="image-error" style="color:red"></span>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Category Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="name" type="text"
                                                placeholder="Category Name">
                                        </div>
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Status</label>
                                        <div class="col-sm-9">
                                            <select style="border-color: #efefef !important;"
                                                class="js-example-basic-single  form-control" name="status">
                                                <option value="1" selected>Active</option>
                                                <option value="0">InActive</option>
                                            </select>
                                        </div>
                                    </div>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="{{asset('public/cust_backend/category/add.js')}}"></script>
@endsection
