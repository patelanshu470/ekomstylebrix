@extends('backend.layouts.admin_master')
@section('content')
    <style>
        .select2-selection{
            border-color: #ffffff !important;
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
                                    <h5>Edit Sub-Category</h5>
                                </div>
                                <form method="POST" enctype="multipart/form-data" class="theme-form theme-form-2 mega-form"
                                    id="parentCatAdd" action="{{ route('subCategory.update',$data->id) }}">
                                    @csrf
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Sub-Category Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="name" type="text" value="{{$data->name}}"
                                                placeholder="Category Name">
                                        </div>
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Category</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single  form-control" name="cat_id">
                                                <option value="">Select Category</option>
                                                @foreach($category as $cat)
                                                    <option {{($data->cat_id==$cat->id)? "selected":""}} value="{{$cat->id}}" >{{$cat->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Status</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single  form-control" name="status">
                                                <option  {{ $data->status == 1 ? 'selected' : '' }} value="1" selected>Active</option>
                                                <option {{ $data->status == 0 ? 'selected' : '' }} value="0">InActive</option>
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
    <script src="{{asset('public/cust_backend/subCategory/edit.js')}}"></script>
@endsection
