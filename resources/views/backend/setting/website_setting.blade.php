@extends('backend.layouts.admin_master')
@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{ asset('public/cust_backend/setting/website_setting.css') }}" rel="stylesheet">

    <style>
        .alert-danger {
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
                                    <h5>Website-Setting</h5>
                                </div>
                                @php
                                    $website = App\Models\WebsiteDetails::get()->first();
                                @endphp
                                @if ($website)
                                    <form method="POST" enctype="multipart/form-data"
                                        class="theme-form theme-form-2 mega-form" id="parentCatAdd"
                                        action="{{ route('website.setting.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Email</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="email" type="email" value="{{$website->email}}"
                                                    placeholder="Enter  website email">
                                            </div>
                                        </div>
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Address</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="address" type="text" value="{{$website->location}}"
                                                    placeholder="Enter website address">
                                            </div>
                                        </div>
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Facebook-Url</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="fb_url" type="text" value="{{$website->fb_url}}"
                                                    placeholder="Enter website facebook url">
                                            </div>
                                        </div>
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Twitter-Url</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="twitter_url" type="text" value="{{$website->twitter_url}}"
                                                    placeholder="Enter website twitter url">
                                            </div>
                                        </div>
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Instagram-Url</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="insta_url" type="text" value="{{$website->insta_url}}"
                                                    placeholder="Enter website instagram url">
                                            </div>
                                        </div>
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Pinterest-Url</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="pinterest_url" type="text" value="{{$website->pinterest_url}}"
                                                    placeholder="Enter website pinterest url">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <button type="submit" class="btn btn-solid">Submit</button>
                                        </div>
                                    </form>
                                @else
                                    <form method="POST" enctype="multipart/form-data"
                                        class="theme-form theme-form-2 mega-form" id="parentCatAdd"
                                        action="{{ route('website.setting.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Email</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="email" type="email"
                                                    placeholder="Enter  website email">
                                            </div>
                                        </div>
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Address</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="address" type="text"
                                                    placeholder="Enter website address">
                                            </div>
                                        </div>
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Facebook-Url</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="fb_url" type="text"
                                                    placeholder="Enter website facebook url">
                                            </div>
                                        </div>
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Twitter-Url</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="twitter_url" type="text"
                                                    placeholder="Enter website twitter url">
                                            </div>
                                        </div>
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Instagram-Url</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="insta_url" type="text"
                                                    placeholder="Enter website instagram url">
                                            </div>
                                        </div>
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Pinterest-Url</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="pinterest_url" type="text"
                                                    placeholder="Enter website pinterest url">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <button type="submit" class="btn btn-solid">Submit</button>
                                        </div>
                                    </form>
                                @endif
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

    {{-- image preview  --}}
    <script>
        function readURL(input, previewId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#' + previewId).css('background-image', 'url(' + e.target.result + ')');
                    $('#' + previewId).hide();
                    $('#' + previewId).fadeIn(650);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imageUploadShop1Edit").change(function() {
            readURL(this, 'bannerShop1Edit');
        });
        $("#favicon_icon").change(function() {
            readURL(this, 'favicon_icon_preview');
        });

        $("#logo_edit").change(function() {
            readURL(this, 'logo_edit_preview');
        });
        $("#favicon_icon_edit").change(function() {
            readURL(this, 'favicon_icon_preview_edit');
        });
    </script>

    <script>
        $('#parentCatAdd').validate({
            rules: {
                website_name: {
                    required: true,
                },
                email: {
                    required: true,
                },
                address: {
                    required: true,
                },
                fb_url: {
                    // required: true,
                    url: true,
                    customurl: 'facebook',
                },
                twitter_url: {
                    // required: true,
                    url: true,
                    customurl: 'twitter',
                },
                insta_url: {
                    // required: true,
                    url: true,
                    customurl: 'instagram',
                },
                pinterest_url: {
                    // required: true,
                    url: true,
                    customurl: 'pinterest',
                },
            },
            messages: {
                fb_url: {
                    customurl: "Please enter a valid Facebook URL.",
                },
                twitter_url: {
                    customurl: "Please enter a valid Twitter URL.",
                },
                insta_url: {
                    customurl: "Please enter a valid Instagram URL.",
                },
                pinterest_url: {
                    customurl: "Please enter a valid Pinterest URL.",
                },
            },
            // Custom validation method for social media URLs
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
        });

        // Custom validation method for social media URLs
        $.validator.addMethod("customurl", function(value, element, param) {
            var socialMediaPatterns = {
                'facebook': /^https:\/\/www\.facebook\.com\/.*/i,
                'twitter': /^https:\/\/twitter\.com\/.*/i,
                'instagram': /^https:\/\/www\.instagram\.com\/.*/i,
                'pinterest': /^https:\/\/www\.pinterest\.com\/.*/i,
            };

            // Check if the URL matches the pattern for the specified social media type
            return this.optional(element) || socialMediaPatterns[param].test(value);
        }, "Please enter a valid URL for {0}.");

        // website logo validation
        document.getElementById("parentCatAdd").addEventListener("submit", function(event) {
            var fileInput = document.getElementById("imageUploadShop1Edit");
            var file = fileInput.files[0];
            if (!file) {
                $('.banner3-error').text("This field is required");
                event.preventDefault();
                fileInput.setCustomValidity("Please select an image.");
            } else {
                $('.banner3-error').text(" ");
                fileInput.setCustomValidity("");
            }
        });

        // Favicon-Icon validation
        document.getElementById("parentCatAdd").addEventListener("submit", function(event) {
            var fileInput = document.getElementById("favicon_icon");
            var file = fileInput.files[0];
            if (!file) {
                $('.favicon_error').text("This field is required");
                event.preventDefault();
                fileInput.setCustomValidity("Please select an image.");
            } else {
                $('.favicon_error').text(" ");
                fileInput.setCustomValidity("");
            }
        });
    </script>
@endsection
