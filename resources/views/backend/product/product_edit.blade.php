@extends('backend.layouts.admin_master')
@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/cust_backend/product/edit.css') }}">
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
                        <form method="post" action="{{ route('product.update', $data->id) }}" enctype="multipart/form-data"
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
                                                        style="background-image: url('{{ $data->thumbnail }}');">
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
                                                        style="background-image: url('{{ $data->color_image }}');">
                                                    </div>
                                                </div>
                                                <span class="color-error" style="color:red"></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12 col-12">
                                            <label class="form-label-title mb-0">Product-Color:</label>
                                            <input class="form-control" type="text" name="color"
                                                value="{{ $data->color }}" placeholder="Product Color">
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
                                                value="{{ $data->name }}" name="name" placeholder="Product Name">
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label-title mb-0">Slug:</label>
                                            <input class="form-control" type="text" id="productSlug" readonly data-id="{{$data->id}}"
                                                value="{{ $data->slug }}" name="slug"placeholder="Product Slug">
                                            <span class="slug-error" id="slugErrorId" style="color:red;"></span>
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label-title mb-0">Category:</label>
                                            <select class="js-example-basic-single w-100 " name="cat_id" id="catId">
                                                <option value="">Select-Category</option>
                                                @foreach ($category as $cat)
                                                    <option {{ $cat->id == $data->cat_id ? 'Selected' : '' }}
                                                        value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label-title mb-0">Sub-Category:</label>
                                            <select class="js-example-basic-single w-100 subCategory-class"
                                                name="sub_cat_id" id="subCatId">
                                                @foreach ($subCategory as $subCat)
                                                    <option {{ $subCat->id == $data->sub_cat_id ? 'Selected' : '' }}
                                                        value="{{ $subCat->id }}">{{ $subCat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label-title mb-0">Cost-Price:</label>
                                            <input class="form-control" name="cost_price" type="number" id="costPrice"
                                                value="{{ $data->cost_price }}" placeholder="Cost-Price">
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label-title mb-0">Sell-Price:</label>
                                            <input class="form-control" type="number" name="sell_price" id="sellPrice"
                                                value="{{ $data->sell_price }}" placeholder="Sell-Price">
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label-title mb-0">Discount:</label>
                                            <input class="form-control" type="number" name="discount" id="discount"
                                                value="{{ $data->discount }}" placeholder="Discount">
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label-title mb-0">Final-Sell-Price:</label>
                                            <input class="form-control" type="number" id="finalSellPrice" readonly
                                                value="{{ $data->final_sell_price }}" name="final_sell_price"
                                                placeholder="Final price after discount">
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label-title mb-0">Quantity:</label>
                                            <input class="form-control" type="number" name="quantity" id="quantity"
                                                value="{{ $data->quantity }}" placeholder="Quantity">
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label-title mb-0">Size:</label>
                                            <select class="js-example-basic-single w-100" name="size[]" multiple>
                                                <option value="" disabled>Select Size</option>
                                                @foreach (json_decode($data->size) as $selectedSize)
                                                    <option {{ $selectedSize == 'XS' ? 'selected' : '' }} value="XS">XS</option>
                                                    <option {{ $selectedSize == 'S' ? 'selected' : '' }} value="S">S</option>
                                                    <option {{ $selectedSize == 'M' ? 'selected' : '' }} value="M">M</option>
                                                    <option {{ $selectedSize == 'L' ? 'selected' : '' }} value="L">L</option>
                                                    <option {{ $selectedSize == 'XL' ? 'selected' : '' }} value="XL">XL</option>
                                                    <option {{ $selectedSize == 'XXL' ? 'selected' : '' }} value="XXL">XXL</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label-title mb-0">Status:</label>
                                            <select class="js-example-basic-single w-100" name="status">
                                                <option {{ $data->status == 1 ? 'Selected' : '' }} value="1">Active
                                                </option>
                                                <option {{ $data->status == 0 ? 'Selected' : '' }} value="0">InActive
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label-title mb-0">SKU:</label>
                                            <input class="form-control" type="text" name="sku" id="sku" value="{{ $data->sku }}" data-id="{{$data->id}}"
                                                placeholder="SKU" required>
                                            <span class="sku-error" id="skuErrorId" style="color:red;"></span>
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
                                                    <textarea id="tiny" name="description">@php echo $data->description @endphp</textarea>
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
                                            @if (count($data->galleries) > 0)
                                                <div class="img-thumbs img-thumbs" id="img-previews">
                                                    @foreach ($data->galleries as $img)
                                                        <div class="wrapper-thumb" id="maind{{ $img->id }}">
                                                            <img src="{{ $img->image }}"
                                                                for="upload-img" class="img-preview-thumb b">
                                                            <span class="removeBtn remove-btn" id="d{{ $img->id }}"
                                                                data-url="{{ route('product.img.delete', $img->id) }}">x</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
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
                                            <div class="form-check user-checkbox ps-0 ">
                                                <input class="checkbox_animated check-it" id="toggle-button"
                                                    type="checkbox" autocomplete="off" value="1" name="is_varient"
                                                    {{ $data->is_varient == 1 ? 'checked' : '' }} id="isVarient"
                                                    id="flexCheckDefault">
                                                <label class="form-label-title col-md-6 mb-0">Is this Product have
                                                    Varient/Similar-Product?</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade
                                            {{ $data->is_varient == 1 ? 'show active' : '' }} "
                                                id="pills-home" role="tabpanel">
                                                <div class="mb-4 row align-items-center">

                                                    <div class="col-sm-6 ">
                                                        <label class="form-label-title mb-0">Select-Product:</label>
                                                        <select class="select-product-multiple w-100 product varient-id"
                                                            name="varient_ids[]" multiple id="varientId">
                                                            @foreach ($product as $pro)
                                                                <option value="{{$pro->id}}" {{ in_array($pro->id, $varients) ? 'selected' : '' }}>{{ $pro->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3 mt-4">
                                                        <input class="checkbox_animated check-it" id="toggle-button"
                                                            type="checkbox" autocomplete="off" value="1"
                                                            {{ $data->set_to_all == 1 ? 'checked' : '' }}
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
                                                            {{ $data->varient_status == 1 ? 'checked' : '' }}
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
    <script src="{{asset('public/cust_backend/product/edit.js')}}"></script>
    <script>
        $(document).ready(function() {
          $("#sku").on("input", function() {
            $(this).val($(this).val().toUpperCase());
          });
        });
        </script>
    <script>
        // $(document).ready(function() {
        //     if ('{{ count($data->galleries) > 3 }}') {
        //         $('#gallary_error').css('display', 'none');
        //         $('#submit_btn').attr('disabled', false);
        //     } else {
        //         $('#gallary_error').css('display', '');
        //         $('#submit_btn').attr('disabled', true);
        //     }
        // });

        // $("#images").change(function(e) {
        //     var fileUpload = $("#images");
        //     var numItems = $('#img-previews').children('div').length;
        //     var checkimage = parseInt(fileUpload.get(0).files.length) + numItems;
        //     // alert(checkimage);
        //     if (checkimage > 1) {
        //         $('#gallary_error').css('display', 'none');
        //         $('#submit_btn').attr('disabled', false);
        //     }
        // });

        $(document).ready(function() {
            // $("body").on("click", "#action-icon", function(evt) {
            //     var fileUpload = $("#images");
            //     if (parseInt(fileUpload.get(0).files.length) > 4) {
            //         $('#error_product_galary').slideUp("slow");
            //         $('#submit_btn').attr('disabled', false);
            //     } else {
            //         $('#error_product_galary').slideDown("slow");
            //         $('#submit_btn').attr('disabled', true);
            //     }
            //     if (parseInt(fileUpload.get(0).files.length) == 1) {
            //         $('#image_preview').css('display', 'none');
            //     }
            // });

        });
    </script>
    {{-- ajax  --}}
    <script>
        //delete multi image
        jQuery(document).on("click", ".removeBtn", function() {
            var url = $(this).attr("data-url");
            var del_id = $(this).attr("id");
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085D6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: "get",
                        success: function(data) {
                            var numItems = $('.remove-btn').length
                            if (numItems <= 1) {
                                $('#img-preview').addClass('img-thumbs-hidden');
                            }
                            $("div").remove('#main' + del_id);
                            var fileUpload = $("#images");
                            var checkimage = parseInt(fileUpload.get(0).files.length) +
                                parseInt(data);
                            // if (checkimage > 4) {
                            //     $('#gallary_error').css('display', 'none');
                            //     $('#submit_btn').attr('disabled', false);
                            // } else {
                            //     $('#gallary_error').css('display', '');
                            //     $('#submit_btn').attr('disabled', true);
                            // }
                            // alert(data);
                            // alert(checkimage);
                            var count = $("#img-previews .wrapper-thumb").length;
                            if (count == 0) {
                                $('#img-previews').css('display', 'none');
                            }
                            if (checkimage == 1) {
                                $('#img-previews').css('display', 'none');
                            }
                        },
                    });
                    $(this).parents(".rem").parent().remove();
                }
            });
        });
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
                            '<option value=""   disabled selected>Choose Sub-Category</option>'
                        );
                        $.each(result.subcat, function(key, value) {
                            $(".subCategory-class").append('<option   value="' + value
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
                        console.log(result);

                        $.each(result.subcat, function(key, value) {
                            $(".varient-id").append('<option value="' + value
                                .id + '">' + '(' + value.color + ')' + ' ' + value
                                .name + '</option>');
                        });
                    }
                });
            });
        });
        // slug validation checking
        $(document).ready(function() {
            $('#productName').on('keyup', function() {
                var slug = this.value;
                var productId=$('#productSlug').data('id');
                $.ajax({
                    url: "{{ route('product.slug.validation') }}",
                    type: "GET",
                    data: {
                        id:productId,
                        slug: slug,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result);
                        if (result.data == null) {
                            $('.slug-error').text('Slug is available.').css('color', 'green').removeClass('not-available');
                        } else {
                            $('.slug-error').text('Slug is already taken.').css('color', 'red').addClass('not-available');
                        }
                    }
                });
            });
            function handleSubmit(event) {
                var slugIsAvailable = $('.slug-error').hasClass('not-available');
                if (slugIsAvailable) {
                    event.preventDefault();
                    alert('Slug is already taken.');
                }
            }
            $('#productAdd').on('submit', handleSubmit);
        });
        // SKU validation checking
        $(document).ready(function() {
            $('#sku').on('keyup', function() {
                var sku = this.value;
                var productId=$('#sku').data('id');
                $.ajax({
                    url: "{{ route('product.sku.validation') }}",
                    type: "GET",
                    data: {
                        id:productId,
                        sku: sku,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result);
                        if (result.data == null) {
                            $('.sku-error').text('SKU is available.').css('color', 'green').removeClass('not-available');
                        } else {
                            $('.sku-error').text('SKU is already taken.').css('color', 'red').addClass('not-available');
                        }
                    }
                });
            });
            function handleSubmit(event) {
                var skuIsAvailable = $('.sku-error').hasClass('not-available');
                if (skuIsAvailable) {
                    event.preventDefault();
                    alert('SKU is already taken.');
                }
            }
            $('#productAdd').on('submit', handleSubmit);
        });

    </script>

@endsection
