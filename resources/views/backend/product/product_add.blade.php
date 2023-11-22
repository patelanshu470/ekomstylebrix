@extends('backend.layouts.admin_master')
@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/cust_backend/product/add.css') }}">
    <style>
        .selection{
            width: 100%;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12 m-auto">
                        <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data"
                            id="productAdd">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header-2">
                                        <h5>Product Images</h5>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6 col-6">
                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type='file' id="imageUpload1" name="thumbnail" required
                                                        accept=".png, .jpg, .jpeg" />
                                                    <label for="imageUpload1"></label>
                                                </div>
                                                <label class="form-label-title mb-0">Thumbnail</label>
                                                <div class="avatar-preview">
                                                    <div id="imagePreview1"
                                                        style="background-image: url('{{ asset('public/no-image.png') }}');">
                                                    </div>
                                                </div>
                                                <span class="thumbnail-error" style="color:red"></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6 col-6">
                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type='file' id="imageUpload2" name="color_image" required
                                                        accept=".png, .jpg, .jpeg" />
                                                    <label for="imageUpload2"></label>
                                                </div>
                                                <label class="form-label-title mb-0">Color-Image</label>
                                                <div class="avatar-preview">
                                                    <div id="imagePreview2"
                                                        style="background-image: url('{{ asset('public/no-image.png') }}');">
                                                    </div>
                                                </div>
                                                <span class="color-error" style="color:red"></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12 col-12">
                                            <label class="form-label-title mb-0">Product-Color:</label>
                                            <input class="form-control" type="text" name="color"
                                                placeholder="Product Color">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header-2">
                                        <h5>Product-Information</h5>
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label-title mb-0">Product-Name:</label>
                                            <input class="form-control" type="text" id="productName"
                                                name="name" placeholder="Product Name">
                                        </div>
                                        {{-- attention:  --}}
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label-title mb-0">Slug:</label>
                                            <input class="form-control" type="text" id="productSlug" readonly
                                                name="slug"placeholder="Product Slug">
                                            <span class="slug-error" style="color:red;"></span>
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label-title mb-0">Category:</label>
                                            <select class="js-example-basic-single w-100 " name="cat_id" id="catId">
                                                <option value="">Select-Category</option>
                                                @foreach ($category as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label-title mb-0">Sub-Category:</label>
                                            <select class="js-example-basic-single w-100 subCategory-class"
                                                name="sub_cat_id" id="subCatId">
                                                <option value="">Choose Sub-Category</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label-title mb-0">Cost-Price:</label>
                                            <input class="form-control" name="cost_price" type="number" id="costPrice"
                                                placeholder="Cost-Price">
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label-title mb-0">Sell-Price:</label>
                                            <input class="form-control" type="number" name="sell_price" id="sellPrice"
                                                placeholder="Sell-Price">
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label-title mb-0">Discount:</label>
                                            <input class="form-control" type="number" name="discount" id="discount"
                                                placeholder="Discount">
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label-title mb-0">Final-Sell-Price:</label>
                                            <input class="form-control" type="number" id="finalSellPrice" readonly
                                                name="final_sell_price" placeholder="Final price after discount">
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label-title mb-0">Quantity:</label>
                                            <input class="form-control" type="number" name="quantity" id="quantity"
                                                placeholder="Quantity">
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label-title mb-0">Size:</label>
                                            <select class="js-example-basic-single w-100" name="size[]" multiple required>
                                                <option value="" disabled>Select Size</option>
                                                <option value="XS">XS</option>
                                                <option value="S">S</option>
                                                <option value="M">M</option>
                                                <option value="L">L</option>
                                                <option value="XL">XL</option>
                                                <option value="XXL">XXL</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label-title mb-0">Status:</label>
                                            <select class="js-example-basic-single w-100" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">InActive</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label-title mb-0">SKU:</label>
                                            <input class="form-control" type="text" name="sku" id="sku"
                                                placeholder="SKU" required>
                                            <span class="sku-error" style="color:red;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header-2">
                                        <h5>Description</h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <textarea id="tiny" name="description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header-2">
                                        <h5>Product Gallary</h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="furl">
                                                    {{-- <p style="color:#ea5455;" id="error_product_galary">Please select more
                                                        than 3 Image </p> --}}
                                                </label>
                                                <input type="file" name="gallary[]" id="images" multiple
                                                    accept="image/png,image/jpeg" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <div id="image_preview" style="width:100%;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header-2">
                                        <h5>Product variations/Similar-Product</h5>
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <div class="col-md-9">
                                            <div class="form-check user-checkbox ps-0">
                                                <input class="checkbox_animated check-it" id="toggle-button"
                                                    type="checkbox" autocomplete="off" value="1" name="is_varient"
                                                    id="isVarient" id="flexCheckDefault">
                                                <label class="form-label-title col-md-6 mb-0">Is this Product have
                                                    Varient/Similar-Product?</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade " id="pills-home" role="tabpanel">
                                                <div class="mb-4 row align-items-center">
                                                    <div class="col-sm-6 ">
                                                        <label class="form-label-title mb-0">Select-Product:</label>
                                                        <select class="select-product-multiple w-100 product varient-id"
                                                            name="varient_ids[]" multiple id="varientId">
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3 mt-4">
                                                        <input class="checkbox_animated check-it" id="toggle-button"
                                                            type="checkbox" autocomplete="off" value="1" checked disabled
                                                            name="set_to_all" id="flexCheckDefault">
                                                        <label class="form-label-title col-md-6 mb-0">
                                                            Set to all<span style="font-size: larger;"
                                                                class="fa fa-question-circle ml-2" aria-hidden="true"
                                                                data-toggle="tooltip"
                                                                title=" By enabling this option, all the products you select will be added as variants or similar products to each and every product in the selection list. This association will create a connection between the chosen products, making them variants or suggesting them as similar options for users, thus enhancing the overall product selection experience"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-3 mt-4">
                                                        <input class="checkbox_animated check-it" id="toggle-button"
                                                            type="checkbox" autocomplete="off" value="1"
                                                            name="default_product" id="flexCheckDefault">
                                                        <label class="form-label-title col-md-6 mb-0">
                                                            Set Main Product<span style="font-size: larger;"
                                                                class="fa fa-question-circle ml-2" aria-hidden="true"
                                                                data-toggle="tooltip"
                                                                title=" Set Main Product show in user side"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="submit_btn" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@2/dist/tinymce-jquery.min.js"></script>
    <script src="{{asset('public/cust_backend/product/add.js')}}"></script>
    <script>
        $(document).ready(function() {
          $("#sku").on("input", function() {
            $(this).val($(this).val().toUpperCase());
          });
        });
        </script>
    <script>
        // subcategory fetch
        $(document).ready(function() {
            $('#catId').on('change', function() {
                var catId = this.value;
                $.ajax({
                    url: "{{ route('product.subCat') }}",
                    type: "GET",
                    data: {
                        catId: catId,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('.subCategory-class').html(
                            '<option value="" disabled selected>Choose Sub-Category</option>'
                        );
                        $.each(result.subcat, function(key, value) {
                            $(".subCategory-class").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
        // product fetch
        $(document).ready(function() {
            $('#subCatId').on('change', function() {
                var subCatId = this.value;
                var catId = $('#catId').val();
                $.ajax({
                    url: "{{ route('product.varient') }}",
                    type: "GET",
                    data: {
                        catId: catId,
                        subCatId: subCatId,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $.each(result.subcat, function(key, value) {
                            $(".varient-id").append('<option value="'+ value.id +'">' +'('+value.color+')'+' '+value.name +'</option>');
                        });
                    }
                });
            });
        });
        // slug validation checking
        $(document).ready(function() {
            $('#productName').on('keyup', function() {
                var slug = this.value;
                $.ajax({
                    url: "{{ route('product.slug.validation') }}",
                    type: "GET",
                    data: {
                        slug: slug,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result);
                        if(result.data==null){
                            $('.slug-error').text('Slug is available.').css('color', 'green');
                            $('#submit_btn').attr('disabled', false);
                        }else{
                            $('.slug-error').text('Slug is already taken.').css('color', 'red');
                            $('#submit_btn').attr('disabled', true);
                        }
                    }
                });
            });
        });
        // SKU Validation checking..
        $(document).ready(function() {
            $('#sku').on('keyup', function() {
                var sku = this.value;
                $.ajax({
                    url: "{{ route('product.sku.validation') }}",
                    type: "GET",
                    data: {
                        sku: sku,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result);
                        if(result.data==null){
                            $('.sku-error').text('SKU is available.').css('color', 'green');
                            $('#submit_btn').attr('disabled', false);
                        }else{
                            $('.sku-error').text('SKU is already taken.').css('color', 'red');
                            $('#submit_btn').attr('disabled', true);
                        }
                    }
                });
            });
        });
    </script>


@endsection
