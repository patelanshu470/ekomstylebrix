<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ getenv('WEBSITE_NAME') }}">
    <meta name="keywords" content="{{ getenv('WEBSITE_NAME') }}">
    <meta name="author" content="{{ getenv('WEBSITE_NAME') }}">
    <link rel="icon" href="{{ asset(getenv('FAVICON_ICON')) }}" type="image/x-icon">
    <title>{{ getenv('WEBSITE_NAME') }}</title>
    <!-- Google font -->
    <script src="https://kit.fontawesome.com/40ab2e945c.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&ampdisplay=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&ampdisplay=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&ampdisplay=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&ampdisplay=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&ampdisplay=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Great+Vibes&ampfamily=Qwitcher+Grypen:wght@400;700&ampdisplay=swap"
        rel="stylesheet">
    <link id="rtl-link" rel="stylesheet" type="text/css"
        href="{{ asset('public/frontend/assets/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/assets/css/vendors/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/assets/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/assets/css/vendors/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/frontend/assets/css/vendors/slick/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/assets/css/bulk-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/assets/css/vendors/animate.css') }}">
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('public/frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/resources/assets/toastr/toatr.css') }}">
    <style>
        .alert-error {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
    </style>
</head>

<body class="theme-color-5">
    <!-- Loader Start -->
    <div class="fullpage-loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!-- Loader End -->
    @include('frontend.layouts.panels.navbar')
    <div class="mobile-menu d-md-none d-block mobile-cart">
        <ul>
            <li class=" {{ Route::currentRouteName() === 'home' ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                <a href="{{route('home')}}">
                    <span>Home</span>
                </a>
            </li>
            <li class="{{ Route::currentRouteName() === 'wishlist' ? 'active' : '' }}" >
                <i class="fa-solid fa-bookmark"></i>
                <a href="{{route('wishlist')}}" class="notifi-wishlist">
                    <span>My Wish</span>
                </a>
            </li>
            <li class="{{ Route::currentRouteName() === 'view.cart' ? 'active' : '' }}">
                <i class="fa-solid fa-cart-shopping"></i>
                <a href="{{route('view.cart')}}">
                    <span>Cart</span>
                </a>

            </li>
        </ul>
    </div>
    @yield('frontendContent')
    @include('frontend.layouts.panels.newsletter')
    @include('frontend.layouts.panels.footer')

    {{-- cookie --}}
        {{-- <div class="cookie-bar-box">
            <div class="cookie-box">
                <div class="cookie-image">
                    <img src="../assets/images/cookie-bar.png" class="blur-up lazyload" alt="">
                    <h2>Cookies!</h2>
                </div>

                <div class="cookie-contain">
                    <h5 class="text-content">We use cookies to make your experience better</h5>
                </div>
            </div>
            <div class="button-group">
                <button class="btn privacy-button">Privacy Policy</button>
                <button class="btn ok-button">OK</button>
            </div>
        </div> --}}
    {{-- end  --}}

    <!-- Tap to top start theme color setup -->
    {{-- <div class="theme-option">
        <div class="setting-box">
            <button class="btn setting-button">
                <i class="fa-solid fa-gear"></i>
            </button>
            <div class="theme-setting-2">
                <div class="theme-box">
                    <ul>
                        <li>
                            <div class="setting-name">
                                <h4>Color</h4>
                            </div>
                            <div class="theme-setting-button color-picker">
                                <form class="form-control">
                                    <label for="colorPick" class="form-label mb-0">Theme Color</label>
                                    <input type="color" class="form-control form-control-color" id="colorPick"
                                        value="#417394" title="Choose your color">
                                </form>
                            </div>
                        </li>

                        <li>
                            <div class="setting-name">
                                <h4>Dark</h4>
                            </div>
                            <div class="theme-setting-button">
                                <button class="btn btn-2 outline" id="darkButton">Dark</button>
                                <button class="btn btn-2 unline" id="lightButton">Light</button>
                            </div>
                        </li>

                        <li>
                            <div class="setting-name">
                                <h4>RTL</h4>
                            </div>
                            <div class="theme-setting-button rtl">
                                <button class="btn btn-2 rtl-unline">LTR</button>
                                <button class="btn btn-2 rtl-outline">RTL</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="back-to-top">
            <a id="back-to-top" href="#">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>
    </div> --}}
    <!-- Tap to top end -->

    {{-- add to wish list  --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.wishlist-class').on('click', function() {
                var product_id = jQuery(this).data('id');
                var click = jQuery(this);
                $.ajax({
                    url: "{{ route('add.to.wishlist') }}",
                    type: "POST",
                    data: {
                        product_id: product_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.result === 'success') {
                            click.attr('data-wishlist_item_id', result.wishlist_item_id);
                            click.find('svg').removeAttr('fill');
                            click.find('svg').attr('fill', 'currentColor');
                            click.attr('data-bs-original-title', 'Removed To Wishlist');
                            click.addClass('active-wishlist');
                            click.addClass('wishlist-removed').removeClass('wishlist-class');
                            $.notify({
                                icon: "fa fa-check",
                                title: "Success!",
                                message: "Item Successfully added in wishlist",
                            }, {
                                element: "body",
                                position: null,
                                type: "info",
                                allow_dismiss: true,
                                newest_on_top: false,
                                showProgressbar: true,
                                placement: {
                                    from: "top",
                                    align: "right",
                                },
                                offset: 20,
                                spacing: 10,
                                z_index: 1031,
                                delay: 5000,
                                animate: {
                                    enter: "animated fadeInDown",
                                    exit: "animated fadeOutUp",
                                },
                                icon_type: "class",
                                template: '<div data-notify="container" class="col-xxl-3 col-lg-5 col-md-6 col-sm-7 col-12 alert alert-{0}" role="alert">' +
                                    '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' +
                                    '<span data-notify="icon"></span> ' +
                                    '<span data-notify="title">{1}</span> ' +
                                    '<span data-notify="message">{2}</span>' +
                                    '<div class="progress" data-notify="progressbar">' +
                                    '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                                    "</div>" +
                                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                                    "</div>",
                            });
                            $('#wishlist-total').text(result.cart_total);
                        } else {
                            click.find('svg').removeAttr('fill');
                            click.find('svg').attr('fill', 'none');
                            click.attr('data-bs-original-title', 'Add To Wishlist');
                            click.addClass('active-wishlist');
                            click.addClass('wishlist-class').removeClass('wishlist-removed');
                            $.notify({
                                icon: "fa fa-check",
                                title: "Error!",
                                message: "Product Removed to Wishlist",
                            }, {
                                element: "body",
                                position: null,
                                type: "error",
                                allow_dismiss: true,
                                newest_on_top: false,
                                showProgressbar: true,
                                placement: {
                                    from: "top",
                                    align: "right",
                                },
                                offset: 20,
                                spacing: 10,
                                z_index: 1031,
                                delay: 5000,
                                animate: {
                                    enter: "animated fadeInDown",
                                    exit: "animated fadeOutUp",
                                },
                                icon_type: "class",
                                template: '<div data-notify="container" class="col-xxl-3 col-lg-5 col-md-6 col-sm-7 col-12 alert alert-{0}" role="alert">' +
                                    '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' +
                                    '<span data-notify="icon"></span> ' +
                                    '<span data-notify="title">{1}</span> ' +
                                    '<span data-notify="message">{2}</span>' +
                                    '<div class="progress" data-notify="progressbar">' +
                                    '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                                    "</div>" +
                                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                                    "</div>",
                            });
                            $('#wishlist-total').text(result.cart_total);
                        }
                    },
                    error: function() {
                        toastr.error('An error occurred. Please try again later.');
                    },
                    statusCode: {
                        401: function() {
                            window.location.href = "{{ route('login') }}";
                        }
                    }
                });
            });
        });
    </script>

    <!-- removed to wishlist -->
    <script>
        $(document).ready(function() {
            $('.wishlist-removed').on('click', function() {
                var product_id = jQuery(this).data('id');
                var wishlist_item_id = jQuery(this).attr('data-wishlist_item_id');
                var click = jQuery(this);
                $.ajax({
                    url: "{{ route('remove.to.wishlist') }}",
                    type: "POST",
                    data: {
                        wishlist_id: wishlist_item_id,
                        product_id: product_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.result === 'success') {
                            // click.removeAttr('data-wishlist_item_id');
                            // click.attr('title', 'Add To Wishlist');
                            // click.removeClass('active-wishlist');
                            click.find('svg').removeAttr('fill');
                            click.find('svg').attr('fill', 'none');
                            click.attr('data-bs-original-title', 'Add To Wishlist');
                            click.addClass('active-wishlist');
                            click.addClass('wishlist-class').removeClass('wishlist-removed');
                            $.notify({
                                icon: "fa fa-check",
                                title: "Error!",
                                message: "Product Removed to Wishlist",
                            }, {
                                element: "body",
                                position: null,
                                type: "error",
                                allow_dismiss: true,
                                newest_on_top: false,
                                showProgressbar: true,
                                placement: {
                                    from: "top",
                                    align: "right",
                                },
                                offset: 20,
                                spacing: 10,
                                z_index: 1031,
                                delay: 5000,
                                animate: {
                                    enter: "animated fadeInDown",
                                    exit: "animated fadeOutUp",
                                },
                                icon_type: "class",
                                template: '<div data-notify="container" class="col-xxl-3 col-lg-5 col-md-6 col-sm-7 col-12 alert alert-{0}" role="alert">' +
                                    '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' +
                                    '<span data-notify="icon"></span> ' +
                                    '<span data-notify="title">{1}</span> ' +
                                    '<span data-notify="message">{2}</span>' +
                                    '<div class="progress" data-notify="progressbar">' +
                                    '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                                    "</div>" +
                                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                                    "</div>",
                            });
                            $('#wishlist-total').text(result.cart_total);
                        } else {
                            click.attr('data-wishlist_item_id', result.wishlist_item_id);
                            click.find('svg').removeAttr('fill');
                            click.find('svg').attr('fill', 'currentColor');
                            click.attr('data-bs-original-title', 'Removed To Wishlist');
                            click.addClass('active-wishlist');
                            click.addClass('wishlist-removed').removeClass('wishlist-class');
                            $.notify({
                                icon: "fa fa-check",
                                title: "Success!",
                                message: "Product Add to Wishlist",
                            }, {
                                element: "body",
                                position: null,
                                type: "info",
                                allow_dismiss: true,
                                newest_on_top: false,
                                showProgressbar: true,
                                placement: {
                                    from: "top",
                                    align: "right",
                                },
                                offset: 20,
                                spacing: 10,
                                z_index: 1031,
                                delay: 5000,
                                animate: {
                                    enter: "animated fadeInDown",
                                    exit: "animated fadeOutUp",
                                },
                                icon_type: "class",
                                template: '<div data-notify="container" class="col-xxl-3 col-lg-5 col-md-6 col-sm-7 col-12 alert alert-{0}" role="alert">' +
                                    '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' +
                                    '<span data-notify="icon"></span> ' +
                                    '<span data-notify="title">{1}</span> ' +
                                    '<span data-notify="message">{2}</span>' +
                                    '<div class="progress" data-notify="progressbar">' +
                                    '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                                    "</div>" +
                                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                                    "</div>",
                            });
                            $('#wishlist-total').text(result.cart_total);
                        }
                    },
                    error: function() {
                        toastr.error('An error occurred. Please try again later.');
                    },
                    statusCode: {
                        401: function() {
                            window.location.href = "{{ route('login') }}";
                        }
                    }
                });
            });
        });
    </script>
    {{-- add to cart  --}}
    <script>
        $(document).ready(function() {
            $('.button-add-to-cart').on('click', function() {
                var quantityInput = $(".qty-val");
                var quantity = parseInt(quantityInput.val());
                if (isNaN(quantity) || quantity === null) {
                    quantity = 1;
                }
                var product_id = jQuery(this).data('product_id');
                var Size = jQuery("input[name=size]:checked").val();
                $.ajax({
                    url: "{{ route('add.to.cart') }}",
                    type: "POST",
                    data: {
                        product_id: product_id,
                        quantity: quantity,
                        size: Size,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.result === 'success') {
                            $.notify({
                                icon: "fa fa-check",
                                title: "Success!",
                                message: "Item Successfully added to Cart",
                            }, {
                                element: "body",
                                position: null,
                                type: "info",
                                allow_dismiss: true,
                                newest_on_top: false,
                                showProgressbar: true,
                                placement: {
                                    from: "top",
                                    align: "right",
                                },
                                offset: 20,
                                spacing: 10,
                                z_index: 1031,
                                delay: 5000,
                                animate: {
                                    enter: "animated fadeInDown",
                                    exit: "animated fadeOutUp",
                                },
                                icon_type: "class",
                                template: '<div data-notify="container" class="col-xxl-3 col-lg-5 col-md-6 col-sm-7 col-12 alert alert-{0}" role="alert">' +
                                    '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' +
                                    '<span data-notify="icon"></span> ' +
                                    '<span data-notify="title">{1}</span> ' +
                                    '<span data-notify="message">{2}</span>' +
                                    '<div class="progress" data-notify="progressbar">' +
                                    '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                                    "</div>" +
                                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                                    "</div>",
                            });
                            $('#cart-total').text(result.cart_total);
                        } else {
                            $.notify({
                                icon: "fa fa-check",
                                title: "Error!",
                                message: result.message,
                            }, {
                                element: "body",
                                position: null,
                                type: "error",
                                allow_dismiss: true,
                                newest_on_top: false,
                                showProgressbar: true,
                                placement: {
                                    from: "top",
                                    align: "right",
                                },
                                offset: 20,
                                spacing: 10,
                                z_index: 1031,
                                delay: 5000,
                                animate: {
                                    enter: "animated fadeInDown",
                                    exit: "animated fadeOutUp",
                                },
                                icon_type: "class",
                                template: '<div data-notify="container" class="col-xxl-3 col-lg-5 col-md-6 col-sm-7 col-12 alert alert-{0}" role="alert">' +
                                    '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' +
                                    '<span data-notify="icon"></span> ' +
                                    '<span data-notify="title">{1}</span> ' +
                                    '<span data-notify="message">{2}</span>' +
                                    '<div class="progress" data-notify="progressbar">' +
                                    '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                                    "</div>" +
                                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                                    "</div>",
                            });
                            $('#wishlist-total').text(result.cart_total);
                        }
                    },
                    error: function(response) {
                        if (response && response.responseJSON && response.responseJSON.message) {
                            // toastr.error(response.responseJSON.message);
                            $.notify({
                                icon: "fa fa-check",
                                title: "Error!",
                                message: response.responseJSON.message,
                            }, {
                                element: "body",
                                position: null,
                                type: "error",
                                allow_dismiss: true,
                                newest_on_top: false,
                                showProgressbar: true,
                                placement: {
                                    from: "top",
                                    align: "right",
                                },
                                offset: 20,
                                spacing: 10,
                                z_index: 1031,
                                delay: 5000,
                                animate: {
                                    enter: "animated fadeInDown",
                                    exit: "animated fadeOutUp",
                                },
                                icon_type: "class",
                                template: '<div data-notify="container" class="col-xxl-3 col-lg-5 col-md-6 col-sm-7 col-12 alert alert-{0}" role="alert">' +
                                    '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' +
                                    '<span data-notify="icon"></span> ' +
                                    '<span data-notify="title">{1}</span> ' +
                                    '<span data-notify="message">{2}</span>' +
                                    '<div class="progress" data-notify="progressbar">' +
                                    '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                                    "</div>" +
                                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                                    "</div>",
                            });
                        } else {

                            toastr.error('An error occurred. Please try again later.');
                        }
                    },
                    statusCode: {
                        401: function() {
                            window.location.href = "{{ route('login') }}";
                        }
                    }
                });
            });
        });
    </script>
    <script src="{{ asset('public/frontend/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/bootstrap/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/feather/feather.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/feather/feather-icon.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/lazysizes.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/slick/slick.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/slick/slick-animation.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/slick/custom_slick.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/auto-height.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/custom-wow.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/script.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/theme-setting.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/timer1.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/quantity-2.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/jquery.elevatezoom.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/zoom-filter.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/custom-slick-animated.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/filter-sidebar.js') }}"></script>
    <script src="{{ asset('public/resources/assets/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('public/resources/assets/toastr/toastr.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/quantity.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/lusqsztk.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/delivery-option.js') }}"></script>
    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif
        @if (Session::has('status'))
            toastr.success("{{ Session::get('status') }}");
        @endif
        @if (Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @endif
        @if (Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @endif
        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
    </script>
</body>
</html>
